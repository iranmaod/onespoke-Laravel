<section class="aboutsec">
    <div class="container mx-auto w-3/5">
        <div class="grid grid-cols-2 gap-12">

            <div class="pt-20">
                <img src="/images/mehdi-and-kaz.jpg" class="rounded" alt="Mehdi and Kaz">
            </div>


            <div class="pt-4">
                <p class="pt-3 text-gray-500 md:pt-4 lg:pt-10 xl:pt-14 mx-auto">
                    {{ config('app.name') }} is an online bicycle marketplace based in the UK, aiming to make buying or selling a bicycle as easy and accessible as possible. As a business, {{ config('app.name') }} aims to change the way in which the UK shops for bicycles by providing a dedicated platform which enables bicycle retailers throughout the country to sell online. Using our platform ensures that when you are hunting for a new or used bicycle you can choose from not only local retailers but also individuals giving greater diversity and broadening your search.
                    <br><br>
                    {{ config('app.name') }} is an online based marketplace led by its co-founders Mehdi Lachhab (Left) & Karim Abbassi-Khalili (Right). Founded in 2021, the rapidly evolving platform aims to give the ever growing cycling community a simple way to buy & sell.
                    <br><br>
                    As we all make greener & more sustainable life choices, we see {{ config('app.name') }} growing and developing into the leading bicycle marketplace and community throughout the UK and as such we love to hear feedback and suggestions so please <a href="{{ route('website.contact') }}" class="orange" title="Contact Us">get in touch</a> today
                </p>
            </div>

        </div>
    </div>
</section>

<section class="aboutsec2">
    <div class="container mx-auto">

        <div class="grid about-grid2 text-center pt-14">
            <h1 class="text-5xl uppercase font-bold dblue">Why Choose <span class="orange"> Us? </span></h1>
        </div>

        <div class="row">
            <div class="grid md:grid-cols-3 gap-4 w-4/5 mx-auto pt-20 pb-20">
                <div>
                    <h2 class="text-3xl font-bold text-gray-500">01</h2>
                    <h3 class="text-2xl font-bold pt-5">It's free!</h3>
                    <p class="text-gray-500 pt-8">
                        {{ config('app.name') }} is currently a free to use site as we want to encourage all sellers/buyers to use a more trusted and dedicated platform. We know selling bikes on free platforms can often encourage more spam or fraudulent users so we continually monitor all ads and our user base to ensure our valued users are getting the safest platform possible. List your bike today <a class="orange" href="{{ route('website.sell') }}" title="Sell your bike on {{ config('app.name') }}">HERE</a>
                    </p>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-500">02</h2>
                    <h3 class="text-2xl font-bold pt-5">We are a UK National Site</h3>
                    <p class="text-gray-500 pt-8">
                        {{ config('app.name') }} is a nationwide site, meaning your bike is visible to all potential buyers up and down the country. We know sometimes choosing a bike isn’t as easy as shopping local so we’ve opened {{ config('app.name') }} for use throughout the UK meaning that perfect bike is in reaching distance. From a selling point of view, this opens your market to a larger audience meaning a higher chance of sale!
                    </p>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-500">03</h2>
                    <h3 class="text-2xl font-bold pt-5">Custom Built Site</h3>
                    <p class="text-gray-500 pt-8">
                        {{ config('app.name') }} is developed by cyclists FOR cyclists. We have designed {{ config('app.name') }} from the ground up ensuring no stone is left unturned. We are truly proud to have created the bicycle marketplace the UK demands! If you believe we have missed something that may improve your selling experience, get in touch with one of our team <a href="{{ route('website.contact') }}" class="orange" title="Contact us">CLICK HERE</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="hidden about-testimonial pt-14">
    <div class="container mx-auto ">
        <div class="row">
            <div class="grid about-grid2 text-center w-2/5 mx-auto">
                <h1 class="text-5xl uppercase font-bold dblue">WHAT <span class="orange"> PEOPLE </span> SAY ABOUT <span class="orange"> US </span></h1>
            </div>
            <div class="slideshow-container">
                <div class="mySlides text-center w-1/2 mx-auto">
                    <q>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam,</q>
                    <p class="author">- ProjectRide</p>
                    <img src="./images/testi1.png" class="mx-auto" width="75px">
                </div>
                <div class="mySlides text-center w-1/2 mx-auto">
                    <q>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                        nisi ut aliquip ex ea commodo consequat.</q>
                    <p class="author">- John Keats</p>
                    <img src="./images/testi2.png" class="mx-auto" width="75px">
                </div>
                <div class="mySlides text-center w-1/2 mx-auto">
                    <q>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam,</q>
                    <p class="author">- John Wick</p>
                    <img src="./images/testi3.png" class="mx-auto" width="75px">
                </div>
                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <a class="next" onclick="plusSlides(1)">❯</a>
            </div>
            <!-- <div class="dot-container">
               <span class="dot" onclick="currentSlide(1)"></span>
               <span class="dot" onclick="currentSlide(2)"></span>
               <span class="dot" onclick="currentSlide(3)"></span>
               </div> -->
        </div>
    </div>
