# Skapa en breadcrums

## Hur man använder Region Hallands plugin "region_halland_breadcrumbs"

Nedan följer instruktioner hur du kan använda pluginet "region_halland_breadcrumbs".


## Användningsområde

Denna plugin skapar en array() med "breadcrumbs" som man kan loopa ut på en "page"


## Licensmodell

Denna plugin använder licensmodell GPL-3.0. Du kan läsa mer om denna licensmodell via den medföljande filen:
```sh
LICENSE (https://github.com/RegionHalland/region-halland-breadcrumbs/blob/master/LICENSE)
```


## Installation och aktivering

```sh
A) Hämta pluginen via Git eller läs in det med Composer
B) Installera Region Hallands plugin i Wordpress plugin folder
C) Aktivera pluginet inifrån Wordpress admin
```


## Hämta hem pluginet via Git

```sh
git clone https://github.com/RegionHalland/region-halland-breadcrumbs.git
```


## Läs in pluginen via composer

Dessa två delar behöver du lägga in i din composer-fil

Repositories = var pluginen är lagrad, i detta fall på github

```sh
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/RegionHalland/region-halland-breadcrumbs.git"
  },
],
```
Require = anger vilken version av pluginen du vill använda, i detta fall version 1.0.0

OBS! Justera så att du hämtar aktuell version.

```sh
"require": {
  "regionhalland/region-halland-breadcrumbs": "1.0.0"
},
```


## Visa "breadcrumbs" på en sida via "Blade"

```sh
@if(function_exists('get_region_halland_breadcrumbs'))
  @php($myBreadcrumbs = get_region_halland_breadcrumbs()) 
  @if(isset($myBreadcrumbs))
    @foreach ($myBreadcrumbs as $myBreadcrumb)
      @if ($myBreadcrumb['url'])
        <a href="{{ $myBreadcrumb['url'] }}">{!! $myBreadcrumb['name'] !!}</a>
      @else
        <span>{!! $myBreadcrumb['name'] !!}</span>
      @endif
    @endforeach 
  @endif
@endif
```


## Ändra "hem-namnet"

```sh

Man kan även ange vad hem-namnet ska vara, default är sitens namn:

@php($myBreadcrumbs = get_region_halland_breadcrumbs()) 
Detta ger "sitens namn - osv..."

@php($myBreadcrumbs = get_region_halland_breadcrumbs('Start')) 
Detta ger "Start - osv..."
```


## Exempel på hur arrayen kan se ut

```sh
array (size=3)
  0 => 
    array (size=2)
      'name' => string 'Exempel' (length=7)
      'url' => string 'http://exempel.se' (length=17)
  1 => 
    array (size=2)
      'name' => string 'Lorem ipsum' (length=11)
      'url' => string 'http://exempel.se/lorem-ipsum/' (length=30)
  2 => 
    array (size=2)
      'name' => string 'Aldu integer' (length=12)
      'url' => boolean false
```


## Versionhistorik

### 1.2.1
- Korrigerat versionsnummer

### 1.2.0
- Uppdaterat med information om licensmodell
- Bifogat fil med licensmodell

### 1.1.1
- Justerad if-sats

### 1.1.0
- Valfritt hem-namn, default är sitens namn

### 1.0.1
- Tagit bort blankspace

### 1.0.0
- Första version
