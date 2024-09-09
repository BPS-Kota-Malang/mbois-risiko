<?php
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\Admin\UserController;
    use App\Http\Controllers\ContextController;
    use App\Http\Controllers\Admin\RoleController;
    use App\Http\Controllers\Admin\PermissionController;
    use App\Http\Controllers\AnalisisController;
    use App\Http\Controllers\Context\PemangkuKepentinganController;
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
    use App\Http\Controllers\Context\SeleraResikoController;
    use App\Http\Controllers\Context\PeraturanPerundangUndanganController;
    use App\Http\Controllers\EmployeeController;
    use App\Http\Controllers\IdentificationController;
    use App\Http\Controllers\PenyebabController;
    use App\Http\Controllers\ResikoController;
    use App\Http\Controllers\Context\OpsiPenangananController;
    use App\Http\Controllers\Context\ProsesBisnisController;
    use App\Http\Controllers\DampakController;
    use App\Http\Controllers\UraianContoller;
    use App\Http\Controllers\ManajemenResikoController;



Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Sidebar
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Sidebar - Risk Management
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/context', [ContextController::class, 'index'])->name('admin.risk.context');
    Route::get('/admin/risk/analysis', [RiskController::class, 'analysis'])->name('admin.risk.analysis');
    Route::get('/admin/risk/evaluation', [RiskController::class, 'evaluation'])->name('admin.risk.evaluation');
    Route::get('/admin/risk/action_plan', [RiskController::class, 'actionPlan'])->name('admin.risk.action_plan');


    Route::resource('/pemangkukepentingan', PemangkuKepentinganController::class, ['as' => 'admin']);
    Route::resource('/peraturan', PeraturanPerundangUndanganController::class, ['as' => 'admin']);
    Route::resource('/timproject', TimProjectController::class, ['as' => 'admin']);
    Route::resource('/jenisresiko', JenisResikoController::class, ['as' => 'admin']);
    Route::resource('/sumberresiko', SumberResikoController::class, ['as' => 'admin']);
    Route::resource('/kategoriresiko', KategoriResikoController::class, ['as' => 'admin']);
    Route::resource('/areadampak', AreaDampakController::class, ['as' => 'admin']);
    Route::resource('/levelkemungkinan', LevelKemungkinanController::class, ['as' => 'admin']);
    Route::resource('/leveldampak', LevelDampakController::class, ['as' => 'admin']);
    Route::resource('/admin/kriteriakemungkinan', KriteriaKemungkinanController::class, ['as' => 'admin']);
    Route::resource('/kriteriadampak', KriteriaDampakController::class, ['as' => 'admin']);
    Route::resource('/levelresiko', LevelResikoController::class, ['as' => 'admin']);
    Route::resource('/matriksanalisisresiko', MatriksAnalisisResikoController::class, ['as' => 'admin']);
    Route::resource('/seleraresiko', SeleraResikoController::class, ['as' => 'admin']);
    Route::resource('/opsipenanganan', OpsiPenangananController::class, ['as' => 'admin']);
    Route::resource('/prosesbisnis', ProsesBisnisController::class, ['as' => 'admin']);
    Route::resource('/identification', IdentificationController::class, ['as' => 'admin']);
    Route::resource('/resiko', ResikoController::class, ['as' => 'admin']);

    //penyebab
    Route::resource('/penyebab', PenyebabController::class, ['as' => 'admin']);
    Route::get('/api/penyebab', [PenyebabController::class, 'getPenyebabData'])->name('admin.getpenyebabdata');
    Route::put('admin/penyebab/{id}', [PenyebabController::class, 'update'])->name('admin.penyebab.update.custom');



    // Route::get('admin/getselectedpenyebab/{id}', [PenyebabController::class, 'getSelectedPenyebab'])->name('admin.getselectedpenyebab');

    //dampak
    Route::resource('/dampak', DampakController::class, ['as' => 'admin']);
    Route::get('/api/dampak', [DampakController::class, 'getDampakData'])->name('admin.getdampakdata');
    Route::put('admin/dampak/{id}', [DampakController::class, 'update'])->name('admin.dampak.update.custom');


    //uraian
    Route::resource('/uraian', UraianContoller::class, ['as' => 'admin']);
    Route::get('/api/uraian', [UraianContoller::class, 'getUraianData'])->name('admin.geturaiandata');

    //resiko
    Route::resource('/resiko', ResikoController::class, ['as' => 'admin']);
    Route::get('/api/resiko', [ResikoController::class, 'getResikoData'])->name('admin.getresikodata');
    Route::put('admin/resiko/{id}', [ResikoController::class, 'update'])->name('admin.resiko.update.custom');


    Route::post('/initialStoreRisk', [ManajemenResikoController::class, 'initialStore'])->name('admin.manajemenresiko.initialstore');
    Route::resource('/manajemenrisiko', ManajemenResikoController::class, ['as' => 'admin']);
;   Route::post('/admin/manajemenresiko/savedampak', [ManajemenResikoController::class, 'saveDampak'])->name('admin.manajemenresiko.savedampak');
    Route::post('/admin/manajemenresiko/savepenyebab', [ManajemenResikoController::class, 'savePenyebab'])->name('admin.manajemenresiko.savepenyebab');
    Route::post('/admin/analisis/saveuraian', [AnalisisController::class, 'saveUraian'])->name('admin.analisis.saveuraian');
    Route::get('/admin/manajemenresiko/hapuspenyebab/{id}/{penyebab}', [ManajemenResikoController::class, 'hapusPenyebab']);
    Route::get('/admin/manajemenresiko/hapusdampak/{id}/{dampak}', [ManajemenResikoController::class, 'hapusDampak']);
    Route::get('/admin/analisis/hapusuraian/{id}/{uraian}', [AnalisisController::class, 'hapusUraian']);
    Route::resource('/analisis', AnalisisController::class, ['as' => 'admin']);



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
    });;

    require __DIR__ . '/auth.php';

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/admin/employee', [EmployeeController::class, 'index'])->name('admin.employee');
        Route::get('/admin/employee', [EmployeeController::class, 'showEmployees'])->name('admin.employee');
        Route::get('/admin/employee/create', [EmployeeController::class, 'create'])->name('admin.employee.create');
        Route::post('/admin/employee', [EmployeeController::class, 'store'])->name('admin.employee.store');
        Route::get('/admin/employee/{user_id}/edit', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
        Route::put('/admin/employee/{user_id}', [EmployeeController::class, 'update'])->name('admin.employee.update');
        Route::get('/admin/employee/{user_id}', [EmployeeController::class, 'destroy'])->name('admin.employee.destroy');
        Route::post('admin/employee/upload', [EmployeeController::class, 'upload'])->name('admin.employee.upload');
        Route::post('/admin/kriteriakemungkinan', [KriteriaKemungkinanController::class, 'store'])->name('admin.kriteriakemungkinan.store');

    });
    ?>
