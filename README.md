# midi2mp3-api
API REST conteneurisée (Docker, PHP, Slim, FluidSynth, Lame) pour convertion de fichier MIDI en MP3

## Mise en route

#### Installation
```bash
cd api
composer install
```
	
#### Build image
```bash
docker image build -t midi2mp3 .
```

#### Run image
```bash
docker-compose up
```
Le serveur apache est exposé sur le port 80 avec deux EndPoint : 
- http://[docker-machine]/info 
- http://[docker-machine]/convert


## Utilisation

### API Endpoint /info

#### Request
- Methode : GET
- Pas de paramètres
	
#### Response
- Content-Type : Application/json
```json
{
  "apiName": "midi2mp3",
  "version": "1",
  "description": "Convertion de fichier midi en mp3"
}
```  
	
### API Endpoint /convert
	
#### Request	
- Methode : POST
- Content-Type : Application/json
- Parametres :
-- midiData : Midi encodé en base64
-- soundfont : Police sonore a utiliser
```json
{
  "midiData": "TVRoZAAAAAYAAQACAYBNVHJrAAAAUwD/Aw1jb250cm.....AP8BC",
  "soundfont": "bagpipes"
}
```
	
#### Response
- Content-Type : Application/json
```json  
{
  "statusCode": "OK|ERROR",
  "message": "Complement d'information en cas d'erreur",
  "base64Mp3Data": "oAsAdkAJA8WoMAkDwAAJA+WoMAkD4AAJBAWoMAkEAAAJB....vAA==",
  "logs": [
    {
      "title": "FluidSynth : Convertion midi -> wav",
      "content": "Detail des logs FluidSynth"
    },
    {
      "title": "Lame : Convertion wav -> mp3",
      "content": "Detail des logs Lame"
    }
  ]
}
```
