# DOKUMENTASI SISTEM BERITA ACARA

## 📋 OVERVIEW

Sistem Berita Acara adalah modul untuk mengelola 3 jenis berita acara:
1. **BA Temuan** - Berita acara temuan pelanggaran/kejadian
2. **BA Laka** - Berita acara kecelakaan lalu lintas
3. **BA Revisi** - Berita acara revisi data/sistem

## 🎯 BUSINESS REQUIREMENTS

### User Roles
- **Admin/HR**: Full access (CRUD semua BA)
- **Operator**: Create only (input BA baru)

### Navigation Flow
```
/berita-acara (Main Page)
├── Tab: BA Temuan
├── Tab: BA Laka  
└── Tab: BA Revisi

/berita-acara/create?type=[temuan|laka|revisi] (Create Form)
```

## 🗄️ DATABASE SCHEMA

### 1. tr_hr_ba_main (Main Table)
```sql
CREATE TABLE [dbo].[tr_hr_ba_main](
    [tr_hr_ba_id] [int] NOT NULL IDENTITY(1,1),
    [ms_user_id] [varchar](50) NULL,
    [date_ba] [date] NULL,
    [note_ba] [text] NULL,
    [ms_hr_ba_type_id] [varchar](50) NULL, -- 'TEMUAN', 'LAKA', 'REVISI'
    [pelaku_desc] [varchar](50) NULL,
    [created_at] [datetime] NULL,
    [updated_at] [datetime] NULL,
    CONSTRAINT [PK_tr_hr_ba] PRIMARY KEY ([tr_hr_ba_id])
)
```

### 2. tr_hr_ba_pelaku (Pelaku Table - untuk BA Temuan)
```sql
CREATE TABLE [dbo].[tr_hr_ba_pelaku](
    [tr_hr_ba_pelaku_id] [int] IDENTITY(1,1) NOT NULL,
    [tr_hr_ba_id] [int] NULL,
    [ms_user_id] [varchar](50) NULL,
    [text_ba] [varchar](50) NULL,
    [date_ba] [date] NULL,
    [ms_type_ba_pelaku_id] [varchar](50) NULL,
    [cek_fraud] [bit] NULL,
    [cek_pelanggaran] [bit] NULL,
    [cek_kode_etik] [bit] NULL,
    [cek_disiplin] [bit] NULL,
    [cek_berulang] [bit] NULL,
    CONSTRAINT [PK_tr_hr_ba_pelaku] PRIMARY KEY ([tr_hr_ba_pelaku_id]),
    FOREIGN KEY ([tr_hr_ba_id]) REFERENCES [tr_hr_ba_main]([tr_hr_ba_id])
)
```

### 3. tr_hr_ba_laka (Laka Table - untuk BA Laka)
```sql
CREATE TABLE [dbo].[tr_hr_ba_laka](
    [tr_hr_ba_laka_id] [int] NOT NULL IDENTITY(1,1),
    [tr_hr_ba_id] [int] NULL,
    [ms_truck_id] [varchar](50) NULL,
    [ms_driver_id] [varchar](50) NULL,
    [note_kronologi] [text] NULL,
    CONSTRAINT [PK_tr_hr_ba_laka] PRIMARY KEY ([tr_hr_ba_laka_id]),
    FOREIGN KEY ([tr_hr_ba_id]) REFERENCES [tr_hr_ba_main]([tr_hr_ba_id])
)
```

### 4. tr_hr_ba_revisi (Revisi Table - untuk BA Revisi)
```sql
CREATE TABLE [dbo].[tr_hr_ba_revisi](
    [tr_hr_ba_revisi_id] [int] NOT NULL IDENTITY(1,1),
    [tr_hr_ba_main_id] [int] NULL,
    [ms_user_id] [varchar](50) NULL,
    [field] [varchar](50) NULL,
    [qty_salah] [int] NULL,
    [qty_benar] [int] NULL,
    [date_salah] [date] NULL,
    [date_benar] [date] NULL,
    [money_salah] [money] NULL,
    [money_benar] [money] NULL,
    [text_salah] [varchar](50) NULL,
    [text_benar] [varchar](50) NULL,
    [reason_desc] [varchar](255) NULL,
    [database_name] [varchar](50) NULL,
    [field_name] [varchar](50) NULL,
    [migrasi_time] [datetime] NULL,
    [query_id] [text] NULL,
    CONSTRAINT [PK_tr_hr_ba_revisi] PRIMARY KEY ([tr_hr_ba_revisi_id]),
    FOREIGN KEY ([tr_hr_ba_main_id]) REFERENCES [tr_hr_ba_main]([tr_hr_ba_id])
)
```

