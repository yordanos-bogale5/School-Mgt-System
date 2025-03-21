<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Subject permissions
            'view_subject',
            'view_any_subject',
            'create_subject',
            'update_subject',
            'delete_subject',
            'delete_any_subject',

            // Grade permissions
            'view_grade',
            'view_any_grade',
            'create_grade',
            'update_grade',
            'delete_grade',
            'delete_any_grade',

            // StudentGrade permissions
            'view_student::grade',
            'view_any_student::grade',
            'create_student::grade',
            'update_student::grade',
            'delete_student::grade',
            'delete_any_student::grade',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $teacherRole = Role::firstOrCreate(['name' => 'teacher']);
        $teacherRole->givePermissionTo([
            'view_subject',
            'view_any_subject',
            'view_grade',
            'view_any_grade',
            'view_student::grade',
            'view_any_student::grade',
            'create_student::grade',
            'update_student::grade',
            'delete_student::grade',
            'delete_any_student::grade',
        ]);

        $studentRole = Role::firstOrCreate(['name' => 'student']);
        $studentRole->givePermissionTo([
            'view_student::grade',
        ]);
    }
}
