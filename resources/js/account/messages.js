const conversations = document.querySelector('#conversations');
const conversationPane = document.querySelector('#conversation-pane');
const leftPane = document.querySelector('#left-pane');

let submitting = false;

document.addEventListener('DOMContentLoaded', function() {
    getConversations();
});

function getConversations() {

    axios({
        method: 'get',
        url: conversationsUrl,
    })
        .then(function (response) {
            conversations.innerHTML = buildInbox(response.data.data);
            initListeners();
        })
        .catch(function (error) {
        });
}

function loadConversation(id) {

    axios({
        method: 'get',
        url: `${conversationsUrl}/${id}`,
    })
        .then(function (response) {
            conversationPane.innerHTML = buildMessagePane(response.data.data);
            initConversationListeners();
            hideLeftPane();

            // update unread count
            getUnreadMessageCount();
        })
        .catch(function (error) {
        });
}


function initListeners() {
    const conversations = document.querySelectorAll('.conversation');

    conversations.forEach(conversation => conversation.addEventListener('click', (e) => handleLoadConversation(e)));
}

function handleLoadConversation(e) {
    e.preventDefault();

    loadConversation(e.currentTarget.dataset.id);
}

function initConversationListeners() {
    const form = document.querySelector('#conversation-pane form');

    form.addEventListener('submit', sendMessage);

    const backButtons = document.querySelectorAll('button.back');

    backButtons.forEach(button => button.addEventListener('click', (e) => showLeftPane(e)));
}

function sendMessage(e) {
    e.preventDefault();

    const form = e.target;

    axios({
        method: form.method,
        url: form.action,
        data: new FormData(form),
    })
        .then(function (response) {

            Swal.fire({
                title: 'Success',
                text: response.data.message,
                icon: 'success',
                confirmButtonText: 'Ok',
                timer: 3000,
                confirmButtonColor: '#fc9f42',
            })

            loadConversation(form.dataset.id);
            submitting = false;
        })
        .catch(function (error) {

            Swal.fire({
                title: 'Error',
                text: error.response.data.errors.message[0],
                icon: 'error',
                confirmButtonText: 'Ok',
                timer: 3000,
                confirmButtonColor: '#fc9f42',
            })

            submitting = false;
        });
}


function buildInbox(conversations) {

    let html = ``;

    if (conversations.length === 0) {
        html += `<span class="pl-4">No message history</span>`;
    } else {
        conversations.forEach(function(conversation) {
            html += `
                <li data-id="${conversation.id}" class="conversation flex flex-no-wrap items-center pr-3 text-black rounded-lg cursor-pointer mt-200 py-65 hover:bg-gray-200" style="padding-top: 0.65rem; padding-bottom: 0.65rem">
                    <div class="flex justify-between w-full focus:outline-none">
                        <div class="flex justify-between w-full">
                            <div class="relative flex items-center justify-center w-12 h-12 ml-2 mr-3 text-xl font-semibold text-white bg-blue-500 rounded-full flex-no-shrink">
                                <img class="object-cover w-12 h-12 rounded-full" src="${conversation.user.profile_image_url}" alt="${conversation.user.display_name}">
                            </div>
                            <div class="items-center flex-1 min-w-0">
                                <div class="flex flex-wrap justify-between mb-1">
                                    <h3 class="f-arial text-sm font-semibold text-black">${conversation.user.display_name}</h3>

                                    <div class="flex flex-wrap">

                                        <svg class="read ${conversation.messages[0].read ? 'hidden' : 'hidden'} w-4 h-4 text-green-500 fill-current" xmlns="http://www.w3.org/2000/svg" width="19" height="14" viewBox="0 0 19 14">
                                            <path fill-rule="nonzero" d="M4.96833846,10.0490996 L11.5108251,2.571972 C11.7472185,2.30180819 12.1578642,2.27443181 12.428028,2.51082515 C12.6711754,2.72357915 12.717665,3.07747757 12.5522007,3.34307913 L12.4891749,3.428028 L5.48917485,11.428028 C5.2663359,11.6827011 4.89144111,11.7199091 4.62486888,11.5309823 L4.54038059,11.4596194 L1.54038059,8.45961941 C1.2865398,8.20577862 1.2865398,7.79422138 1.54038059,7.54038059 C1.7688373,7.31192388 2.12504434,7.28907821 2.37905111,7.47184358 L2.45961941,7.54038059 L4.96833846,10.0490996 L11.5108251,2.571972 L4.96833846,10.0490996 Z M9.96833846,10.0490996 L16.5108251,2.571972 C16.7472185,2.30180819 17.1578642,2.27443181 17.428028,2.51082515 C17.6711754,2.72357915 17.717665,3.07747757 17.5522007,3.34307913 L17.4891749,3.428028 L10.4891749,11.428028 C10.2663359,11.6827011 9.89144111,11.7199091 9.62486888,11.5309823 L9.54038059,11.4596194 L8.54038059,10.4596194 C8.2865398,10.2057786 8.2865398,9.79422138 8.54038059,9.54038059 C8.7688373,9.31192388 9.12504434,9.28907821 9.37905111,9.47184358 L9.45961941,9.54038059 L9.96833846,10.0490996 L16.5108251,2.571972 L9.96833846,10.0490996 Z"/>
                                        </svg>

                                        <span class="text-xs font-medium text-gray-600">${conversation.messages[0].sent_at}</span>
                                    </div>
                                </div>
                                <div class="flex justify-between text-sm leading-none truncate">
                                    <span>${conversation.messages[0].message_preview}</span>
                                    <span class="${conversation.unread_count > 0 ? '' : 'hidden'} flex items-center justify-center w-5 h-5 text-xs text-right text-white bg-green-500 rounded-full">${conversation.unread_count}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            `
        });
    }

    return html;
}

