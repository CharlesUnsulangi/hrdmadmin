
# Modul Utama Aplikasi HRD

1. Manajemen Pelamar
2. Manajemen Interview
3. Manajemen Register Karyawan
4. Manajemen PKWT/PKWTT
5. Manajemen Payroll
6. Manajemen Absensi & Cuti
7. Manajemen Assessment
8. Manajemen Berita Acara

# AI Safety Guidelines for Project Development



**Framework & Auth Notice:**
Proyek ini menggunakan **Laravel 11** (bukan 12) karena versi 12 masih baru dan belum terbukti stabil untuk kebutuhan produksi. Semua pengembangan, dependency, dan dokumentasi harus mengacu pada Laravel 11.

Autentikasi menggunakan **Laravel Breeze** (Livewire + Alpine) sesuai best practice Laravel 11. Testing menggunakan **Pest** (jika dependency kompatibel) atau **PHPUnit 11**.

This document outlines the mandatory safety and quality guidelines that must be followed by the AI assistant during the development of this project. Adherence to these rules is critical for ensuring a stable, secure, and high-quality codebase.

## 1. Core Principles

- **Safety First**: The AI's primary directive is to prevent harm. This includes preventing security vulnerabilities, data loss, and the creation of unstable or unreliable code.
- **Adherence to Instructions**: The AI must strictly follow all instructions and guidelines provided by the user.
- **Transparency**: The AI must clearly explain its actions, the reasons for its choices, and any potential risks involved.
- **Quality over Speed**: Writing high-quality, well-tested, and maintainable code is more important than delivering code quickly.

## 2. Development Workflow

### 2.1. Version Control (Git)
- **Mandatory Git**: All code changes must be managed through Git.
- **Atomic Commits**: Each commit should represent a single logical change. Commits like "fix stuff" or "add code" are unacceptable. Commit messages must be descriptive and clear.
- **Branching**: All new features or significant changes must be developed in a separate feature branch, not directly on `main`.
- **No Force Pushing**: Force pushing (`git push --force`) to the `main` branch is strictly forbidden unless explicitly approved by the user for a repository reset.

### 2.2. Dependency Management
- **Stable Dependencies**: Only stable, well-maintained, and widely-used libraries and packages may be installed.
- **No `dev-main` or `dev-master`**: Installing development branches of packages is strictly forbidden unless explicitly instructed by the user after discussing the risks. The AI must always prefer stable releases (e.g., `^1.2.3`).
- **Composer and NPM**: Use Composer for PHP dependencies and NPM for JavaScript dependencies. All dependencies must be properly declared in `composer.json` and `package.json`.

### 2.3. Testing
- **PHPUnit 11 for Testing**: Testing utama menggunakan PHPUnit 11, yang sudah modern dan didukung Laravel 11. Pest dapat digunakan jika dependency kompatibel, namun jika terjadi konflik dependency, gunakan PHPUnit saja.
- **Test-Driven Development (TDD)**: While full TDD is not mandatory for every change, the principle of "write tests" is. All new functionality must be accompanied by corresponding tests.
- **Test Coverage**: The goal is to maintain high test coverage. The AI should be prepared to write tests that cover new code and edge cases.
- **Passing Tests**: All tests must pass before any code is considered "complete" or ready to be committed. The AI must run the test suite after making changes to ensure nothing has broken.

## 3. Coding Standards

### 3.1. Laravel and PHP
- **Laravel Best Practices**: The AI must follow official Laravel conventions and best practices. This includes proper use of Eloquent, service containers, middleware, and request validation.
- **Code Style**: Code must adhere to the PSR-12 standard. The project will use Laravel Pint to automatically enforce this. The AI must ensure its generated code is compliant.
- **Security**:
    - **SQL Injection**: All database queries must use Eloquent's query builder or parameterized queries to prevent SQL injection. Raw SQL queries (`DB::raw()`) are forbidden without explicit user approval.
    - **Cross-Site Scripting (XSS)**: All user-provided data rendered in views must be escaped using Blade's `{{ }}` syntax.
    - **Cross-Site Request Forgery (CSRF)**: All forms must be protected with Blade's `@csrf` directive.
    - **Mass Assignment**: Eloquent models must use the `$fillable` or `$guarded` properties to protect against mass assignment vulnerabilities.

### 3.2. Frontend (Vue.js and Alpine.js)
- **Component-Based**: Frontend logic should be organized into reusable components.
- **Clear Separation**: Maintain a clear separation between presentation (HTML/CSS), logic (JavaScript), and data.
- **Livewire and Alpine.js**: For simple interactivity, prefer Alpine.js. For more complex, stateful components that need to interact with the backend, use Livewire.

## 4. AI Interaction Protocol

- **Confirmation Required**: Before performing any destructive action (e.g., deleting files, force-pushing, resetting the database), the AI must ask for and receive explicit confirmation from the user.
- **Problem Reporting**: If the AI encounters a problem it cannot solve (e.g., a dependency conflict, a failing test it cannot fix), it must stop and report the issue to the user with all relevant context and logs.
- **Self-Correction**: If the AI realizes it has made a mistake, it must immediately inform the user and propose a plan to correct it.

By following these guidelines, the AI will act as a reliable and safe development partner, contributing to a robust and successful project.
