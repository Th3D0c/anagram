<div id="container" >
    <h1>Words Validation</h1>
    <br/>
    <?php
//    var_dump($doublon_list);
    foreach($doublon_list as $doublon_key => $words_list) {
        echo '<div align="center"><b>'.$doublon_key.'</b><br/>';
        foreach($words_list as $word) {
//            var_dump($word);
            echo '<div style="display: inline-block;">
                        <div style="display: inline-block; vertical-align: top;">
                            #'.$word->word_id.' <em>'.$word->word_label.'</em>
                        </div>
                        <div style="display: inline-block;">
                            <a href="http://www.google.com/search?q=dictionnaire+'.$word->word_label.'">link dico</a> <br/>
                            validate this
                        </div>
                    </div>';
        }
        echo '</div><hr/>';
    }
    ?>
    <div align="center">
        abandonne<br/>
        <div style="display: inline-block;">
            <div style="display: inline-block; vertical-align: top;">
                abandonne
            </div>
            <div style="display: inline-block;">
                <a href="http://www.google.com/search?q=dictionnaire+abandonné">link dico</a> <br/>
                link validate this for doublon
            </div>
        </div>

        <div style="display: inline-block;">
            <div style="display: inline-block; vertical-align: top;">
                abandonné
            </div>
            <div style="display: inline-block;">
                <a href="http://www.google.com/search?q=dictionnaire+abandonné">link dico</a> <br/>
                link validate this for doublon
            </div>
        </div>
    <div>
    <br/><br/><br/><br/><br/><br/>

</div>

