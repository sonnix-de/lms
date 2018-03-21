/**
 * Diese Klasse verwaltet die Daten für Flash-Messages.
 * z.B. für validierte Eingaben, Fehler in der Verarbeitung oder die erfolgreiche Speicherung von Daten.
 * @author Hans-Jürgen Sonnleitner
 * @version 1.0 (22.03.2018)
  */
class FlashesAndLogs {
    /**
     *  Konstruktur mit Datendefinition
     */
    constructor() {
        this.flashs = [];
    }


    /**
     * allgemeine Flash Funktion mit allen parametern
     * @param {string} message 
     * @param {string} severity Schweregrad info, warning oder danger
     * @param {int} display  wie lange soll die Meldung angezeigt werden.
     */
    flash(message, severity='info', display='3')
    {
        let id = this.getUniqueId();
        console.log ('flash:',id);
        this.flashs.push({id:id, message:message,severity:severity, display:display});
        var self = this;
        var timeout = display*1000
        console.log (timeout);
        setTimeout(function(){ self.removeFlash(id) }, timeout);
    }

    /**
     * Info-Meldung
     * @param {string} message Text, der ausgegeben wird
     * @param {int} display wie lange soll der Text ausgegeben werden
     */
    info(message, display = 3)
    {
        this.flash(message,'info',display);
    }

    /**
     * Warn-Meldung
     * @param {string} message Text, der ausgegeben wird
     * @param {int} display wie lange soll der Text ausgegeben werden
     */
    warning (message, display=15)
    {
        this.flash (message, 'warning', display);
    }

    /**
     * Fehler-Meldung / Gefahrenmeldung lt. Bootstrap style
     * @param {string} message Text, der ausgegeben wird
     * @param {int} display wie lange soll der Text ausgegeben werden
     */
    danger (message, display=15)
    {
        this.flash (message, 'danger', display);
    }

    /**
     * Hilfsfunktion um einen eindeutigen Index für die Meldung zu bekommen.
     */
    getUniqueId()
    {
        let timestamp = +new Date;
        return timestamp.toString();
    }

    /**
     * Funktion, um eine Meldung aus dem Flash-Array zu entfernen.
     * @param {string} id eindeutige ID de rmeldung (wird von getUniqueId erzeugt)
     */
    removeFlash (id)
    {
        for (flash of this.flashs) 
        {
            if (flash.id == id)
            {
                let index = this.flashs.indexOf(flash);
                this.flashs.splice(index, 1);
            }
        }
    }

    /**
     * Übergabe der Flash-Meldungen für die Ausgabe
     */
    getFlashes()
    {
        return this.flashs;
    }


    /**
     * Löschen aller Meldungen
     */
    reset() {
        this.flashs.clear();
    }

}
/**
 * Definiert die globale Variable für Flash Messages
 */
window.Flash = new FlashesAndLogs();
