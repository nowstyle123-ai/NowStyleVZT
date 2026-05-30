<x-app-layout>
    <style>
        #profile-container label, 
        #profile-container .text-gray-800, 
        #profile-container .text-gray-600,
        #profile-container h2 {
            color: #ffffff !important;
        }
        #profile-container p, 
        #profile-container span {
            color: #a1a1aa !important;
        }
        #profile-container input {
            background-color: #000000 !important;
            border: 1px solid #27272a !important;
            color: #ffffff !important;
            border-radius: 0.5rem !important;
            padding: 0.5rem 0.75rem !important;
        }
    </style>

    <div id="profile-container" style="background-color: #000000; min-height: 100vh; width: 100%; display: flex; flex-direction: column; font-family: sans-serif; box-sizing: border-box; padding-bottom: 3rem;">
        
        <div style="background-color: #09090b; border-bottom: 1px solid #27272a; padding: 1.5rem 2rem;">
            <div style="max-width: 1280px; margin: 0 auto;">
                <h2 style="font-weight: 900; font-size: 1.5rem; text-transform: uppercase; color: #ffffff; margin: 0; tracking: 0.05em;">
                    Perfil
                </h2>
            </div>
        </div>

        <div style="max-width: 1280px; width: 100%; margin: 2rem auto 0 auto; padding: 0 2rem; box-sizing: border-box; display: flex; flex-direction: column; gap: 1.5rem;">
            
            <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; box-shadow: 0 10px 30px -15px rgba(220, 38, 38, 0.15); padding: 2rem;">
                <div style="max-width: 576px;">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; box-shadow: 0 10px 30px -15px rgba(220, 38, 38, 0.15); padding: 2rem;">
                <div style="max-width: 576px;">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; box-shadow: 0 10px 30px -15px rgba(220, 38, 38, 0.15); padding: 2rem;">
                <div style="max-width: 576px;">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
