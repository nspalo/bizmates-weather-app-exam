/**
 * Simple Javascript to get input and set to url then reload!
 */
const chatInput = document.querySelector('#inputAddress')

export function sendMessage() {
    let message =  chatInput.value;
    let queryParams = new URLSearchParams(window.location.search);

    // Set new or modify existing parameter value.
    queryParams.set("location", message);

    // Replace current querystring with the new one.
    history.replaceState(null, null, "?"+queryParams.toString());

    window.location.reload()
    chatInput.value = message;
}
