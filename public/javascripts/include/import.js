function validateDoublon(word_id) {
    if( confirm('Validate word #'+word_id) ) {
        $.get("/wordsAnalyzer/import/validateDouble/" + word_id, function(result){
            if(result == 'true') {
                alert("Word #" + word_id +  " successfully validated");
                window.location.href = "/wordsAnalyzer/import/checkDoublons";
            } else {
                alert("Can not validate word #" + word_id);
                console.log('Error returned is: ' + result);
            }

        });
    }
} // END changeTimer

$(document).ready(function() {

}); // END Document.ready