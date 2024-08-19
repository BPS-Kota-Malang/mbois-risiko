    <?php

    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\Admin\UserController;
    use App\Http\Controllers\ContextController;
    use App\Http\Controllers\Context\PeraturanPerundangUndanganController;
    use App\Http\Controllers\Admin\RoleController;
    use App\Http\Controllers\Admin\PermissionController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\RiskController;
    use App\Http\Controllers\Context\TimProjectController;
    use App\Http\Controllers\Context\JenisResikoController;
    use App\Http\Controllers\Context\SumberResikoController;
    use App\Http\Controllers\Context\KategoriResikoController;
    use App\Http\Controllers\Context\AreaDampakController;
    use App\Http\Controllers\Context\LevelKemungkinanController;
    use App\Http\Controllers\Context\LevelDampakController;
    use App\Http\Controllers\Context\KriteriaKemungkinanController;
    use App\Http\Controllers\Context\KriteriaDampakController;
    use App\Http\Controllers\Context\LevelResikoController;
    use App\Http\Controllers\Context\MatriksAnalisisResikoController;
    use App\Http\Controllers\EmployeeController;
    use App\Http\Controllers\IdentificationController;
use App\Http\Controllers\InternController;




    Route::get('/', function () {
        return view('auth.login');
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/admin/risk/context', [ContextController::class, 'index'])->name('admin.risk.context');
    });


    Route::middleware('auth')->group(function () {
        // Sidebar
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Sidebar - Risk Management
        Route::get('/context', [ContextController::class, 'index'])->name('admin.risk.context');
        Route::get('/admin/risk/identification', [RiskController::class, 'identification'])->name('admin.risk.identification');
        Route::get('/admin/risk/analysis', [RiskController::class, 'analysis'])->name('admin.risk.analysis');
        Route::get('/admin/risk/evaluation', [RiskController::class, 'evaluation'])->name('admin.risk.evaluation');
        Route::get('/admin/risk/action_plan', [RiskController::class, 'actionPlan'])->name('admin.risk.action_plan');

        // Context - Pemangku Kepentingan
        Route::post('/admin/pemangku-kepentingan', [ContextController::class, 'storePemangkuKepentingan'])->name('admin.pemangku-kepentingan.store');
        Route::put('/admin/pemangku-kepentingan/{id}', [ContextController::class, 'updatePemangkuKepentingan'])->name('admin.pemangku-kepentingan.update');
        Route::delete('/admin/pemangku-kepentingan/{id}', [ContextController::class, 'destroyPemangkuKepentingan'])->name('admin.pemangku-kepentingan.delete');

        // Context - Peraturan Perundang-undangan
        Route::post('/admin/peraturan-perundang-undangan', [PeraturanPerundangUndanganController::class, 'storePeraturan'])->name('admin.peraturan-perundang-undangan.store');
        Route::put('/admin/peraturan-perundang-undangan/{id}', [PeraturanPerundangUndanganController::class, 'updatePeraturan'])->name('admin.peraturan-perundang-undangan.update');
        Route::delete('/admin/peraturan-perundang-undangan/{id}', [PeraturanPerundangUndanganController::class, 'destroyPeraturan'])->name('admin.peraturan-perundang-undangan.delete');

        // Context - Tim Project
        Route::post('/admin/tim-project', [TimProjectController::class, 'store'])->name('admin.tim-project.store');
        Route::put('/admin/tim-project/{id}', [TimProjectController::class, 'update'])->name('admin.tim-project.update');
        Route::delete('/admin/tim-project/{id}', [TimProjectController::class, 'destroy'])->name('admin.tim-project.delete');

        // // Context - Jenis Resiko
        Route::post('/admin/jenis-resiko', [JenisResikoController::class, 'storeJenisResiko'])->name('admin.jenis-resiko.store');
        Route::put('/admin/jenis-resiko/{id}', [JenisResikoController::class, 'updateJenisResiko'])->name('admin.jenis-resiko.update');
        Route::delete('/admin/jenis-resiko/{id}', [JenisResikoController::class, 'destroyJenisResiko'])->name('admin.jenis-resiko.delete');

        // // Context - Sumber Resiko
        Route::post('/admin/sumber-resiko', [SumberResikoController::class, 'storeSumberResiko'])->name('admin.sumber-resiko.store');
        Route::put('/admin/sumber-resiko/{id}', [SumberResikoController::class, 'updateSumberResiko'])->name('admin.sumber-resiko.update');
        Route::delete('/admin/sumber-resiko/{id}', [SumberResikoController::class, 'destroySumberResiko'])->name('admin.sumber-resiko.delete');

        // // Context - Kategori Resiko
        Route::post('/admin/kategori-resiko', [KategoriResikoController::class, 'storeKategoriResiko'])->name('admin.kategori-resiko.store');
        Route::put('/admin/kategori-resiko/{id}', [KategoriResikoController::class, 'updateKategoriResiko'])->name('admin.kategori-resiko.update');
        Route::delete('/admin/kategori-resiko/{id}', [KategoriResikoController::class, 'destroyKategoriResiko'])->name('admin.kategori-resiko.delete');

        // // Context - Area Dampak
        Route::post('/admin/area-dampak', [AreaDampakController::class, 'storeAreaDampak'])->name('admin.area-dampak.store');
        Route::put('/admin/area-dampak/{id}', [AreaDampakController::class, 'updateAreaDampak'])->name('admin.area-dampak.update');
        Route::delete('/admin/area-dampak/{id}', [AreaDampakController::class, 'destroyAreaDampak'])->name('admin.area-dampak.delete');

        // // Context - Level Kemungkinan
        Route::post('/admin/level-kemungkinan', [LevelKemungkinanController::class, 'storeLevelKemungkinan'])->name('admin.level-kemungkinan.store');
        Route::put('/admin/level-kemungkinan/{id}', [LevelKemungkinanController::class, 'updateLevelKemungkinan'])->name('admin.level-kemungkinan.update');
        Route::delete('/admin/level-kemungkinan/{id}', [LevelKemungkinanController::class, 'destroyLevelKemungkinan'])->name('admin.level-kemungkinan.delete');

        // // Context - Level Dampak
        Route::post('/admin/level-dampak', [LevelDampakController::class, 'storeLevelDampak'])->name('admin.level-dampak.store');
        Route::put('/admin/level-dampak/{id}', [LevelDampakController::class, 'updateLevelDampak'])->name('admin.level-dampak.update');
        Route::delete('/admin/level-dampak/{id}', [LevelDampakController::class, 'destroyLevelDampak'])->name('admin.level-dampak.delete');

        // // Context - Kriteria Kemungkinan
        Route::post('/admin/kriteria-kemungkinan', [KriteriaKemungkinanController::class, 'storeKriteriaKemungkinan'])->name('admin.kriteria-kemungkinan.store');
        Route::put('/admin/kriteria-kemungkinan/{id}', [KriteriaKemungkinanController::class, 'updateKriteriaKemungkinan'])->name('admin.kriteria-kemungkinan.update');
        Route::delete('/admin/kriteria-kemungkinan/{id}', [KriteriaKemungkinanController::class, 'destroyKriteriaKemungkinan'])->name('admin.kriteria-kemungkinan.delete');

        // // Context - Kriteria Dampak
        Route::post('/admin/kriteria-dampak', [KriteriaDampakController::class, 'storeKriteriaDampak'])->name('admin.kriteria-dampak.store');
        Route::put('/admin/kriteria-dampak/{id}', [KriteriaDampakController::class, 'updateKriteriaDampak'])->name('admin.kriteria-dampak.update');
        Route::delete('/admin/kriteria-dampak/{id}', [KriteriaDampakController::class, 'destroyKriteriaDampak'])->name('admin.kriteria-dampak.delete');

        // Context - Level Resiko
        Route::post('/admin/level-resiko', [LevelResikoController::class, 'storeLevelResiko'])->name('admin.level-resiko.store');
        Route::put('/admin/level-resiko/{id}', [LevelResikoController::class, 'updateLevelResiko'])->name('admin.level-resiko.update');
        Route::delete('/admin/level-resiko/{id}', [LevelResikoController::class, 'destroyLevelResiko'])->name('admin.level-resiko.delete');

        Route::post('/admin/matriks-analisis-resiko', [MatriksAnalisisResikoController::class, 'storeMatriksAnalisisResiko'])->name('admin.matriks-analisis-resiko.store');
        Route::put('/admin/matriks-analisis-resiko/{id}', [MatriksAnalisisResikoController::class, 'updateMatriksAnalisisResiko'])->name('admin.matriks-analisis-resiko.update');
        Route::delete('/admin/matriks-analisis-resiko/{id}', [MatriksAnalisisResikoController::class, 'destroyMatriksAnalisisResiko'])->name('admin.matriks-analisis-resiko.delete');

        // // Context - Selera Resiko
        // Route::post('/admin/selera-resiko', [SeleraResikoController::class, 'store'])->name('admin.selera-resiko.store');
        // Route::put('/admin/selera-resiko/{id}', [SeleraResikoController::class, 'update'])->name('admin.selera-resiko.update');
        // Route::delete('/admin/selera-resiko/{id}', [SeleraResikoController::class, 'destroy'])->name('admin.selera-resiko.delete');

        // // Context - Opsi Penanganan
        // Route::post('/admin/opsi-penanganan', [OpsiPenangananController::class, 'store'])->name('admin.opsi-penanganan.store');
        // Route::put('/admin/opsi-penanganan/{id}', [OpsiPenangananController::class, 'update'])->name('admin.opsi-penanganan.update');
        // Route::delete('/admin/opsi-penanganan/{id}', [OpsiPenangananController::class, 'destroy'])->name('admin.opsi-penanganan.delete');
    });


    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/forms', [ContextController::class, 'forms'])->name('admin.forms');
        Route::get('/tables', [ContextController::class, 'tables'])->name('admin.tables');
        Route::get('/ui-elements', [ContextController::class, 'uiElements'])->name('admin.ui-elements');
    });

    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
    });

    require __DIR__ . '/auth.php';

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/admin/dashboard', [ContextController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/employee', [EmployeeController::class, 'index'])->name('admin.employee');
        Route::get('/admin/employee', [EmployeeController::class, 'showEmployees'])->name('admin.employee');
        Route::get('/admin/employee/create', [EmployeeController::class, 'create'])->name('admin.employee.create');
        Route::post('/admin/employee', [EmployeeController::class, 'store'])->name('admin.employee.store');
        Route::get('/admin/employee/{user_id}/edit', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
        Route::put('/admin/employee/{user_id}', [EmployeeController::class, 'update'])->name('admin.employee.update');
        Route::get('/admin/employee/{user_id}', [EmployeeController::class, 'destroy'])->name('admin.employee.destroy');
        Route::post('admin/employee/upload', [EmployeeController::class, 'upload'])->name('admin.employee.upload');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/identification', [IdentificationController::class, 'showIdentification'])->name('identification.index');
        Route::post('/save-penyebab', [IdentificationController::class, 'savePenyebab'])->name('savePenyebab');


    });

    Route::resource('interns', InternController::class);
