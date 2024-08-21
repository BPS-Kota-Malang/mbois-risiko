    <?php
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\Admin\UserController;
    use App\Http\Controllers\ContextController;
    use App\Http\Controllers\Admin\RoleController;
    use App\Http\Controllers\Admin\PermissionController;
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
    // use App\Http\Controllers\Context\MatriksAnalisisController;
    use App\Http\Controllers\Context\MatriksAnalisisResikoController;
    use App\Http\Controllers\Context\PeraturanPerundangUndanganController;
    use App\Http\Controllers\EmployeeController;
    use App\Http\Controllers\IdentificationController;
    use App\Http\Controllers\PenyebabController;




    Route::get('/', function () {
        return view('auth.login');
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

        // Context
        Route::resource('/pemangkukepentingan', PemangkuKepentinganController::class, ['as' => 'admin']);
        Route::resource('/peraturan', PeraturanPerundangUndanganController::class, ['as' => 'admin']);
        Route::resource('/timproject', TimProjectController::class, ['as' => 'admin']);
        Route::resource('/jenisresiko', JenisResikoController::class, ['as' => 'admin']);
        Route::resource('/sumberresiko', SumberResikoController::class, ['as' => 'admin']);
        Route::resource('/kategoriresiko', KategoriResikoController::class, ['as' => 'admin']);
        Route::resource('/areadampak', AreaDampakController::class, ['as' => 'admin']);
        Route::resource('/levelkemungkinan', LevelKemungkinanController::class, ['as' => 'admin']);
        Route::resource('/leveldampak', LevelDampakController::class, ['as' => 'admin']);
        Route::resource('/kriteriakemungkinan', KriteriaKemungkinanController::class, ['as' => 'admin']);
        Route::resource('/kriteriadampak', KriteriaDampakController::class, ['as' => 'admin']);
        Route::resource('/levelresiko', LevelResikoController::class, ['as' => 'admin']);
        Route::resource('/matriksanalisisresiko', MatriksAnalisisResikoController::class, ['as' => 'admin']);
        Route::resource('/identification', IdentificationController::class, ['as' => 'admin']);
        Route::resource('/penyebab', PenyebabController::class, ['as' => 'admin']);


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
    });
    ?>




