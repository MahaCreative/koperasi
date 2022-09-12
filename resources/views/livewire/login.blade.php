<div class="w-full  min-h-screen flex justify-center items-center bg-emerald-400">
    @section('title')
        Login
    @endsection
    <div class="shadow-md shadow-gray-500/50 border rounded-md w-96 p-2 bg-white">
        <div class="flex flex-col justify-center items-center">
            <h3 class="font-semibold text-xl text-emerald-400">
                <a href="{{ route('home') }}">{{ $profile->nama_koperasi }}</a>
            </h3>
            <img class="image-grayscale w-40 my-4" src="{{ asset($profile->takeImage) }}" alt="">
        </div>
        <div class="flex flex-col">
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form wire:submit.prevent="loginHandler">
                    <div class="input-group mb-3">
                        <input wire:model='email' type="email"
                            class="border text-sm lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2 w-full"
                            placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <p class="text-red-500 italic text-sm">{{ $message }}</p>
                    @enderror
                    <div class="input-group mb-3">
                        <input wire:model='password' type="password"
                            class="border text-sm lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2 w-full"
                            placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input wire:model='password_confirmation' type="password"
                            class="border text-sm lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2 w-full"
                            placeholder="Password confirmation">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <p class="text-red-500 italic text-sm">{{ $message }}</p>
                    @enderror
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit"
                                class="border text-sm lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">Sign
                                In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center hover:text-emerald-400">Register a new
                        membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
