# api_dni_ruc

## Requirimientos

- PHP >= 8.0
- COMPOSER

## Intalacion

clonar el repositorio.

```
git clone https://github.com/tucno21/api_dni_ruc.git
```

linea de comando necesario desde la consola

```
composer install
```

si usa php 8.1 corregir error en ...

...\vendor\giansalex\peru-consult\src\Peru\Reniec\Person.php
agregar :mixed

```php
public function jsonSerialize(): mixed
```

...\vendor\giansalex\peru-consult\src\Peru\Sunat\Company.php
agregar :mixed

```php
public function jsonSerialize(): mixed
```

## modo de configuración

cambiar el archivo env a .env

modificar la url y conección a mysql

```
APP_URL=https://apiconsulta.test/
```

## modo de uso

mediante link get / resultados en json

```
https://apiconsulta.test/consulta?dnin=1111222
https://apiconsulta.test/consulta?ruc=20111122223
```
