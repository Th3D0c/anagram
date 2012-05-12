<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function getRandomLetters() {
         $this->load->database();
        $query_vowel = "SELECT * FROM
                    test.letters
                  WHERE
                    is_vowel=true
                  ORDER BY RANDOM()
                  LIMIT 2";
        $query_consonant = "SELECT * FROM
                    test.letters
                  WHERE
                    is_vowel=false
                  ORDER BY RANDOM()
                  LIMIT 5";
        $result_vowel = $this->db->query($query_vowel);
        $result_consonant = $this->db->query($query_consonant);
        echo json_encode( array_merge($result_vowel->result(), $result_consonant->result()) ) ;
    }

    public function getRandomWords($letters_set) {
        $this->load->database();
        $query_small = "SELECT * FROM
                    test.words w
                  WHERE
                    word_value~'^[".$letters_set."]+$'
                    AND length BETWEEN 6 AND 7
                  ORDER BY RANDOM()
                  LIMIT 5";
        $query_long = "SELECT * FROM
                    test.words w
                  WHERE
                    word_value~'^[".$letters_set."]+$'
                    AND length BETWEEN 3 AND 5
                  ORDER BY RANDOM()
                  LIMIT 10";
        $result_small = $this->db->query($query_small);
        $result_long = $this->db->query($query_long);
        echo json_encode(array_merge($result_small->result(),$result_long->result() ) ) ;
    }

	/**
	* Index Page for this controller.
	*
	*/
	public function index() {
		$this->viewlinker->addJsScript('include/welcome');

    	$view_data = null;
    	$this->viewlinker->view('welcome_message', $view_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */