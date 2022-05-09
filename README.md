# Progetto PHP e MySQL per Start2Impact

## Descrizione

Il progetto prevedere la creazione di un'API RESTful con funzionalità CRUD. Nello specifico, l'applicazione deve permettere la lettura, l'inserimento, la modifica e la cancellazione dei dati nel database. I dati fanno riferimento a dei paesi e a dei voli fra questi con relativo numero di posti disponibili.

## Testing

Una volta clonato il progetto e il DB, avviati i corrispettivi server, è possibile usare uno strumento come [Postman](https://www.postman.com/) per testare l'applicazione.

### Entità del database:

- cities = id, name
- flights = id, departure, arrival, availableSeats

### Routing per l'entità **cities**:

- **GET /cities** = ritorna una lista di tutte le città
- **POST /cities** = permette di inserire una città inserendo nel body
  ```json
  {
    "name": "nomeNuovaCittà"
  }
  ```
- **PUT /cities** = permette la modifica di una città inserendo nel body

  ```json
  {
    "id": "idCittàDaModificare",
    "name": "nomeCittàModificato"
  }
  ```

- **DELETE /cities** = permette di cancellare una città inserendo l'id nel body
  ```json
  {
    "id": "idCittàDaEliminare"
  }
  ```

### Routing per l'entità **flights**:

- **GET /flights** = ritorna una lista di tutti i voli, in ordine ascendente per numero di posti disponibili
- **GET /flights/cities** = ritorna una lista di tutti i voli con la città inserita nel body

  ```json
  {
    "name": "cittàInteressata"
  }
  ```

- **GET /flights/seats** = ritorna una lista di tutti i voli con un numero di posti maggiore o uguale al numero specificato

  ```json
  {
    "availableSeats": "numeroPostiDisponibili"
  }
  ```

- **POST /flights** = permette di inserire un nuovo volo inserendo nel body
  ```json
  {
    "departure": "idCittàPartenza",
    "arrival": "idCittàArrivo",
    "availableSeats": "numeroPostiDisponibili"
  }
  ```
- **PUT /flights** = permette di modificare un volo inserendo nel body

  ```json
  {
    "id": "idVoloDaModificare",
    "availableSeats": "numeroPostiDisponibili"
  }
  ```

- **DELETE /flights** = permette di cancellare il volo associato all'id specificato nel body

  ```json
  {
    "id": "idVoloDaCancellare"
  }
  ```