</section>

<section class="about-accordion">
    <div class="w-full md:w-3/5 mx-auto p-8">
        <div class="grid about-grid2 text-center pb-14">
            <h1 class="text-5xl uppercase font-bold dblue">FREQUENTLY ASKED<span class="orange"> QUESTIONS </span></h1>
        </div>
        <div class="w-full  mx-auto p-4 faiq">

            <div class="shadow-md">
                <div class="tab w-full overflow-hidden border-t">
                    <input
                        class="absolute opacity-0"
                        id="tab-multi-one"
                        type="checkbox"
                        name="tabs"
                    />
                    <label
                        class="block p-5 leading-normal cursor-pointer"
                        for="tab-multi-one"
                    >
                        How long does my listing last?
                    </label
                    >
                    <div class="tab-content overflow-hidden border-l-2 bg-gray-100 border-yellow-500 leading-normal">
                        <p class="p-5">
                            Each listing last 30 days before it is paused. If the bike hasn’t been sold, simply reactivate the advert.
                        </p>
                    </div>
                </div>
                <div class="tab w-full overflow-hidden border-t">
                    <input
                        class="absolute opacity-0"
                        id="tab-multi-two"
                        type="checkbox"
                        name="tabs"
                    />
                    <label
                        class="block p-5 leading-normal cursor-pointer"
                        for="tab-multi-two"
                    >
                        Do you have any tips or advice when buying a bike?
                    </label>
                    <div class="tab-content overflow-hidden border-l-2 bg-gray-100 border-yellow-500 leading-normal">
                        <p class="p-5">
                            Please check our advice page <a class="orange font-bold" href="{{ route('website.buying-tips') }}" title="{{ config('app.name') }} Bike Buying Tips">HERE</a> for more info on purchasing a bike on {{ config('app.name') }}
                        </p>
                    </div>
                </div>
                <div class="tab w-full overflow-hidden border-t">
                    <input
                        class="absolute opacity-0"
                        id="tab-multi-three"
                        type="checkbox"
                        name="tabs"
                    />
                    <label
                        class="block p-5 leading-normal cursor-pointer"
                        for="tab-multi-three"
                    >
                        Are the bikes advertised sold by {{ config('app.name') }}?
                    </label>
                    <div class="tab-content overflow-hidden border-l-2 bg-gray-100 border-yellow-500 leading-normal"
                    >
                        <p class="p-5">
                            No, {{ config('app.name') }} doesn't sell any stock but provides the platform for buyers and sellers to meet and exchange details for potential sales of goods.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Tab content - closed */
    .tab-content {
        max-height: 0;
        -webkit-transition: max-height 0.35s;
        -o-transition: max-height 0.35s;
        transition: max-height 0.35s;
    }
    /* :checked - resize to full height */
    .tab input:checked ~ .tab-content {
        max-height: 100vh;
    }
    /* Label formatting when open */
    .tab input:checked + label {
        border-left-width: 2px;
        border-color: orange;
        background-color: #f8fafc;
    }
    /* Icon */
    .tab label::after {
        float: right;
        right: 0;
        top: 0;
        display: block;
        width: 1.5em;
        height: 1.5em;
        line-height: 1.2;
        font-size: 1.25rem;
        text-align: center;
        -webkit-transition: all 0.35s;
        -o-transition: all 0.35s;
        transition: all 0.35s;
    }
    /* Icon formatting - closed */
    .tab input[type="checkbox"] + label::after {
        content: "+";
        font-weight: bold; /*.font-bold*/
        border-width: 1px; /*.border*/
        border-radius: 9999px; /*.rounded-full */
        border-color: #b8c2cc; /*.border-grey*/
        padding: 1px 0 0 0;
    }
    .tab input[type="radio"] + label::after {
        content: "\25BE";
        font-weight: bold; /*.font-bold*/
        border-width: 1px; /*.border*/
        border-radius: 9999px; /*.rounded-full */
        border-color: #b8c2cc; /*.border-grey*/
    }
    /* Icon formatting - open */
    .tab input[type="checkbox"]:checked + label::after {
        transform: rotate(315deg);
        background-color: orange; /*.bg-indigo*/
        color: #f8fafc; /*.text-grey-lightest*/
    }
    .tab input[type="radio"]:checked + label::after {
        transform: rotateX(180deg);
        background-color: #6574cd; /*.bg-indigo*/
        color: #f8fafc; /*.text-grey-lightest*/
        border:0;
    }
</style>

<script>
    /* Optional Javascript to close the radio button version by clicking it again */
    var myRadios = document.getElementsByName('tabs2');
    var setCheck;
    var x = 0;
    for(x = 0; x < myRadios.length; x++){
        myRadios[x].onclick = function(){
            if(setCheck != this){
                setCheck = this;
            }else{
                this.checked = false;
                setCheck = null;
            }
        };
    }
</script>