## 🏗️ TECHNICAL ARCHITECTURE

### Models
```php
// app/Models/TrHrBaMain.php
class TrHrBaMain extends Model
{
    protected $table = 'tr_hr_ba_main';
    protected $primaryKey = 'tr_hr_ba_id';
    
    public function pelaku() // hasMany for BA Temuan
    public function laka()   // hasOne for BA Laka
    public function revisi() // hasMany for BA Revisi
}

// app/Models/TrHrBaPelaku.php
class TrHrBaPelaku extends Model

// app/Models/TrHrBaLaka.php  
class TrHrBaLaka extends Model

// app/Models/TrHrBaRevisi.php
class TrHrBaRevisi extends Model
```

### Controller
```php
// app/Http/Controllers/BeritaAcaraController.php
class BeritaAcaraController extends Controller
{
    public function index()     // Main page with tabs
    public function create()    // Dynamic create form
    public function store()     // Save BA data
    public function show($id)   // View BA detail
    public function edit($id)   // Edit form
    public function update($id) // Update BA
    public function destroy($id)// Delete BA
}
```

### Routes
```php
// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/berita-acara', [BeritaAcaraController::class, 'index'])
        ->name('berita-acara.index');
    
    // Admin/HR only routes
    Route::middleware(['admin'])->group(function () {
        Route::resource('berita-acara', BeritaAcaraController::class)
            ->except(['index']);
    });
    
    // Operator routes (create only)
    Route::get('/berita-acara/create', [BeritaAcaraController::class, 'create'])
        ->name('berita-acara.create');
    Route::post('/berita-acara', [BeritaAcaraController::class, 'store'])
        ->name('berita-acara.store');
});
```

## 🎨 UI/UX DESIGN

### Main Page Layout
```
┌─────────────────────────────────────────────────────────┐
│ 📋 Berita Acara Management                             │
├─────────────────────────────────────────────────────────┤
│ [BA Temuan] [BA Laka] [BA Revisi]                      │
├─────────────────────────────────────────────────────────┤
│ [🔍 Search] [📅 Filter Date] [+ Buat BA Baru]         │
├─────────────────────────────────────────────────────────┤
│ Table Data:                                            │
│ | ID | User | Tanggal | Catatan | Status | Actions |   │
│ |  1 | John | 01/11   | ...     | [🟢]   | [✏️][🗑️] │
│ |  2 | Jane | 02/11   | ...     | [🟡]   | [✏️][🗑️] │
├─────────────────────────────────────────────────────────┤
│ [« Previous] [1] [2] [3] [Next »]                      │
└─────────────────────────────────────────────────────────┘
```

### Create Form Layout
```
┌─────────────────────────────────────────────────────────┐
│ 📝 Buat Berita Acara [Type]                           │
├─────────────────────────────────────────────────────────┤
│ Form Utama:                                            │
│ • User ID (readonly - current user)                    │
│ • Tanggal BA                                           │
│ • Catatan/Deskripsi                                    │
│ • Pelaku (jika ada)                                    │
├─────────────────────────────────────────────────────────┤
│ Form Spesifik (Dynamic based on type):                 │
│                                                        │
│ BA TEMUAN:                                             │
│ [+ Add Pelaku] (repeatable section)                    │
│ • User ID Pelaku                                       │
│ • Text BA                                              │
│ • Tanggal                                              │
│ • Type Pelaku                                          │
│ • ☑ Fraud ☑ Pelanggaran ☑ Kode Etik                   │
│ • ☑ Disiplin ☑ Berulang                                │
│                                                        │
│ BA LAKA:                                               │
│ • Truck ID                                             │
│ • Driver ID                                            │
│ • Kronologi Kejadian                                   │
│                                                        │
│ BA REVISI:                                             │
│ [+ Add Revisi Item] (repeatable section)              │
│ • Field Name                                           │
│ • Data Salah | Data Benar                             │
│ • Reason & Migration Info                              │
├─────────────────────────────────────────────────────────┤
│ [💾 Simpan] [❌ Batal]                                  │
└─────────────────────────────────────────────────────────┘
```

## 🔧 FEATURES SPECIFICATION

