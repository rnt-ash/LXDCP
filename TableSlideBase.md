# OVZ Control Panel TableSlideBase Controller
---
## Allgemein
Damit Datensätze besser einheitlich dargestellt werden können wurde die TableSlide Funktionalität entwickelt. Als Basis dien die Klasse TableSlideBase.php. Kontroller welche von dieser Klasse abgeleitet werden enthalten die Grundfunktiuonalität um Datensätze als Tabelle oder als Slides darstellen zu können.

## Anwendung als Table
Kontroller müssen von der Basisklasse TableSlideBase abgeleitet werden.
```
class MyController extends TableSlideBase
```
Im Kontroller muss die Methode getTableDataInfo() implementiert sein, welche den Aufbau der Tabelle beschreibt.
```
protected function getTableDataInfo() {
    return array(
        "type" => "tableData",
        "controller" => "myCustomers",
        "action" => "index",
        "scope" => "",
        "order" => "name",
        "orderdir" => "asc",
        "filters" => array(),
        "page" => 1,
        "limit" => 10,
        "columns" => array(
            "itemnr"=>array(
                "title"=>"#",
                "show"=>true,
                "pos"=>1,
                "width"=>20,
            ),
            "name"=>array(
                "title"=>"Name",
                "show"=>true,
                "pos"=>2,
                "width"=>200,
            ),
            "company"=>array(
                "title"=>"Company",
                "show"=>true,
                "pos"=>3,
                "width"=>200,
            ),
        ),
    );
}

```

## Anwendung als Slide
Kontroller müssen von der Basisklasse TableSlideBase abgeleitet werden.
```
class MyController extends TableSlideBase
```

Im Kontroller muss die Methode getSlideDataInfo() implementiert sein, welche den Aufbau des Slides beschreibt.
```
protected function getSlideDataInfo() {
    return array(
        "type" => "slideData",
        "controller" => "myController",
        "action" => "slidedata",
        "slidenamefield" => "name",
        "slidenamefielddescription" => "Name",
        "scope" => "",
        "join" => "",
        "order" => "name",
        "orderdir" => "ASC",
        "filters" => array(),
        "page" => 1,
        "limit" => 10,
        "childtable" => array(
            "classname"=>"myChildController",
            "parentjoin"=>"my_id",
            "order" => "id",
            "orderdir" => "ASC",
        )
    );
}
```

Es muss ein View erstellt werden welcher das Template `templates/slidedata.volt` erweitert.
```
{% extends "templates/slidedata.volt" %}

{% block header %}
<div class="well">
    <h3>Slide Data Header</h3>
</div>
{% endblock %}

{% block footer %}
<div class="well well-sm">
    Slide Data Footer
</div>
{% endblock %}
```

Der View ruft die Methode `renderSlideHeader($item,$level)` auf. Diese muss im Kontroller implementiert werden. Dabei muss für jede Verschachtelungstiefe der korrekte Herder erzeugt werden.

`$item`: Item als Objekt zu welchem der Header gerendert werden muss.

`$level`: aktuelle Verschachtelungstiefe des Slides

```
protected function renderSlideHeader($item,$level){
    switch($level){
        case 0:
            return $item->name; 
            break;
        case 1:
            return $item->value1;
            break;
        default:
            return "invalid level!";
    }
}

```

Der View ruft die Methode `renderSlideDetail($item,$level)` auf. Diese muss im Kontroller implementiert werden. 

`$item`: Item als Objekt zu welchem Detailansicht gerendert werden muss.

`$level`: aktuelle Verschachtelungstiefe des Slides


## Security
Für TableData müssen folgende Actions erlaubt sein:
```
'index', 'new', 'edit', 'save', 'delete', 'tabledata'
```
Für SlideData müssen folgende Actions erlaubt sein:
```
'index', 'new', 'edit', 'save', 'delete', 'slidedata', 'slideSlide'
```

## Filter
Die anzuzeigenedn Datensätze können gefiltert werden. dazu muss im Kontroller die Methode `filterSlideItems($items,$level)` implementiert werden.

`$items`: Phalcon Resultset

`$level`: aktuelle Verschachtelungstiefe des Slides (Für TableData immer 0)

In dieser Methode werden alle Werte der Filter abgeholt und dem Resultset die entsprechenden Filter erzeugt. Weitere Informationen zum filtern von Resultsets findet man [hier] (https://docs.phalconphp.com/en/3.0.0/reference/models.html#filtering-resultsets) 
