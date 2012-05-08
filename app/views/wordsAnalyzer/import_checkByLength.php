<div id="container" >
    <h1>Words Validation by length</h1>
    <form action="" method="post">
        Word length:<select name="length">
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
        </select>
        <input type="submit" />
    </form>
    <br/>
    <?php
    foreach($words_list as $word) {
//            var_dump($word);
        echo '<div>
                    <div style="display: inline-block; vertical-align: top;">
                       <em> #'.$word->word_id.'</em> <br/><b>'.$word->word_label.'</b>
                    </div>
                    <div style="display: inline-block;">
                        <a href="http://www.google.com/search?q=dictionnaire+'.$word->word_label.'">link dico</a> <br/>
                        <button onclick="">validate</button> <button onclick="">Delete</button>
                    </div>
                </div><hr/> ';
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

