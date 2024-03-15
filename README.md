<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="[https://github.com/laravel/framework/actions](https://docs.google.com/document/d/14KhQ4IK_8bX96fnbksWUQYr7HH3sboDPgIbKqNmy410/edit?usp=sharing)">docs</a>
</p>

## About Laravel

1º criar o model junto com o controller factories e migrations:
php artisan make:model invoice -fm


2º criar os controllers com recursos crud:
php artisan make:controller Api/V1/UserController -r
php artisan make:controller Api/V1/PaymentController --api

3º carregar as migrations

php artisan migrate
php artisan db:seed

instalar o xampp

instalar o compose e apontar

instalar o laravel 10:
composer create-project laravel/laravel:^10.0 nome-projeto

criar um banco:
se for mariadb no file database

'mariadb' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'database_name'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

factories:
$paid = $this->faker->boolean();
        return [
            'user_id' => User::all()->random()->id,
            'type' => $this->faker->randomElement(['B', 'C', 'P']),
            'paid' => $paid,
            'value' => $this->faker->numberBetween(1000, 10000),
            'payment_date' => $paid ? $this->faker->randomElement([$this->faker->dateTimeThisMonth()]) : NULL
        ];

return [
            'user_id' => User::all()->random()->id,
            'bio' => fake()->sentence(2),
        ];


Roteamento:

Route::prefix('api/v1')->group(function(){
    Route::get('/profiles', [ProfileController::class, 'index']);
    Route::get('/profiles/{profile}', [ProfileController::class, 'show']);
    Route::Post('/profiles', [ProfileController::class, 'store']);
    Route::Put('/profiles/{profile}', [ProfileController::class, 'update']);
    Route::delete('/profiles/{profile}', [ProfileController::class, 'destroy']);
});

Controller da api:
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //return Profile::all();
       return Profile::with('user')->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Profile::create($request->all());




    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profile = Profile::find($id);


        if($profile) {
            return response()->json($profile, 200);
        } else {
            return response()->json(['message' => 'Perfil não encontrado']);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profile = Profile::find($id);
        $profile->update($request->all());
        return response()->json($profile, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Profile::find($id)->delete();
    }
}

CSRF token mismatch:
 protected $except = [
        //
        'api/*',
        'api/v1/invoices'
    ];



