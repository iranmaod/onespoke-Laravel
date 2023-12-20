<x-website.layout>

    <x-website.navbar />

    <x-website.hero>
        <section class="sold-bike1 pt-36 pb-36">
            <div class="container mx-auto">
                <div class="row">
                    <div class="grid">
                        <h2 class="text-center text-4xl font-bold pb-3 uppercase text-white">
                            <span class="orange">Veloeye</span>
                        </h2>
                        <p class="text-center w-2/5 mx-auto text-base text-white">

                        </p>
                    </div>
                </div>
            </div>
        </section>
    </x-website.hero>

    <div class="max-w-4xl mx-auto">
        <section class="text-gray-600 body-font">
            <div class="container px-5 mx-auto">
                <div class="flex flex-col w-full mb-24 space-y-8 pt-8">

                    <img class="max-w-lg w-2/3 mx-auto" src="/images/veloeye.jpg"/>

                    <p class="mx-auto leading-relaxed text-base">
                        At {{ config('app.name') }} not only do we aim to make buying and selling bicycles easier, we want to leave a lasting impression on the overall safety and security of the cycling community. As such, we have partnered up Veloeye - a likeminded business with an extensive database in which you can register your bike to aid and prevent circulation of lost and stolen bicycles throughout the country.  See more below on free registration and their additional product offerings
                    </p>

                    <h2 class="text-4xl text-center font-extrabold dark py-7">How it Works</h2>
                    <div class="flex justify-center items-center">
                        <iframe class="" width="560" height="315" src="https://www.youtube.com/embed/MTgrJLO8pog" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>


                    <h2 class="text-4xl text-center font-extrabold dark py-7">About Veloeye</h2>

                    <p>Veloeye is the brainchild of two guys who invested in bicycles. Inevitably we grew to love those bicycles. We paid a lot of money and did not want to lose them.</p>

                    <h3 class="text-3xl text-center font-extrabold dark">Cycling boom &amp; an increase in bike theft</h3>

                    <p>There has been an increase in the popularity of cycling over the past few years. Unfortunately, this is matched by a parallel increase in bike-related crimes, including cycle theft. Having heard the typical horror bike theft stories (read
                        <a class="orange" target="_blank" href="https://www.veloeye.com/blog.php">Andy's blog article</a> for more about this) we decided to do something to deter the bike thief.
                    </p>

                    <p>We understand that if a dedicated and serious bicycle thief wants your bike, there's little you can do to prevent them taking it. What we can do is pool our resources and act as a community to help fight bike theft. We're not talking super-hero stuff here, we're simply applying a little community spirit and a dose of modern technology.</p>

                    <h3 class="text-3xl text-center font-extrabold dark">Empowering bike owners</h3>

                    <p>Veloeye is a simple and inexpensive high visibility tracking system for bike owners.</p>

                    <ol class="list-disc">
                        <li>Apply one of the Veloeye tamper-proof tags</li>
                        <li>Download our free app</li>
                        <li>Scan the tag on your bike by holding your smartphone camera over the code</li>
                        <li>The tag and bike are registered with the Veloeye central system</li>
                        <li>That's it!</li>
                    </ol>

                    <h3 class="text-3xl text-center font-extrabold dark">Status matters</h3>

                    <p>
                        <span class="text-green-500">GREEN</span> = Everything is fine in your world. Your bike is safe.<br>
                        <span class="text-red-500">RED</span> = Bike is stolen. Time to inform as many people as possible.
                    </p>

                    <p>Following registration, your bike status is automatically set as green. You will receive a thankyou message to say you are registered. Should the worst happen, and your bike is stolen, you set the bike status to red.</p>

                    <h3 class="text-3xl text-center font-extrabold dark">Developing a community</h3>

                    <p>We want to build a community of people who will look out for each other - and this requires a change of mindset. If you are having a coffee in a cafe and see someone scanning your locked up precious steed - be grateful, it's likely someone is saying hello and making sure your bike is with the right person. If your bike status is green when scanned, everything is fine. If it is red, the scanner to notify the owner of the location of the bike.</p>

                    <p>We plan to make the whole scanning game a fun thing to do, by planting secret little gems which will come back to scanners, including prize giveaways and lucky dips for random app users (more on this in forthcoming blog articles)</p>
                    <p>If you want to know more, why not check out <a class="orange" target="_blank" href="https://www.veloeye.com/concept.php">how Veloeye works</a>.</p>


                    <h3 class="text-3xl text-center font-extrabold dark">Bike Insurance from Yellow Jersey</h3>

                    <p>Veloeye are proud to team up with Yellow Jersey insurance to offer a 10% discount on insurance when purchasing a bike marking kit.</p>

                    <p>So mark your bike with Veloeye and get your code for 10% discount on your insurance with the leading bike insurer.</p>

                    <p>Visit their website directly at <a class="orange" href="https://www.yellowjersey.co.uk" target="_blank">www.yellowjersey.co.uk</a></p>
                </div>
            </div>

        </section>

    </div>

    <x-website.footer />

</x-website.layout>
