<?php

class FlightController
{
    public function read()
    {
        $this->setHeaders('GET');

        $req = $this->startDb();
        $flight = $req['flight'];
        $data = $req['data'];

        $recordset = $flight->selectAll();

        if ($recordset !== false) {
            http_response_code(201);
            echo json_encode($recordset);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Nessuna citta rovata."));
        }
    }

    public function filter()
    {
        $this->setHeaders('GET');

        $req = $this->startDb();
        $flight = $req['flight'];
        $data = $req['data'];

        if (array_key_exists('name', $data)) {
            $recordset = $flight->selectByCity($data);
        } else if (array_key_exists('availableSeats', $data)) {
            $recordset = $flight->selectBySeats($data);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Dati incompleti"));
        }

        if ($recordset !== false) {
            http_response_code(201);
            echo json_encode($recordset);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Nessuna citta rovata."));
        }
    }

    public function create()
    {
        $this->setHeaders('POST');

        $req = $this->startDb();
        $flight = $req['flight'];
        $data = $req['data'];

        if (
            !empty($data['departure']) &&
            !empty($data['arrival']) &&
            !empty($data['availableSeats'])
        ) {
            if ($flight->create($data)) {
                http_response_code(201);
                echo json_encode(array("message" => "Volo inserito correttamente."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Impossibile inserire il volo."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Dati incompleti."));
        }
    }

    public function update()
    {
        $this->setHeaders('PUT');

        $req = $this->startDb();
        $flight = $req['flight'];
        $data = $req['data'];

        if (
            !empty($data['id']) &&
            !empty($data['availableSeats'])
        ) {
            if ($flight->update($data)) {
                http_response_code(200);
                echo json_encode(array("message" => "Volo aggiornato."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Impossibile modificare il volo."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Dati incompleti."));
        }
    }

    public function delete()
    {
        $this->setHeaders('DELETE');

        $req = $this->startDb();
        $flight = $req['flight'];
        $data = $req['data'];

        if (!empty($data['id'])) {
            if ($flight->delete($data)) {
                http_response_code(200);
                echo json_encode(array("message" => "Volo eliminato."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Impossibile eliminare il volo."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Dati incompleti."));
        }
    }

    protected function setHeaders($method)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: {$method}");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }

    protected function startDb()
    {
        include_once('core/bootstrap.php');

        $request = new Request;
        $request->decodeHttpRequest();
        $data = $request->getBody();

        $db = new Database();
        $db->openConnection($dbconfig);

        $flight = new Flight($db);

        return ['flight' => $flight, 'data' => $data];
    }
}
