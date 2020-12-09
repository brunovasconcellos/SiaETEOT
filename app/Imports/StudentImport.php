<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\User;
use App\Student;
use App\StudentComplement;
use App\Locality;
use App\Contact;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Hash;

class StudentImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    
    public function model(array $row)
    {
        $locality = Locality::validateLocality($row, "excel");

        $user = User::updateOrCreate([
            'name' => $row["nome"],
            "last_name" => $row["sobrenome"],
            'email' => $row["email"],
            'password' => Hash::make($row["senha"]),
            "date_of_birth" => $row["data_nascimento"],
            "gender" => $row["sexo"],
            "cell_phone" => $row["numero_telefone"],
            "identity_rg" => $row["numero_rg"],
            "identity_em_dt" => $row["data_emissao"],
            "identity_issuing_authority" => $row["orgao_emissor"],
            "cpf" => $row["cpf"],
            "user_name" => $row["nome_usuario"],
            "level" => $row["level"],
            "num_residence" => $row["numero_residencia"],
            "complement_residence" => $row["complemento"],
            "cep_user" => $locality,
        ]);

        $student = Student::updateOrCreate([

            "student_registration" => $row["matricula"],
            "father_name" => $row["nome_pai"],
            "mather_name" => $row["nome_mae"],
            "student_type" => $row["tipo_estudante"],
            "actual_situation" => $row["situacao_atual"],
            "user_id" => $user->user_id,

        ]);

        StudentComplement::updateOrCreate([

            "student_registration" => $student->student_registration,
            "ingress_type" => $row["tipo_ingresso"],
            "ingress_form" => $row["forma_ingresso"],
            "last_school" => $row["tipo_vaga"],
            "vagacy_type" => $row["ultima_escola"],
            "ident_educacenso" => $row["ident_educacenso"],
            "year_last_grade" => $row["ano_ultima_serie"],

        ]);

        Contact::insertContact($row, $user->user_id, "excel");

    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            
            'cep' => ["required", "size:11"],
            "matricula" => ["required", "unique:students"],
            "nome" => ["required", "string", "max:255"],
            "sobrenome" => ["required", "string", "max:255"],
            "email" => ["required", "email", 'unique:users', "max:255"],
            "senha" => ["required", "min:8"],
            "data_nascimento" => ["required"],
            "sexo" => ["required", "string", "size:1"],
            "numero_telefone" => ["required", "size:11"],
            "numero_rg" => ["required", "size:9"],
            "data_emissao" =>  ["required", "date"],
            "orgao_emissor" => ["required", "string", "min:4", "max:20"],
            "cpf" => ["required", "string", "size:11"],
            "nome_usuario" => ["required", "string", "max:255"],
            "level" => ["required", "size:1"],
            "numero_residencia" => ["required", "string", "max:255"],
            "complemento" => ["required", "string", "max:255"],
            "cep" => ["required", "size:8"],
            "tipo_logradouro" => ["required", "string", "max:255"],
            "logradouro" => ["required", "string", "max:255"],
            "bairro" => ["required", "string", "max:255"],
            "cidade" => ["required", "string", "max:255"],
            "unidade_federacao" => ["required", "string", "size:2"],
            "tipo" => ["required", "string", "max:255"],
            "contato" => ["required", "string"],
            "nome_pai" => ["required", "string", "max:255"],	
            "nome_mae" => ["required", "string", "max:255"],
            "tipo_estudante" => ["required", "string", "max:255"],
            "situacao_atual" => ["required", "string", "max:255"],
            "tipo_ingresso" => ["required", "string", "max:255"],
            "forma_ingresso" => ["required", "string", "max:255"],
            "tipo_vaga" => ["required", "string", "max:255"],
            "ultima_escola" => ["required", "string", "max:255"],
            "ident_educacenso" => ["required", "max:255"],
            "ano_ultima_serie" => ["required", "string", "max:255"],

        ];
    }
}
