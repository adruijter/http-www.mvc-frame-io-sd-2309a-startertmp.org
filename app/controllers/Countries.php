<?php

class Countries extends BaseController
{
    private $countryModel;

    public function __construct()
    {
        $this->countryModel = $this->model('Country');
    }

    public function index()
    {
        $data = [
            'title' => 'Landen van de Wereld',
            'dataRows' => NULL,
            'message' => NULL,
            'messageColor' => NULL,
            'messageVisibility' => 'display:none'
        ];

        $countries = $this->countryModel->getCountries();

        if (is_null($countries)) {
            //Foutmelding en in de tabel geen records
            $data['message'] = TRY_CATCH_ERROR;
            $data['messageColor'] = FORM_DANGER_COLOR;
            $data['messageVisibility'] = 'flex';
            $data['dataRows'] = NULL;
            
            header('Refresh:3; ' . URLROOT . '/homepages/index');
        } else {
                $data['dataRows'] = $countries;
        }       

        $this->view('countries/index', $data);
    }

    /**
     * Creates a new country.
     *
     * This method is responsible for rendering the create view and passing the necessary data to it.
     *
     * @return void
     */
    public function create()
    {
        $data = [
            'title' => 'Voeg een nieuw land toe',
            'message' => '',
            'messageColor' => 'dark',
            'messageVisibility' => 'display:none;',
            'disableButton' => '',
            'country' => '',
            'capitalCity' => '',
            'continent' => '',
            'population' => '',
            'zipcode' => '',
            'countryError' => '',
            'capitalCityError' => '',
            'continentError' => '',
            'populationError' => '',
            'zipcodeError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            /**
             * Maak het $_POST-array schoon van ongewenste tekens en tags
             */
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            /**
             * Doe de post-waarden in het $data array
             */
            $data['country'] = trim($_POST['country']);
            $data['capitalCity'] = trim($_POST['capitalCity']);
            $data['continent'] = trim($_POST['continent']);
            $data['population'] = trim($_POST['population']);
            $data['zipcode'] = trim($_POST['zipcode']);

 
            /**
             * Valideer de formuliervelden
             */
            $data = CountriesValidator::validateCountriesInputFields($data);
            
            /**
             * We checken of er geen Validatie Errors zijn
             */
            if ( $data['isValidView'] ) {
                /**
                 * Roep de createCountry methode aan van het countryModel object waardoor
                 * de gegevens in de database worden opgeslagen
                 */
                $result = $this->countryModel->createCountry($_POST);

                /**
                 * Als er een fout is in de modelmethod dan wordt dit gelogd en gemeld
                 * aan de gebruiker
                 */
                if (is_null($result)) {
                    $data['messageVisibility'] = 'flex';
                    $data['message'] = 'Er is fout opgetreden in de database, u kunt geen land toevoegen';
                    $data['messageColor'] = 'success';
                    $data['disableButton'] = 'disabled';
                } else {
                    $data['messageVisibility'] = '';
                    $data['message'] = 'Uw gegevens zijn opgeslagen. U wordt doorgestuurd naar de index-pagina.';
                    $data['messageColor'] = 'success';

                }
                /**
                 * Na het opslaan van de formulier wordt de gebruiker teruggeleid naar de index-pagina
                 */
                header("Refresh:3; url=" . URLROOT . "/countries/index");
            } else {
                $data['messageVisibility'] = '';
                $data['message'] = 'Er zijn één of meerdere velden niet goed ingevuld';
                $data['messageColor'] = 'danger';

                $this->view('countries/create', $data);
            }
        }

        $this->view('countries/create', $data);
    }

    public function update($countryId)
    {
        $result = $this->countryModel->getCountry($countryId) ?? header("Refresh:3; url=" . URLROOT . "/countries/index");

        $data = [
            'title' => 'Wijzig land',
            'message' => is_null($result) ? 'Er is een fout opgetreden, wijzigen is niet mogelijk' : '',
            'messageVisibility' => is_null($result) ? 'flex' : 'none',
            'messageColor' => is_null($result) ? 'danger' : '',
            'disableButton' => is_null($result) ? 'disabled' : '',
            'Id' => $result->Id ?? '',
            'country' => $result->Name ?? '-',
            'capitalCity' => $result->CapitalCity ?? '-',
            'continent' => $result->Continent ?? '-',
            'population' => $result->Population ?? '-',
            'zipcode' => $result->Zipcode ?? '-',
            'countryError' => '',
            'capitalCityError' => '',
            'continentError' => '',
            'populationError' => '',
            'zipcodeError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data['country'] = trim($_POST['country']);
            $data['capitalCity'] = trim($_POST['capitalCity']);
            $data['continent'] = trim($_POST['continent']);
            $data['population'] = trim($_POST['population']);
            $data['zipcode'] = trim($_POST['zipcode']);

            /**
             * Valideer de formulierdata
             */
            $data = CountriesValidator::validateCountriesInputFields($data);

            /**
             * Wanneer alle error-key values leeg zijn dan kunnen we de update uitvoeren
             */

            if ( $data['isValidView'])
            {
                $result = $this->countryModel->updateCountry($_POST);

                if (is_null($result)) {
                    $data['messageVisibility'] = 'flex';
                    $data['message'] = 'Het updaten is niet gelukt';
                    $data['messageColor'] = 'danger';
                    $data['disableButton'] = 'disabled';
                } else {
                    $data['messageVisibility'] = 'flex';
                    $data['message'] = 'Het updaten is gelukt';
                    $data['messageColor'] = 'success';
                }
                header("Refresh:3; url=" . URLROOT . "/countries/index");
            } else {
                $data['messageVisibility'] = 'flex';
                $data['message'] = 'U heeft enkele verkeerde waardes ingevuld';
                $data['messageColor'] = 'danger';
            }
            $this->view('countries/update', $data);            
            // header("Refresh:3; url=" . URLROOT . "/countries/index");
        }
            
            
            
            
        

        $this->view('countries/update', $data);
    }

    public function delete($countryId)
    {
       $result = $this->countryModel->deleteCountry($countryId);       

       $data = [
           'title' => 'Landen van de wereld',
           'message' => is_null($result) ? 'Er is een fout opgetreden het record is niet verwijderd' : 'Het record is verwijderd, u wordt doorgestuurd naar het overzicht',
           'messageVisibility' => is_null($result) ? 'flex' : 'flex',
           'messageColor' => is_null($result) ? 'danger' : 'success',
       ];

       header("Refresh:3; " . URLROOT . "/countries/index");

        $countries = $this->countryModel->getCountries();

        if (is_null($countries)) {
            //Foutmelding en in de tabel geen records
            $data['message'] = TRY_CATCH_ERROR;
            $data['messageColor'] = FORM_DANGER_COLOR;
            $data['messageVisibility'] = '';
            $data['dataRows'] = NULL;
            
            header('Refresh:3; ' . URLROOT . '/homepages/index');
        } else {
                $data['dataRows'] = $countries;
        }       

        $this->view('countries/index', $data);
    }
} 