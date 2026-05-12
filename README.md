<!-- DATAS_API_README:START -->
# Companies Module

Automatisk genereret API-README for `Companies` modulet.

- **Alias:** `companies`
- **Antal API-routes:** `56`
- **Genereret:** `2026-05-12 22:32:06`
- **Modulbeskrivelse:** API- og funktionsmodul for Companies.
- **Providers:** `Modules\Companies\Providers\CompaniesServiceProvider`

## API-kald

### `GET|HEAD` `/api/companies/companies`

- **Sti:** `/api/companies/companies`
- **Method:** `GET|HEAD`
- **Beskrivelse:** Henter en pagineret liste.
- **Output i data:** `data`: pagineret liste af Companies med modelens felter. Mulige `include` relationer: `addresses`, `address`, `contacts`, `contact`, `images`, `team`, `team.members`, `team.members.roles`, ....
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompaniesController@index`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.index`

### `POST` `/api/companies/companies`

- **Sti:** `/api/companies/companies`
- **Method:** `POST`
- **Beskrivelse:** Opretter en ny ressource.
- **Output i data:** `data`: oprettet Companies-objekt eller batch-resultat med modelens felter. Mulige `include` relationer: `addresses`, `address`, `contacts`, `contact`, `images`, `team`, `team.members`, `team.members.roles`, ....
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompaniesController@store`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.store`

### `DELETE` `/api/companies/companies/batch`

- **Sti:** `/api/companies/companies/batch`
- **Method:** `DELETE`
- **Beskrivelse:** Sletter flere ressourcer i en batch.
- **Output i data:** `data`: batch-resultat for slettede ressourcer.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompaniesController@batchDestroy`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.batchDestroy`

### `PATCH` `/api/companies/companies/batch`

- **Sti:** `/api/companies/companies/batch`
- **Method:** `PATCH`
- **Beskrivelse:** Opdaterer flere ressourcer i en batch.
- **Output i data:** `data`: opdateret Companies-objekt eller batch-resultat med modelens felter. Mulige `include` relationer: `addresses`, `address`, `contacts`, `contact`, `images`, `team`, `team.members`, `team.members.roles`, ....
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompaniesController@batchUpdate`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.batchUpdate`

### `POST` `/api/companies/companies/batch`

- **Sti:** `/api/companies/companies/batch`
- **Method:** `POST`
- **Beskrivelse:** Opretter flere ressourcer i en batch.
- **Output i data:** `data`: oprettet Companies-objekt eller batch-resultat med modelens felter. Mulige `include` relationer: `addresses`, `address`, `contacts`, `contact`, `images`, `team`, `team.members`, `team.members.roles`, ....
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompaniesController@batchStore`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.batchStore`

### `POST` `/api/companies/companies/search`

- **Sti:** `/api/companies/companies/search`
- **Method:** `POST`
- **Beskrivelse:** Søger og filtrerer ressourcer.
- **Output i data:** `data`: pagineret liste af Companies med modelens felter. Mulige `include` relationer: `addresses`, `address`, `contacts`, `contact`, `images`, `team`, `team.members`, `team.members.roles`, ....
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompaniesController@search`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.search`

### `DELETE` `/api/companies/companies/{company}`

- **Sti:** `/api/companies/companies/{company}`
- **Method:** `DELETE`
- **Beskrivelse:** Sletter en ressource.
- **Output i data:** HTTP 204 uden body eller `data: { message: string }`, afhængigt af controller.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompaniesController@destroy`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.destroy`

### `GET|HEAD` `/api/companies/companies/{company}`

- **Sti:** `/api/companies/companies/{company}`
- **Method:** `GET|HEAD`
- **Beskrivelse:** Henter en enkelt ressource.
- **Output i data:** `data`: Companies-objekt med modelens felter. Mulige `include` relationer: `addresses`, `address`, `contacts`, `contact`, `images`, `team`, `team.members`, `team.members.roles`, ....
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompaniesController@show`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.show`

### `PUT|PATCH` `/api/companies/companies/{company}`

- **Sti:** `/api/companies/companies/{company}`
- **Method:** `PUT|PATCH`
- **Beskrivelse:** Opdaterer en eksisterende ressource.
- **Output i data:** `data`: opdateret Companies-objekt eller batch-resultat med modelens felter. Mulige `include` relationer: `addresses`, `address`, `contacts`, `contact`, `images`, `team`, `team.members`, `team.members.roles`, ....
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompaniesController@update`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.update`

