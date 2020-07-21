<?php

namespace App\Exports;

use App\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class StudentExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $student = DB::table('students')
        ->select(
            "students.student_registration", "users.name", "users.last_name", "users.email",
            "users.gender", "users.date_of_birth", "users.identity_rg", "users.identity_em_dt",
            "users.identity_issuing_authority", "users.cpf", "students.student_type", "students.mather_name",
            "students.father_name", "students.actual_situation", "student_complements.ingress_type", "student_complements.ingress_form",
            "student_complements.vagacy_type", "student_complements.last_school",  "student_complements.ident_educacenso",  "student_complements.year_last_grade",
            "localities.cep", "localities.public_place", "localities.neighborhood", "users.num_residence",
            "users.complement_residence", "localities.cep", "localities.city", "localities.federation_unit",
            "contacts.type", "contacts.contact", "students.created_at"
         )
        ->join("users", "students.user_id", "=", "users.user_id")
        ->join("student_complements","students.student_registration", "=", "student_complements.student_registration")
        ->join("localities", "users.cep_user", "=", "localities.cep")
        ->join("contacts", "students.user_id", "=", "contacts.user_id")
        ->where("students.deleted_at", "=", null)
        ->get();

    }
}
