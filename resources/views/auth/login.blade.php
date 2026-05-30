<div style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: #000000; display: flex; align-items: center; justify-content: center; padding: 1rem; box-sizing: border-box; z-index: 9999; overflow-y: auto;">
    
    <div style="position: absolute; width: 600px; height: 600px; background: radial-gradient(circle, rgba(220,38,38,0.25) 0%, rgba(0,0,0,0) 70%); top: 50%; left: 50%; transform: translate(-50%, -50%); pointer-events: none; z-index: 1;"></div>

    <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; box-shadow: 0 0 50px -10px rgba(220, 38, 38, 0.4); width: 100%; max-width: 400px; padding: 2.5rem; position: relative; z-index: 10; box-sizing: border-box;">
        
        <div style="position: absolute; top: 0; left: 20%; right: 20%; height: 2px; background: linear-gradient(to right, transparent, #dc2626, transparent);"></div>

        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="color: #ffffff; font-size: 1.8rem; font-weight: 900; letter-spacing: 0.05em; text-transform: uppercase; margin: 0; font-family: sans-serif;">
                NowStyle<span style="color: #dc2626;">VZT</span>
            </h1>
            <p style="color: #a1a1aa; font-size: 11px; font-weight: bold; letter-spacing: 0.2em; text-transform: uppercase; margin-top: 0.4rem; margin-bottom: 0; font-family: sans-serif;">
                Diseña • Personaliza • Destaca
            </p>
        </div>

        @if (session('status'))
            <div style="margin-bottom: 1rem; text-align: center; color: #f87171; font-size: 0.85rem; font-weight: 600; font-family: sans-serif;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" style="display: flex; flex-direction: column; gap: 1.25rem; margin: 0; font-family: sans-serif;">
            @csrf

            <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                <label style="color: #a1a1aa; font-size: 10px; font-weight: bold; text-transform: uppercase; tracking: 0.1em;">Nombre de usuario</label>
                <input type="text" name="username" value="{{ old('username') }}" required placeholder="Tu usuario" autofocus
                    style="width: 100%; padding: 0.75rem 1rem; border-radius: 0.75rem; background-color: #000000; border: 1px solid #27272a; color: #ffffff; font-size: 0.875rem; box-sizing: border-box; outline: none;">
                <x-input-error :messages="$errors->get('username')" class="mt-1" style="color: #f87171; font-size: 0.75rem;" />
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                <label style="color: #a1a1aa; font-size: 10px; font-weight: bold; text-transform: uppercase; tracking: 0.1em;">Contraseña</label>
                <input type="password" name="password" required placeholder="••••••••"
                    style="width: 100%; padding: 0.75rem 1rem; border-radius: 0.75rem; background-color: #000000; border: 1px solid #27272a; color: #ffffff; font-size: 0.875rem; box-sizing: border-box; outline: none;">
                <x-input-error :messages="$errors->get('password')" class="mt-1" style="color: #f87171; font-size: 0.75rem;" />
            </div>

            <div style="display: flex; items-center; justify-content: space-between; font-size: 0.75rem; margin-top: 0.2rem;">
                <label style="color: #a1a1aa; display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="remember" style="accent-color: #dc2626;">
                    Recuérdame
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="color: #a1a1aa; text-decoration: none;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#a1a1aa'">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <button type="submit" style="width: 100%; margin-top: 0.5rem; background-color: #dc2626; color: #ffffff; padding: 0.85rem; border: none; border-radius: 0.75rem; font-weight: bold; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; cursor: pointer; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2); transition: background 0.2s;" onmouseover="this.style.backgroundColor='#b91c1c'" onmouseout="this.style.backgroundColor='#dc2626'">
                Iniciar sesión
            </button>

            <p style="text-align: center; font-size: 0.75rem; color: #71717a; margin: 0; margin-top: 0.5rem;">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" style="color: #dc2626; font-weight: bold; text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                    CREAR CUENTA
                </a>
            </p>

        </form>
    </div>
</div>