### `GET|HEAD` `/api/companies/companies/{company}/addresses`

- **Sti:** `/api/companies/companies/{company}/addresses`
- **Method:** `GET|HEAD`
- **Beskrivelse:** Henter en pagineret liste.
- **Output i data:** `data`: pagineret liste af Companies med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@index`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.addresses.index`

### `POST` `/api/companies/companies/{company}/addresses`

- **Sti:** `/api/companies/companies/{company}/addresses`
- **Method:** `POST`
- **Beskrivelse:** Opretter en ny ressource.
- **Output i data:** `data`: oprettet Companies-objekt eller batch-resultat med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@store`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.addresses.store`

### `POST` `/api/companies/companies/{company}/addresses/associate`

- **Sti:** `/api/companies/companies/{company}/addresses/associate`
- **Method:** `POST`
- **Beskrivelse:** Tilknytter en relateret ressource.
- **Output i data:** `data`: JSON-respons fra controlleren for Companies.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@associate`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.addresses.associate`

### `DELETE` `/api/companies/companies/{company}/addresses/batch`

- **Sti:** `/api/companies/companies/{company}/addresses/batch`
- **Method:** `DELETE`
- **Beskrivelse:** Sletter flere ressourcer i en batch.
- **Output i data:** `data`: batch-resultat for slettede ressourcer.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@batchDestroy`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.addresses.batchDestroy`

### `PATCH` `/api/companies/companies/{company}/addresses/batch`

- **Sti:** `/api/companies/companies/{company}/addresses/batch`
- **Method:** `PATCH`
- **Beskrivelse:** Opdaterer flere ressourcer i en batch.
- **Output i data:** `data`: opdateret Companies-objekt eller batch-resultat med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@batchUpdate`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.addresses.batchUpdate`

### `POST` `/api/companies/companies/{company}/addresses/batch`

- **Sti:** `/api/companies/companies/{company}/addresses/batch`
- **Method:** `POST`
- **Beskrivelse:** Opretter flere ressourcer i en batch.
- **Output i data:** `data`: oprettet Companies-objekt eller batch-resultat med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@batchStore`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.addresses.batchStore`

### `POST` `/api/companies/companies/{company}/addresses/search`

- **Sti:** `/api/companies/companies/{company}/addresses/search`
- **Method:** `POST`
- **Beskrivelse:** Søger og filtrerer ressourcer.
- **Output i data:** `data`: pagineret liste af Companies med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@search`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.addresses.search`

### `DELETE` `/api/companies/companies/{company}/addresses/{address?}`

- **Sti:** `/api/companies/companies/{company}/addresses/{address?}`
- **Method:** `DELETE`
- **Beskrivelse:** Sletter en ressource.
- **Output i data:** HTTP 204 uden body eller `data: { message: string }`, afhængigt af controller.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@destroy`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.addresses.destroy`

### `GET|HEAD` `/api/companies/companies/{company}/addresses/{address?}`

- **Sti:** `/api/companies/companies/{company}/addresses/{address?}`
- **Method:** `GET|HEAD`
- **Beskrivelse:** Henter en enkelt ressource.
- **Output i data:** `data`: Companies-objekt med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@show`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.addresses.show`

### `PUT|PATCH` `/api/companies/companies/{company}/addresses/{address?}`

- **Sti:** `/api/companies/companies/{company}/addresses/{address?}`
- **Method:** `PUT|PATCH`
- **Beskrivelse:** Opdaterer en eksisterende ressource.
- **Output i data:** `data`: opdateret Companies-objekt eller batch-resultat med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@update`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.addresses.update`

### `DELETE` `/api/companies/companies/{company}/addresses/{address?}/dissociate`

- **Sti:** `/api/companies/companies/{company}/addresses/{address?}/dissociate`
- **Method:** `DELETE`
- **Beskrivelse:** Fjerner en relation til en ressource.
- **Output i data:** `data`: JSON-respons fra controlleren for Companies.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@dissociate`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.addresses.dissociate`

### `GET|HEAD` `/api/companies/companies/{company}/contacts`

