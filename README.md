# Backend API per una ToDo list avanzata

### [Corso jQuery - Full Stack Developer - ITS Prodigi anno 2022/2023](https://www.itsprodigi.it/corsi/full-stack-developer/)

> **ATTENZIONE**: questo progetto è da intendersi a solo scopo didattico, non implementa nessun tipo di autenticazione delle richieste nè altri meccanismi di sicurezza. **NON usare in ambienti di produzione!**

### Panoramica
Queste API permettono la gestione di più liste ToDo con virtualmente infiniti PostIt all'interno di ciascuna lista.

I PostIt sono ordinabili all'interno di ciascuna lista, ogni PostIt può essere marcato come completato e gli può essere assegnato un colore a piacere.

Le liste hanno invece un solo attributo, il titolo.

### Prerequisiti
Il backend viene eseguito all'interno di container [Docker](https://www.docker.com/), così che ogni studente possa lavorare con il suo ambiente isolato dagli altri. È quindi necessario avere installato Docker sul proprio PC.
- [Installazione Docker su Linux](https://docs.docker.com/desktop/install/linux-install/)
- [Installazione Docker su Windows](https://docs.docker.com/desktop/install/windows-install/)
- [Installazione Docker su Mac](https://docs.docker.com/desktop/install/mac-install/)

### Avvio del backend
Aprire un terminale, posizionarsi all'interno della cartella principale del progetto ed eseguire il comando
```shell
docker-compose up
```

La prima esecuzione di questo comando impiegherà del tempo perché Docker scaricherà le immagini necessarie all'istanziazione dei container necessari. Verrà anche creata l'immagine personalizzata dalla quale verrà poi creato il container che esegue **php-fpm**, il componente che di fatto esegue il backend.\
Le successive esecuzioni del comando `docker-compose up` saranno pressoché istantanee.

Se la struttura del database è già stata inizializzata, il backend è pronto per accettare e servire le richieste. Per terminarne l'esecuzione basterà premere `CTRL+C` sulla tastiera.

Se invece si è appena eseguito il comando `docker-compose up` per la prima volta, seguire i seguenti passi per inizializzare il database.

#### Inizializzazione della struttura del database
Una volta che il comando `docker-compose up` ha istanziato i container, aprire un nuovo terminale ed eseguire il seguente comando per "entrare" nel container che esegue **php-fpm** (il container in questione ha nome **advtodo_php_1**)
```shell
docker exec -it advtodo_php_1 bash
```

Dall'interno del container **advtodo_php_1** eseguire i seguenti comandi
```shell
/code/bin/check_migrations.sh
exit
```

La struttura del database è adesso inizializzata e il backend è pronto a servire le richieste.

### Documentazione delle API
Una volta che il backend è in esecuzione sarà possibile accedere alla pagina http://127.0.0.1:8080/api per consultare la documentazione interattiva delle API. Dalla stessa pagina sarà anche possibile provare le API.