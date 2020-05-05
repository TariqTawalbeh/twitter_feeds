let counter;
let selected_language;
const limit = 20;
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('button').forEach(button => {
        button.onclick = () => {
            // Reset the counter on click.
            counter = 0;
            document.querySelector('#tweets').innerHTML = '';
            const language = button.dataset.lang;
            selected_language = language;
            tweets(language)
        };
    });
});

// Get tweetes from the server.
function tweets(language) {
    const start = counter;
    const end = start + limit -1;
    counter = end +1;
    var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    const request = new XMLHttpRequest();
    request.open('GET', '/ajax/twitter/'+ start +'/' + end)
    request.onload = () => {
        const data = JSON.parse(request.responseText);
        data.forEach(function(value) {
            if(value.lang == language)
            {
                var startTime = new Date(value.created_at);
                const contents = months[startTime.getMonth()] + ', '+ startTime.getDay() + ' ' + startTime.getFullYear();
                const textvalue = value.text;
                add_tweet(contents, textvalue);
            }
        });
    }
    request.send();
}

const tweet_template = Handlebars.compile(document.querySelector('#tweet').innerHTML);
function add_tweet(contents, value) {
    // Create new tweet.
    const tweet = tweet_template({'contents': contents, 'value': value});

    // Add tweet to DOM.
    document.querySelector("#tweets").innerHTML += tweet
}