- **Sti:** `/api/companies/companies/{company}/contacts`
- **Method:** `GET|HEAD`
- **Beskrivelse:** Henter en pagineret liste.
- **Output i data:** `data`: pagineret liste af Companies med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@index`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.contacts.index`

### `POST` `/api/companies/companies/{company}/contacts`

- **Sti:** `/api/companies/companies/{company}/contacts`
- **Method:** `POST`
- **Beskrivelse:** Opretter en ny ressource.
- **Output i data:** `data`: oprettet Companies-objekt eller batch-resultat med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@store`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.contacts.store`

### `POST` `/api/companies/companies/{company}/contacts/associate`

- **Sti:** `/api/companies/companies/{company}/contacts/associate`
- **Method:** `POST`
- **Beskrivelse:** Tilknytter en relateret ressource.
- **Output i data:** `data`: JSON-respons fra controlleren for Companies.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@associate`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.contacts.associate`

### `DELETE` `/api/companies/companies/{company}/contacts/batch`

- **Sti:** `/api/companies/companies/{company}/contacts/batch`
- **Method:** `DELETE`
- **Beskrivelse:** Sletter flere ressourcer i en batch.
- **Output i data:** `data`: batch-resultat for slettede ressourcer.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@batchDestroy`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.contacts.batchDestroy`

### `PATCH` `/api/companies/companies/{company}/contacts/batch`

- **Sti:** `/api/companies/companies/{company}/contacts/batch`
- **Method:** `PATCH`
- **Beskrivelse:** Opdaterer flere ressourcer i en batch.
- **Output i data:** `data`: opdateret Companies-objekt eller batch-resultat med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@batchUpdate`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.contacts.batchUpdate`

### `POST` `/api/companies/companies/{company}/contacts/batch`

- **Sti:** `/api/companies/companies/{company}/contacts/batch`
- **Method:** `POST`
- **Beskrivelse:** Opretter flere ressourcer i en batch.
- **Output i data:** `data`: oprettet Companies-objekt eller batch-resultat med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@batchStore`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.contacts.batchStore`

### `POST` `/api/companies/companies/{company}/contacts/search`

- **Sti:** `/api/companies/companies/{company}/contacts/search`
- **Method:** `POST`
- **Beskrivelse:** Søger og filtrerer ressourcer.
- **Output i data:** `data`: pagineret liste af Companies med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@search`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.contacts.search`

### `DELETE` `/api/companies/companies/{company}/contacts/{contact?}`

- **Sti:** `/api/companies/companies/{company}/contacts/{contact?}`
- **Method:** `DELETE`
- **Beskrivelse:** Sletter en ressource.
- **Output i data:** HTTP 204 uden body eller `data: { message: string }`, afhængigt af controller.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@destroy`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.contacts.destroy`

### `GET|HEAD` `/api/companies/companies/{company}/contacts/{contact?}`

- **Sti:** `/api/companies/companies/{company}/contacts/{contact?}`
- **Method:** `GET|HEAD`
- **Beskrivelse:** Henter en enkelt ressource.
- **Output i data:** `data`: Companies-objekt med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@show`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.contacts.show`

### `PUT|PATCH` `/api/companies/companies/{company}/contacts/{contact?}`

- **Sti:** `/api/companies/companies/{company}/contacts/{contact?}`
- **Method:** `PUT|PATCH`
- **Beskrivelse:** Opdaterer en eksisterende ressource.
- **Output i data:** `data`: opdateret Companies-objekt eller batch-resultat med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@update`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.contacts.update`

### `DELETE` `/api/companies/companies/{company}/contacts/{contact?}/dissociate`

