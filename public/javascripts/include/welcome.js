var anagrams_list = new Array();

var letters_list = new Array();

var current_word = '';
var letters_watchdog = 0;
var found_anagrams = 0;
var timer = null;
/**
 * Simplified from http://www.sitepoint.com/creating-accurate-timers-in-javascript/
 * Credits seems to go to James Edwards http://www.sitepoint.com/author/brothercake/
 *
 */
function mytimer(length, oninstance, oncomplete) {
    var steps = (length / 100),
        speed = 100,
        count = 0,
        timerID;
    function instance()
    {
        if(count++ == steps)
        {
            clearInterval(timerID);
            oncomplete(steps, count);
        }
        else
        {
            oninstance(steps, count);
        }
    }
    timerID = window.setInterval(instance, speed);
}

function resetCurrentWord() {
    $('[id^="target_"]').text('*');
    max = current_word.length;
    for (i=0; i < max; i++) {
        $('#'+current_word.charAt(i)).slideToggle("fast");
    }

    current_word = '';
    letters_watchdog = 0;
} // END resetAnimations

function gameOverScreen() {
    if( confirm('YOU LOOSE!!!! BOOO!\n\nINSERT COINS?') ) {
        window.location.reload();
    } else {
        alert('COWARDS KNOW SHAME...');
    }
} // END gameOverScreen

function changeTimer(count) {
    tmp = 10 - count * 0.1;
    $('#timer_screen').text(tmp.toFixed(1));
} // END changeTimer

function getRandomWords(letters_set) {

    $.getJSON('welcome/getRandomWords/'+ letters_set, function(data) {
        $.each(data, function(i, word) {
            anagrams_list.push(word.word_value);
            $('#words_container').append('<div id="response_'+word.word_value+'">'+word.word_value+'</div>');
        });
    });
}

function getRandomLetters() {
    $.ajax({
        url: 'welcome/getRandomLetters',
        dataType: 'json',
        async: false
        }).done(function(data) {
                    $.each(data, function(i, letter) {
                        letters_list.push(letter.letter_value);
                        $('#letter_container').append('<span id="'+letter.letter_value+'">'+letter.letter_value.toUpperCase()+'&nbsp;</span>');
                    });
                });
}

$(document).ready(function() {
    // Set results words list
    getRandomLetters();
    console.log(letters_list);
    getRandomWords(letters_list.join(''))

    // Set picked letters
//    jQuery.each(letters_list, function(i, letter) {
//        $('#letter_container').append('<span id="'+letter+'">'+letter.toUpperCase()+'&nbsp;</span>');
//    });



    // Init timer
//    mytimer(10000,
//        function(steps, count) {
//            changeTimer(count);
//        },
//        function(steps, count) {
//            gameOverScreen();
//    });


    // keybord management and word validation
    $(document).keypress(function(event) {
//    console.log('anim: %i', event.which);

        var current_letter = '';

        // a-z
        if ( event.which > 96 && event.which < 123 ) {
            letters_watchdog++;
            current_letter = String.fromCharCode(event.which);
            current_word = current_word + current_letter ;

            $("#"+current_letter).slideToggle("fast");
            $("#target_"+letters_watchdog).text(current_letter.toUpperCase());

            event.preventDefault();

        // ENTER or SPACE pushed so validate current_word and reset animations
        } else if ( event.which == 13 || event.which == 32) {
            if(anagrams_list.indexOf(current_word) != -1) {

                found_anagrams++;
                $('#response_'+current_word).addClass('stroked_results')

                // Check for winner \o/
                if(found_anagrams == anagrams_list.length) {
                    alert ('YOU WIN!!!!!');
                }

            }
            resetCurrentWord();

            event.preventDefault();
        // trying to delete last letter, trap and prevent browser 'history back' event
        } else if ( event.which == 8 ) {
            event.preventDefault();
        }
    }); // END Document.keypress
}); // END Document.ready