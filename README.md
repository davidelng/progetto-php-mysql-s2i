# Progetto PHP e MySQL per Start2Impact

## Descrizione

**ANCORA WIP**
Il progetto prevedere la creazione di un'API RESTful con funzionalità CRUD.

## Testing

Una volta clonato il progetto e il DB, avviati i corrispettivi server, è possibile usare uno strumento come [Postman](https://www.postman.com/) per testare l'applicazione.

### Entità del database:

- cities = id, name
- flights = id, departure, arrival, availableSeats

### Routing per l'entità **cities**:

- **GET** /cities = ritorna una lista di tutte le città
- **POST** /cities = permette di inserire una città inserendo nel body
  ```json
  {
    "name": "nomeNuovaCittà"
  }
  ```
- **PUT** /cities = permette la modifica di una città inserendo nel body

  ```json
  {
    "id": "idCittàDaModificare",
    "name": "nomeCittàModificato"
  }
  ```

- **DELETE** /cities = permette di cancellare una città inserendo l'id nel body
  ```json
  {
    "id": "idCittàDaEliminare"
  }
  ```

### Routing per l'entità **flights**:

- **GET** /flights = ritorna una lista di tutti i voli
- **GET** /flights/cities/:name = ritorna una lista di tutti i voli con la città inserita nell'url
- **GET** /flights/seats/:num = ritorna una lista di tutti i voli con un numero di posti maggiore o uguale al numero specificato nell'url
- **POST** /flights = permette di inserire un nuovo volo inserendo nel body
  ```json
  {
    "departure": "idCittàPartenza",
    "arrival": "idCittàArrivo",
    "availableSeats": "numeroPostiDisponibili"
  }
  ```
- **PUT** /flights/:id = permette di modificare il volo associato all'id specificato nell'url inserendo nel body

  ```json
  {
    "availableSeats": "numeroPostiDisponibili"
  }
  ```

- **DELETE** /flights/:id = permette di cancellare il volo associato all'id specificato nell'url