- **Sti:** `/api/companies/companies/{company}/contacts/{contact?}/dissociate`
- **Method:** `DELETE`
- **Beskrivelse:** Fjerner en relation til en ressource.
- **Output i data:** `data`: JSON-respons fra controlleren for Companies.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyAddressController@dissociate`
- **Request:** `CompanyAddressRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.companies.contacts.dissociate`

### `GET|POST|HEAD` `/api/companies/exists/{vat}`

- **Sti:** `/api/companies/exists/{vat}`
- **Method:** `GET|POST|HEAD`
- **Beskrivelse:** Kontrollerer om ressourcen findes.
- **Output i data:** `data`: `{ exists: boolean }`.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompaniesController@exists`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.`

### `GET|HEAD` `/api/companies/users`

- **Sti:** `/api/companies/users`
- **Method:** `GET|HEAD`
- **Beskrivelse:** Henter en pagineret liste.
- **Output i data:** `data`: pagineret liste af User med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@index`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.index`

### `POST` `/api/companies/users`

- **Sti:** `/api/companies/users`
- **Method:** `POST`
- **Beskrivelse:** Opretter en ny ressource.
- **Output i data:** `data`: oprettet User-objekt eller batch-resultat med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@store`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.store`

### `DELETE` `/api/companies/users/batch`

- **Sti:** `/api/companies/users/batch`
- **Method:** `DELETE`
- **Beskrivelse:** Sletter flere ressourcer i en batch.
- **Output i data:** `data`: batch-resultat for slettede ressourcer.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@batchDestroy`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.batchDestroy`

### `PATCH` `/api/companies/users/batch`

- **Sti:** `/api/companies/users/batch`
- **Method:** `PATCH`
- **Beskrivelse:** Opdaterer flere ressourcer i en batch.
- **Output i data:** `data`: opdateret User-objekt eller batch-resultat med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@batchUpdate`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.batchUpdate`

### `POST` `/api/companies/users/batch`

- **Sti:** `/api/companies/users/batch`
- **Method:** `POST`
- **Beskrivelse:** Opretter flere ressourcer i en batch.
- **Output i data:** `data`: oprettet User-objekt eller batch-resultat med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@batchStore`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.batchStore`

### `POST` `/api/companies/users/search`

- **Sti:** `/api/companies/users/search`
- **Method:** `POST`
- **Beskrivelse:** Søger og filtrerer ressourcer.
- **Output i data:** `data`: pagineret liste af User med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@search`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.search`

### `DELETE` `/api/companies/users/{user}`

- **Sti:** `/api/companies/users/{user}`
- **Method:** `DELETE`
- **Beskrivelse:** Sletter en ressource.
- **Output i data:** HTTP 204 uden body eller `data: { message: string }`, afhængigt af controller.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@destroy`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.destroy`

### `GET|HEAD` `/api/companies/users/{user}`

- **Sti:** `/api/companies/users/{user}`
- **Method:** `GET|HEAD`
- **Beskrivelse:** Henter en enkelt ressource.
- **Output i data:** `data`: User-objekt med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@show`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.show`

### `PUT|PATCH` `/api/companies/users/{user}`

- **Sti:** `/api/companies/users/{user}`
- **Method:** `PUT|PATCH`
- **Beskrivelse:** Opdaterer en eksisterende ressource.
- **Output i data:** `data`: opdateret User-objekt eller batch-resultat med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@update`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.update`

### `GET|HEAD` `/api/companies/users/{user}/companies`

- **Sti:** `/api/companies/users/{user}/companies`
- **Method:** `GET|HEAD`
- **Beskrivelse:** Henter en pagineret liste.
- **Output i data:** `data`: pagineret liste af User med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@index`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.companies.index`

### `POST` `/api/companies/users/{user}/companies`

- **Sti:** `/api/companies/users/{user}/companies`
- **Method:** `POST`
- **Beskrivelse:** Opretter en ny ressource.
- **Output i data:** `data`: oprettet User-objekt eller batch-resultat med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@store`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.companies.store`

### `POST` `/api/companies/users/{user}/companies/associate`

- **Sti:** `/api/companies/users/{user}/companies/associate`
- **Method:** `POST`
- **Beskrivelse:** Tilknytter en relateret ressource.
- **Output i data:** `data`: JSON-respons fra controlleren for User.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@associate`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.companies.associate`

### `DELETE` `/api/companies/users/{user}/companies/batch`

- **Sti:** `/api/companies/users/{user}/companies/batch`
- **Method:** `DELETE`
- **Beskrivelse:** Sletter flere ressourcer i en batch.
- **Output i data:** `data`: batch-resultat for slettede ressourcer.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@batchDestroy`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.companies.batchDestroy`

### `PATCH` `/api/companies/users/{user}/companies/batch`

- **Sti:** `/api/companies/users/{user}/companies/batch`
- **Method:** `PATCH`
- **Beskrivelse:** Opdaterer flere ressourcer i en batch.
- **Output i data:** `data`: opdateret User-objekt eller batch-resultat med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@batchUpdate`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.companies.batchUpdate`

### `POST` `/api/companies/users/{user}/companies/batch`

- **Sti:** `/api/companies/users/{user}/companies/batch`
- **Method:** `POST`
- **Beskrivelse:** Opretter flere ressourcer i en batch.
- **Output i data:** `data`: oprettet User-objekt eller batch-resultat med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@batchStore`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.companies.batchStore`

### `POST` `/api/companies/users/{user}/companies/search`

- **Sti:** `/api/companies/users/{user}/companies/search`
- **Method:** `POST`
- **Beskrivelse:** Søger og filtrerer ressourcer.
- **Output i data:** `data`: pagineret liste af User med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@search`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.companies.search`

### `DELETE` `/api/companies/users/{user}/companies/{company?}`

- **Sti:** `/api/companies/users/{user}/companies/{company?}`
- **Method:** `DELETE`
- **Beskrivelse:** Sletter en ressource.
- **Output i data:** HTTP 204 uden body eller `data: { message: string }`, afhængigt af controller.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@destroy`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.companies.destroy`

### `GET|HEAD` `/api/companies/users/{user}/companies/{company?}`

- **Sti:** `/api/companies/users/{user}/companies/{company?}`
- **Method:** `GET|HEAD`
- **Beskrivelse:** Henter en enkelt ressource.
- **Output i data:** `data`: User-objekt med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@show`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.companies.show`

### `PUT|PATCH` `/api/companies/users/{user}/companies/{company?}`

- **Sti:** `/api/companies/users/{user}/companies/{company?}`
- **Method:** `PUT|PATCH`
- **Beskrivelse:** Opdaterer en eksisterende ressource.
- **Output i data:** `data`: opdateret User-objekt eller batch-resultat med modelens felter.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@update`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.companies.update`

### `DELETE` `/api/companies/users/{user}/companies/{company?}/dissociate`

- **Sti:** `/api/companies/users/{user}/companies/{company?}/dissociate`
- **Method:** `DELETE`
- **Beskrivelse:** Fjerner en relation til en ressource.
- **Output i data:** `data`: JSON-respons fra controlleren for User.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\UserCompanyController@dissociate`
- **Request:** `CompanyRequest`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.users.companies.dissociate`

### `POST` `/api/companies/{vat}/application`

- **Sti:** `/api/companies/{vat}/application`
- **Method:** `POST`
- **Beskrivelse:** Udfører controller-handlingen `newUser`.
- **Output i data:** `data`: JSON-respons fra controlleren.
- **Auth:** Ingen `Authenticate:api` middleware registreret
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyApplicationController@newUser`
- **Request:** `Ikke angivet`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.`

### `POST` `/api/companies/{vat}/application/{user_id}`

- **Sti:** `/api/companies/{vat}/application/{user_id}`
- **Method:** `POST`
- **Beskrivelse:** Udfører controller-handlingen `existingUser`.
- **Output i data:** `data`: JSON-respons fra controlleren.
- **Auth:** Kræver API-auth
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyApplicationController@existingUser`
- **Request:** `Ikke angivet`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.`

### `POST` `/api/companies/{vat}/invitation`

- **Sti:** `/api/companies/{vat}/invitation`
- **Method:** `POST`
- **Beskrivelse:** Udfører controller-handlingen `newUser`.
- **Output i data:** `data`: JSON-respons fra controlleren.
- **Auth:** Kræver API-auth
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyInvitationController@newUser`
- **Request:** `Ikke angivet`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.`

### `POST` `/api/companies/{vat}/invitation/{user_id}`

- **Sti:** `/api/companies/{vat}/invitation/{user_id}`
- **Method:** `POST`
- **Beskrivelse:** Udfører controller-handlingen `existingUser`.
- **Output i data:** `data`: JSON-respons fra controlleren.
- **Auth:** Kræver API-auth
- **Controller:** `Modules\Companies\Http\Controllers\Api\CompanyInvitationController@existingUser`
- **Request:** `Ikke angivet`
- **Resource:** `BaseResource/JSON`
- **Route name:** `api.companies.`

<!-- DATAS_API_README:END -->