function buildMessagePane(conversation) {

    let html = `
        <div class="z-20 flex flex-grow-0 flex-shrink-0 w-full pr-3 bg-white border-b">

            <div class="flex items-center justify-center text-xl mr-3">
                <button type="button" class="flex md:hidden back">
                    <i class="fa fa-chevron-left"></i>
                </button>
            </div>

            <div class="object-cover w-12 h-12 mx-4 my-2 bg-blue-500 bg-center bg-no-repeat bg-cover rounded-full cursor-pointer"
                 style="background-image: url(${conversation.user.profile_image_url}">
            </div>

            <div class="flex flex-col justify-center flex-1 overflow-hidden cursor-pointer">
                <div class="overflow-hidden text-base font-medium leading-tight text-gray-600 whitespace-no-wrap">
                    ${conversation.user.display_name}
                </div>

                <div>
                    <a class="orange text-xs" href="${conversation.user.link}" title="View ${conversation.user.display_name}'s profile" target="_blank">
                        View ${conversation.user.display_name}'s profile
                    </a>
                </div>
            </div>

            <button type="button" class="hidden flex self-center p-2 ml-2 text-gray-500 rounded-full md:block focus:outline-none hover:text-gray-600 hover:bg-gray-300">
                <svg class="hidden w-6 h-6 text-gray-600 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill-rule="nonzero" d="M12,16 C13.1045695,16 14,16.8954305 14,18 C14,19.1045695 13.1045695,20 12,20 C10.8954305,20 10,19.1045695 10,18 C10,16.8954305 10.8954305,16 12,16 Z M12,10 C13.1045695,10 14,10.8954305 14,12 C14,13.1045695 13.1045695,14 12,14 C10.8954305,14 10,13.1045695 10,12 C10,10.8954305 10.8954305,10 12,10 Z M12,4 C13.1045695,4 14,4.8954305 14,6 C14,7.1045695 13.1045695,8 12,8 C10.8954305,8 10,7.1045695 10,6 C10,4.8954305 10.8954305,4 12,4 Z"/>
                </svg>
            </button>
        </div>

        <div class="flex flex-col h-full flex-1 overflow-hidden bg-transparent bg-bottom bg-cover">

            <div class="overflow-y-auto h-500px">
                <div class="self-center flex-1 w-full">
                    <div class="relative flex flex-col px-3 py-1 m-auto">

                        <div class="self-center px-2 py-1 mx-0 my-1 text-sm text-white text-gray-700 bg-white border border-gray-200 rounded-full shadow rounded-tg">Start of conversation</div>

                        ${conversationHistory(conversation)}

                    </div>
                </div>
            </div>

            <div class="relative flex items-center self-center w-full max-w-xl p-4 py-8 bg-gray-200 text-gray-600 focus-within:text-gray-400">
                <div class="w-full">

                    <form data-id="${conversation.id}" method="post" action="/api/user/${conversation.user.id}/${conversation.user.slug}/message">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-6">
                            <button type="submit" class="p-1 focus:outline-none focus:shadow-none hover:text-blue-500">
                              <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill-rule="nonzero" d="M6.43800037,12.0002892 L6.13580063,11.9537056 C5.24777712,11.8168182 4.5354688,11.1477159 4.34335422,10.2699825 L2.98281085,4.05392998 C2.89811796,3.66698496 2.94471512,3.2628533 3.11524595,2.90533607 C3.53909521,2.01673772 4.60304421,1.63998415 5.49164255,2.06383341 L22.9496381,10.3910586 C23.3182476,10.5668802 23.6153089,10.8639388 23.7911339,11.2325467 C24.2149912,12.1211412 23.8382472,13.1850936 22.9496527,13.6089509 L5.49168111,21.9363579 C5.13415437,22.1068972 4.73000953,22.1534955 4.34305349,22.0687957 C3.38131558,21.8582835 2.77232686,20.907987 2.9828391,19.946249 L4.34336621,13.7305987 C4.53547362,12.8529444 5.24768451,12.1838819 6.1356181,12.0469283 L6.43800037,12.0002892 Z M5.03153725,4.06023585 L6.29710294,9.84235424 C6.31247211,9.91257291 6.36945677,9.96610109 6.44049865,9.97705209 L11.8982869,10.8183616 C12.5509191,10.9189638 12.9984278,11.5295809 12.8978255,12.182213 C12.818361,12.6977198 12.4138909,13.1022256 11.8983911,13.1817356 L6.44049037,14.0235549 C6.36945568,14.0345112 6.31247881,14.0880362 6.29711022,14.1582485 L5.03153725,19.9399547 L21.6772443,12.0000105 L5.03153725,4.06023585 Z"/>
                              </svg>
                            </button>
                          </span>

                        <input
                            type="text"
                            name="message"
                           class="w-full py-2 pl-4 pl-10 text-sm bg-white border border-transparent appearance-none rounded-tg placeholder-gray-800 focus:bg-white focus:outline-none focus:border-blue-500 focus:text-gray-900 focus:shadow-outline-blue" style="border-radius: 25px"
                           placeholder="Message..." autocomplete="off"
                       >
                   </form>
                </div>
            </div>
        </div>
    `;

    return html;
}

