<div class="w-full  min-h-screen flex justify-center items-center bg-emerald-400">
    @section('title')
        Login
    @endsection
    <div class="py-2 5 px-3 rounded-md shadow-sm shadow-gray-400/50 w-[95%] md:w-[85%] lg:w-1/2 bg-white">
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
                            class="rounded-lg border border-gray-300 py-2 px-3 transition duration-200 focus:border-blue-300 focus:ring focus:ring-blue-100 w-full"
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
                            class="rounded-lg border border-gray-300 py-2 px-3 transition duration-200 focus:border-blue-300 focus:ring focus:ring-blue-100 w-full"
                            placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input wire:model='password_confirmation' type="password"
                            class="rounded-lg border border-gray-300 py-2 px-3 transition duration-200 focus:border-blue-300 focus:ring focus:ring-blue-100 w-full"
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
                                class="rounded-md py-2.5 px-3 shadow-sm shadow-gray-400/50 border font-sans">Sign
                                In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                {{-- <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center hover:text-emerald-400">Register a new
                        membership</a>
                </p> --}}
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
