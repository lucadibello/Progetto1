# Progetto 1 | Diario di lavoro - 24.10.2018

##### Luca Di Bello

### Canobbio, 24.10.2018

## Lavori svolti

Durante la lezione odierna ho finito di sviluppare la funzione di correzione dati ed ho iniziato a sviluppare una classe che mi permette di operare su un file csv a scelta in modo semplificato.

| Orario        | Lavoro svolto                                          |
| ------------- | ------------------------------------------------------ |
| 13:15 - 14:00 | Finito funzione di modifica dei dati                   |
| 14:00 - 14:45 | Classe CSVisualizer.php per lettura/scrittura file csv |

## Problemi riscontrati e soluzioni adottate

Il problema dei cookie della volta scorsa ho provato a risolverlo (inizialmente) utilizzando le sessioni.
Ho scoperto che le sessioni non hanno risolto nulla ma grazie all'aiuto del professor Cattaneo ho trovato l'errore, il quale era nel mio form:
Avevo scritto così:<br>

```html
<input id="first_name" name="first_name" type="text" class="validate" value=<?php echo $nome?>>;
```

La soluzione stava nel aggiungere due virgolette (\') nel value:

```html
<input id="first_name" name="first_name" type="text" class="validate" value='<?php echo $nome?>'>;
```

## Punto della situazione rispetto alla pianificazione

Sto svolgendo più operazioni in parallelo, sono comunque al passo con il mio gantt preventivo

## Programma di massima per la prossima giornata di lavoro

Finire classe scrittura su file.
