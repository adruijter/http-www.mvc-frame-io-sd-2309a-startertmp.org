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
        $countries = $this->countryModel->getCountries();

        var_dump($countries);
        
        $dataRows = "";

        foreach ($countries as $country) {
            $dataRows .= "<tr>
                            <td>{$country->Name}</td>
                            <td>{$country->CapitalCity}</td>
                            <td>{$country->Continent}</td>
                            <td>" . number_format($country->Population, 0, ",", ".") . "</td>
                            <td>{$country->Zipcode}</td>
                            <td class='text-center'>
                                <a href='" . URLROOT . "/countries/update/{$country->Id}'>
                                    <i class='bi bi-pencil-square'></i>
                                </a>
                            </td>
                            <td class='text-center'>
                                <a href='" . URLROOT . "/countries/delete/{$country->Id}'>
                                    <i class='bi bi-trash'></i>
                                </a>
                            </td>            
                        </tr>";
        }

        $data = [
            'title' => 'Landen van de Wereld',
            'dataRows' => $dataRows
        ];

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
            'visibility' => 'display:none;',
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
            $data = $this->validateCreateCountry($data);
            
            /**
             * We checken of er geen Validatie Errors zijn
             */
            if (
                empty($data['countryError']) 
                && empty($data['capitalCityError'])
                && empty($data['continentError'])
                && empty($data['populationError'])
                && empty($data['zipcodeError'])
            ) {
                /**
                 * Roep de createCountry methode aan van het countryModel object waardoor
                 * de gegevens in de database worden opgeslagen
                 */
                $result = $this->countryModel->createCountry($_POST);

                $data['visibility'] = '';
                $data['message'] = FORM_SUCCESS;
                $data['messageColor'] = FORM_SUCCESS_COLOR;

                /**
                 * Na het opslaan van de formulier wordt de gebruiker teruggeleid naar de index-pagina
                 */
                header("Refresh:1; url=" . URLROOT . "/countries/index");
            } else {
                $data['visibility'] = '';
                $data['message'] = FORM_DANGER;
                $data['messageColor'] = FORM_DANGER_COLOR;

                $this->view('countries/create', $data);
            }
        }

        $this->view('countries/create', $data);
    }

    public function validateCreateCountry($data)
    {
        if ( empty($data['country'])) {
            $data['countryError'] = "U bent verplicht een land in te vullen";
        }
        if ( strlen($data['country']) > 30) {
            $data['countryError'] = "Uw land heeft meer letters dan is toegestaan (minder 9 is toegestaan) kies een ander land";
        }
        if ( empty($data['capitalCity'])) {
            $data['capitalCityError'] = "U bent verplicht een hoofdstad in te vullen";
        }
        if ( empty($data['continent'])) {
            $data['continentError'] = "U bent verplicht een continent in te vullen";
        }
        if ( empty($data['population'])) {
            $data['populationError'] = "U bent verplicht het aantal inwoners in te vullen";
        }
        if ( !is_numeric($data['population']))
        {
            $data['populationError'] = "U bent verplicht een numeriek getal in te vullen";
        }
        if ( $data['population'] < 0 || $data['population'] > 4294967295) {
            $data['populationError'] = "Uw aantal inwoners is te groot of negatief";
        }
        if  (!in_array($data['continent'], CONTINENTS)) {
            $data['continentError'] = "Het door u opgegeven continent bestaat niet, kies er een uit de lijst";
        }
        
        // Hier komt de validatie voor de postcode met behulp van de preg_match functie en regular expressions 
        if (!preg_match('/^\d{4}[a-zA-Z]{2}$/', $data['zipcode'])) {
            $data['zipcodeError'] = "De postcode moet bestaan uit 4 cijfers en 2 letters";
        }
        return $data;
    }

    public function update($countryId)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $this->countryModel->updateCountry($_POST);

            echo '<div class="alert alert-success" role="alert">
                    Het land is gewijzigd. U wordt doorgestuurd naar de index-pagina.
                </div>';
                
            header("Refresh:3; url=" . URLROOT . "/countries/index");
        }

        $result = $this->countryModel->getCountry($countryId);

        $data = [
            'title' => 'Wijzig land',
            'Id' => $result->Id,
            'country' => $result->Name,
            'capitalCity' => $result->CapitalCity,
            'continent' => $result->Continent,
            'population' => $result->Population,
            'zipcode' => $result->Zipcode
        ];

        $this->view('countries/update', $data);
    }

    public function delete($countryId)
    {
       $result = $this->countryModel->deleteCountry($countryId);

       $data = [
           'message' => 'Het record is verwijderd. U wordt doorgestuurd naar de index-pagina.'
       ];

       header("Refresh:1; " . URLROOT . "/countries/index");

       $this->view('countries/delete', $data);
    }
} 