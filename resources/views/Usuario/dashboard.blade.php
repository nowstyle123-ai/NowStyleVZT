<x-app-layout>
    <div style="background-color: #000000; min-height: 100vh; width: 100%; display: flex; flex-direction: column; font-family: sans-serif; box-sizing: border-box;">
        
        <div style="background-color: #09090b; border-bottom: 1px solid #27272a; padding: 1.5rem 2rem;">
            <div style="max-width: 1280px; margin: 0 auto;">
                <h2 style="font-weight: 900; font-size: 1.5rem; text-transform: uppercase; color: #ffffff; margin: 0; tracking: 0.05em;">
                    Inicio
                </h2>
            </div>
        </div>

        <div style="max-width: 1280px; width: 100%; margin: 3rem auto; padding: 0 2rem; box-sizing: border-box; flex-grow: 1;">
            
            <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; box-shadow: 0 10px 30px -15px rgba(220, 38, 38, 0.3); overflow: hidden;">
                
                <div style="padding: 2rem; color: #ffffff; font-size: 1rem; font-weight: 600;">
                    {{ __("Has iniciado sesion señor usuario") }}
                </div>

            </div>

        </div>
    </div>
</x-app-layout>