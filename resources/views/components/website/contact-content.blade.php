<section class="pt-4 lg:pt-16 pb-16">
    <div class="container mx-auto">
        <div class="row">
            <div class="grid grid-cols-1 md:grid-cols-6 mx-auto w-full lg:w-9/12 shadow-2xl py-8 px-4 lg:px-8 bg-white contact-inner">

                <div class="gd-1 col-span-3 mr-0 md:mr-20">

                    <form id="contact-form" method="post" action="{{ route('contact-form.send') }}" class="w-full pt-2 mx-auto">
                        <h2 class="orange text-3xl font-bold pb-8">Get In Touch</h2>
                        <p class="text-gray-500 whitespace-nowrap"><i class="fas fa-map-marker-alt pr-3 pb-5 text-2xl orange relative" style="top: 3px;"></i> 135 Easter Road, Edinburgh, EH7 5QA</p>
                        <p class="text-gray-500"><i class="fas fa-phone-alt pr-3 pb-5 text-2xl orange relative" style="top: 3px;"></i> 0330 121 0220 </p>
                        <p class="text-gray-500"><i class="far fa-envelope pr-3 pb-5 text-2xl orange relative" style="top: 5px;"></i> <a class="orange" href="mailto:contact@onespoke.co.uk?subject={{ config('app.name') }} Enquiry">contact@onespoke.co.uk</a></p>

                        <div class="flex flex-wrap pt-8">
                            <div class="w-full md:w-1/2 px-3 mb-3">
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="name" type="text" placeholder="Name" name="name" value="{{ auth()->user()->name ?? '' }}">
                                <div class="error text-red-400"></div>
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-3">
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" placeholder="Email Address" name="email" value="{{ auth()->user()->email ?? '' }}">
                                <div class="error text-red-400"></div>
                            </div>
                        </div>

                        <div class="flex flex-wrap mb-6">
                            <div class="w-full px-3">
                                <textarea class="border rounded-md w-full h-full appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="message" placeholder="Write your message here" name="message"></textarea>
                                <div class="error text-red-400"></div>
                            </div>
                        </div>

                        <button class="mt-8 blue-btn w-full text-white rounded-xl uppercase">
                            Send
                        </button>

                    </form>
                </div>

                <div class="gd-2 col-span-3 w-full d-block mt-12">
                    <iframe width="100%" height="100%" class="mx-auto rounded" frameborder="0" title="map" marginheight="0" marginwidth="0" scrolling="no" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q={{ urlencode('135 Easter Road, Edinburgh, EH7 5QA') }}&amp;ie=UTF8&amp;t=&amp;z=13&amp;iwloc=B&amp;output=embed" style="filter: grayscale(0.1) contrast(1.9) opacity(0.8);"></iframe>
                </div>

            </div>
        </div>
    </div>
</section>