function conversationHistory(conversation) {

    let html = ``;

    conversation.messages.forEach(function(message) {
        html += `
            <div class="${message.user.id === window.Laravel.auth.user.id ? `self-end` : `self-start`} w-3/4 max-w-sm my-2">
                <div class="${message.user.id === window.Laravel.auth.user.id ? `bg-green-100 rounded-l-lg` : `bg-white rounded-r-lg`} p-4 text-sm rounded-t-lg shadow">
                    ${message.message}

                    <div class="text-right">
                        <svg class="sent ${message.read ? 'hidden' : ''} w-4 h-4 text-gray-400 fill-current inline-block" xmlns="http://www.w3.org/2000/svg" width="19" height="14" viewBox="0 0 19 14">
                            <path fill-rule="nonzero" d="M7.96833846,10.0490996 L14.5108251,2.571972 C14.7472185,2.30180819 15.1578642,2.27443181 15.428028,2.51082515 C15.6711754,2.72357915 15.717665,3.07747757 15.5522007,3.34307913 L15.4891749,3.428028 L8.48917485,11.428028 C8.2663359,11.6827011 7.89144111,11.7199091 7.62486888,11.5309823 L7.54038059,11.4596194 L4.54038059,8.45961941 C4.2865398,8.20577862 4.2865398,7.79422138 4.54038059,7.54038059 C4.7688373,7.31192388 5.12504434,7.28907821 5.37905111,7.47184358 L5.45961941,7.54038059 L7.96833846,10.0490996 L14.5108251,2.571972 L7.96833846,10.0490996 Z"/>
                        </svg>

                         <svg class="read ${message.read ? '' : 'hidden'} w-4 h-4 text-green-500 fill-current inline-block" xmlns="http://www.w3.org/2000/svg" width="19" height="14" viewBox="0 0 19 14">
                            <path fill-rule="nonzero" d="M4.96833846,10.0490996 L11.5108251,2.571972 C11.7472185,2.30180819 12.1578642,2.27443181 12.428028,2.51082515 C12.6711754,2.72357915 12.717665,3.07747757 12.5522007,3.34307913 L12.4891749,3.428028 L5.48917485,11.428028 C5.2663359,11.6827011 4.89144111,11.7199091 4.62486888,11.5309823 L4.54038059,11.4596194 L1.54038059,8.45961941 C1.2865398,8.20577862 1.2865398,7.79422138 1.54038059,7.54038059 C1.7688373,7.31192388 2.12504434,7.28907821 2.37905111,7.47184358 L2.45961941,7.54038059 L4.96833846,10.0490996 L11.5108251,2.571972 L4.96833846,10.0490996 Z M9.96833846,10.0490996 L16.5108251,2.571972 C16.7472185,2.30180819 17.1578642,2.27443181 17.428028,2.51082515 C17.6711754,2.72357915 17.717665,3.07747757 17.5522007,3.34307913 L17.4891749,3.428028 L10.4891749,11.428028 C10.2663359,11.6827011 9.89144111,11.7199091 9.62486888,11.5309823 L9.54038059,11.4596194 L8.54038059,10.4596194 C8.2865398,10.2057786 8.2865398,9.79422138 8.54038059,9.54038059 C8.7688373,9.31192388 9.12504434,9.28907821 9.37905111,9.47184358 L9.45961941,9.54038059 L9.96833846,10.0490996 L16.5108251,2.571972 L9.96833846,10.0490996 Z"/>
                        </svg>
                    </div>
                </div>

                <div class="${message.user.id === window.Laravel.auth.user.id ? `text-right` : `text-left`}">
                    <span class="ml-1 text-xs font-medium text-gray-600">${message.sent_at}</span>
                </div>
            </div>
        `
    });

    return html;
}

function hideLeftPane() {
    leftPane.classList.add('hidden');
    conversationPane.classList.remove('hidden');
}

function showLeftPane() {
    leftPane.classList.remove('hidden');
    conversationPane.classList.add('hidden');
}