### BA Temuan
- Form utama + Dynamic pelaku sections
- Add/Remove pelaku functionality
- Checkbox validations untuk jenis pelanggaran
- Multiple pelaku per BA

### BA Laka
- Form utama + Laka details
- Dropdown untuk Truck dan Driver (dari master tables)
- Text area untuk kronologi kejadian
- One-to-one relationship

### BA Revisi
- Form utama + Dynamic revisi items
- Before/After comparison fields
- Database migration tracking
- Multiple revisi items per BA

## 🔐 SECURITY & VALIDATION

### Middleware
- `auth`: All BA routes require login
- `admin`: Edit/Delete restricted to Admin/HR

### Form Validation
```php
// BA Main validation
'ms_user_id' => 'required|string|max:50',
'date_ba' => 'required|date',
'note_ba' => 'required|string',
'ms_hr_ba_type_id' => 'required|in:TEMUAN,LAKA,REVISI',

// BA Temuan validation (per pelaku)
'pelaku.*.ms_user_id' => 'required|string|max:50',
'pelaku.*.text_ba' => 'required|string|max:50',
// etc...

// BA Laka validation
'ms_truck_id' => 'required|string|max:50',
'ms_driver_id' => 'required|string|max:50',
'note_kronologi' => 'required|string',

// BA Revisi validation (per item)
'revisi.*.field' => 'required|string|max:50',
'revisi.*.reason_desc' => 'required|string',
// etc...
```

### CSRF Protection
- All forms include `@csrf` token
- AJAX calls include X-CSRF-TOKEN header

## 📱 RESPONSIVE DESIGN

### Bootstrap Components
- **Tabs**: Bootstrap nav-tabs for BA type switching
- **Cards**: Card layout for forms and data display
- **Tables**: Responsive table with horizontal scroll
- **Modals**: Confirmation dialogs with SweetAlert2
- **Forms**: Bootstrap form components with validation

### Mobile Adaptations
- Collapsible sidebar on mobile
- Responsive table with horizontal scroll
- Touch-friendly buttons and form elements
- Optimized spacing for mobile screens

## 🚀 IMPLEMENTATION ROADMAP

### Phase 1: Core Setup
1. ✅ Create Models
2. ✅ Create Migrations
3. ✅ Create Controller
4. ✅ Setup Routes

### Phase 2: UI Development
1. ✅ Main index page with tabs
2. ✅ Dynamic create form
3. ✅ Form validations
4. ✅ AJAX functionality

### Phase 3: Advanced Features
1. ✅ Search & filtering
2. ✅ Pagination
3. ✅ Role-based access
4. ✅ SweetAlert confirmations

### Phase 4: Testing & Polish
1. ✅ Form testing all scenarios
2. ✅ Responsive testing
3. ✅ Security testing
4. ✅ Performance optimization

## 📊 DATA FLOW

### Create BA Flow
```
User selects BA type → 
Dynamic form loads → 
User fills main data → 
User adds type-specific data → 
Form validates → 
Data saves to main table → 
Type-specific data saves to child tables → 
Success message → 
Redirect to index
```

### View BA Flow
```
User clicks tab → 
AJAX loads filtered data → 
Table updates → 
Pagination/Search available → 
Click actions for Admin/HR only
```

## 🔍 TESTING SCENARIOS

### BA Temuan
- Create BA with no pelaku (only main data)
- Create BA with single pelaku
- Create BA with multiple pelaku
- Edit/Delete pelaku in existing BA

### BA Laka  
- Create BA with complete laka data
- Validate truck/driver dropdowns
- Test kronologi text area

### BA Revisi
- Create BA with single revisi item
- Create BA with multiple revisi items
- Test before/after field comparisons
- Validate migration data fields

### Security Tests
- Operator access to edit/delete (should fail)
- Admin access to all functions
- CSRF validation
- Form injection attempts

---

## 📝 NOTES

1. **Auto-increment IDs**: All primary keys use IDENTITY(1,1)
2. **Master Tables**: Assume ms_truck, ms_driver tables exist
3. **User Integration**: Uses existing user system (ms_user_id)
4. **Date Formats**: All dates in Y-m-d format
5. **Text Fields**: Use textarea for long text, input for short text

---

**Document Version**: 1.0  
**Last Updated**: November 2, 2025  
**Author**: AI Assistant  
**Status**: Ready for Implementation ✅