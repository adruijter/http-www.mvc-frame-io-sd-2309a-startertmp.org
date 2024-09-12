<?php

class Instructeurs extends BaseController
{

    public function index()
    {
        /**
         * Met het $data-array geef ik informatie mee vanuit de controller
         * naar de view
         */
        $data = [
            'title' => 'Dit is de instructeurspagina'
        ];

        /**
         * Met de view-method uit de BaseController-class roep je de
         * view aan en geef je de informatie uit het $data-array mee aan
         * de view
         */
        $this->view('instructeurs/index', $data);
    }

}