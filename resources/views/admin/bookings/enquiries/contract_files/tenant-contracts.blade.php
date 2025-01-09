<html class="js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths desktop portrait" lang="auto" style=""><!--<![endif]-->

<head lang="en">
    <meta charset="UTF-8">
    <meta name="description" content="Estato is HTML5 Template for houses, apartmanents and vacation rentals. If you have houses for rent - you need to check our template!">
    <meta name="author" content="CreateIT">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="real estate template, real estate agency, html5">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no">

    <title>RYAN RENT</title>

    <link rel="icon" href="{{ public_path('backend/assets/images/logo.png')}}">

     <link rel="stylesheet" href="{{ asset('backend/global/css/bootstrap.min599c.css?v4.0.2') }}">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
   <style>
    *{
        color:black;
        font-family:'Times New Roman';
    }
   </style>

    <!--[if lt IE 9]>
    <script src="assets/bootstrap/js/html5shiv.min.js"></script>
    <script src="assets/bootstrap/js/respond.min.js"></script>
    <![endif]-->

    <script src="assets/js/modernizr.custom.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/52/6/intl/en_gb/common.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/52/6/intl/en_gb/util.js"></script>
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="https://www.gstatic.com/_/translate_http/_/ss/k=translate_http.tr.69JJaQ5G5xA.L.W.O/d=0/rs=AN8SPfpC36MIoWPngdVwZ4RUzeJYZaC7rg/m=el_main_css">
</head>

<body>

    <header class="agreement">
        <div class="container container-sm text-center pt-5">
            <a href="index.html">
                <img src="{{ public_path('backend/assets/images/logo.png')}}" alt="logo" width="160">
            </a>
        </div>
    </header>


    <section class="ct-u-paddingTop50 ct-u-paddingBottom100">
        <div class="container">
            <h3 class="text-center font-weight-bold">HUUROVEREENKOMST WOONRUIMTE</h3>
            <div class="line-tb">
                <p class="font-size-sm ">Model door de Raad voor Onroerende Zaken (ROZ) op 20 maart 2017 vastgesteld. <br>
                    Verwijzing naar dit model en het gebruik daarvan zijn uitsluitend toegestaan indien de ingevulde, de toegevoegde of de afwijkende tekst duidelijk als zodanig herkenbaar is. Toevoegingen en afwijkingen dienen bij voorkeur te worden opgenomen onder het hoofd 'bijzondere bepalingen'. Iedere aansprakelijkheid voor nadelige gevolgen van het gebruik van de tekst van het model wordt door de ROZ uitgesloten.
                </p>
            </div>
            <section class="agree ct-u-paddingBottom50">
                <h4 class="font-weight-bold ct-u-paddingBottom20">ONDERGETEKENDEN:</h4>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Naam</td>
                            <td>{{$company_name}}</td>
                        </tr>
                        <tr>
                            <td>Wettelijk vertegenwoordigd door</td>
                            <td>Mevr. C. Stam</td>
                        </tr>

                        <tr>
                            <td>Adres</td>
                            <td>Energieweg 22C 3133 EC Vlaardingen</td>
                        </tr>
                        <tr>
                            <td>Telefoonnummer</td>
                            <td>085 111 97 91</td>
                        </tr>
                        <tr>
                            <td>E-mailadres</td>
                            <td>Christa@ryanrent.nl</td>
                        </tr>
                    </tbody>
                </table>
                <p class="font-weight-bold">hierna te noemen 'verhuurder',</p>
                <p>EN</p>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Naam</td>
                            <td>{{$tenant_name}}</td>
                        </tr>
                        <tr>
                            <td>Wettelijk vertegenwoordigd door</td>
                            <td>Mevr. C. Stam</td>
                        </tr>

                        <tr>
                            <td>Adres</td>
                            <td>Energieweg 22C
                                3133 EC Vlaardingen</td>
                        </tr>
                        <tr>
                            <td>Telefoonnummer</td>
                            <td>085 111 97 91</td>
                        </tr>
                        <tr>
                            <td>E-mailadres</td>
                            <td>Christa@ryanrent.nl</td>
                        </tr>
                        <tr>
                            <td>E-E-mailadres voor facturen</td>
                            <td>Christa@ryanrent.nl</td>
                        </tr>
                    </tbody>
                </table>
                <p class="font-weight-bold">hierna te noemen 'huurder',</p>
            </section>

            <section class="agree">
                <h4 class="font-weight-bold ct-u-paddingBottom20">IN AANMERKING NEMENDE:</h4>
                <h5 class="font-weight-bold ct-u-paddingBottom10">{{$property->title}}</h5>
                <p>{{$property->street_address}}</p>
                <table class="ct-u-marginBottom30">
                    <tbody>
                        <tr>
                            <td width="40">1.1</td>
                            <td> Verhuurder verhuurt accommodaties en faciliteiten ten behoeve van personeelshuisvesting en dat de verhuurde accommodatie bedoeld is voor kort verblijf van personen.</td>
                        </tr>
                        <tr>
                            <td>1.2</td>
                            <td>Huurder en verhuurder uitdrukkelijk zijn overeengekomen dat huurder het gehuurde alleen voor kortverblijf ter beschikking mag stellen aan personeel welke in dienst is van huurder.</td>
                        </tr>
                        <tr>
                            <td>1.3</td>
                            <td>Het gehuurde is uitsluitend bestemd om te worden gebruikt als woonruimte, conform de regels vanuit de gemeentelijke bepalingen.</td>
                        </tr>
                        <tr>
                            <td>1.4 </td>
                            <td>Het is huurder niet toegestaan zonder voorafgaande schriftelijke toestemming van verhuurder een andere bestemming aan het gehuurde te geven dan omschreven in artikel 1.2.</td>
                        </tr>
                        <tr>
                            <td>1.5 </td>
                            <td>Huurder heeft bij het aangaan van de huurovereenkomst niet een kopie van het energielabel als bedoeld in het Besluit energieprestatie gebouwen en/of een kopie van de Energie-Index ten aanzien van het gehuurde ontvangen.</td>
                        </tr>

                    </tbody>
                </table>

                <h5 class="font-weight-bold ct-u-paddingBottom10">Voorwaarden</h5>
                <table class="ct-u-marginBottom30">
                    <tbody>
                        <tr>
                            <td width="40">2</td>
                            <td>Deze huurovereenkomst verplicht partijen tot naleving van de bepalingen van de wet met betrekking tot verhuur en huur van woonruimte voor zover daarvan in deze huurovereenkomst niet wordt afgeweken. Van deze huurovereenkomst maken deel uit de 'ALGEMENE BEPALINGEN HUUROVEREENKOMST WOONRUIMTE', vastgesteld op 20 maart 2017 en gedeponeerd op 12 april 2017 bij de griffie van de rechtbank te Den Haag en aldaar ingeschreven onder nummer 2017.21, hierna te noemen 'algemene bepalingen'. Deze algemene bepalingen zijn partijen bekend. Huurder heeft hiervan een exemplaar ontvangen. De algemene bepalingen zijn van toepassing behoudens voor zover daarvan in deze huurovereenkomst uitdrukkelijk is afgeweken of toepassing ervan ten aanzien van het gehuurde niet mogelijk is.</td>
                        </tr>
                    </tbody>
                </table>

                <h5 class="font-weight-bold ct-u-paddingBottom10">Duur, verlenging en opzegging</h5>
                <table class="ct-u-marginBottom30">
                    <tbody>
                        <tr>
                            <td width="40">3.1</td>
                            <td> Deze huurovereenkomst is aangegaan voor onbepaalde tijd met een minimale duur van [12 or whatever ] maanden, ingaande op [01 Feb 2023]</td>
                        </tr>
                        <tr>
                            <td>3.2</td>
                            <td> Verhuurder zal het gehuurde op de ingangsdatum van de huur aan huurder ter beschikking stellen, mits huurder heeft voldaan aan alle op dat moment bestaande verplichtingen jegens verhuurder. </td>
                        </tr>
                        <tr>
                            <td>3.3</td>
                            <td>Tijdens de in artikel 3.1 genoemde minimale periode, kunnen partijen deze huurovereenkomst niet tussentijds door opzegging beëindigen. </td>
                        </tr>
                        <tr>
                            <td>3.4 </td>
                            <td> Indien de in artikel 3.1 genoemde minimale periode verstrijkt, loopt de huurovereenkomst, behoudens opzegging, voor onbepaalde tijd door. </td>
                        </tr>
                        <tr>
                            <td>3.5 </td>
                            <td> Beëindiging van de huurovereenkomst door opzegging dient schriftelijk (per e-mail) te geschieden met een wederzijds opzegtermijn van 1 kalendermaand.
                            </td>
                        </tr>
                        <tr>
                            <td>3.6 </td>
                            <td>Opzegging buiten kantoortijden (ma. t/m vr. 8.30 – 17.00 uur) worden op de eerst volgende werkdag in behandeling genomen
                            </td>
                        </tr>
                        <tr>
                            <td>3.7 </td>
                            <td> Bij nadelige wijziging van de gemeentelijke verordening, SNF en/of politieke besluiten m.b.t. de huisvesting van (buitenlandse) werknemers waarbij continuering van deze overeenkomst niet langer mogelijk is, is verhuurder/ beheerder gerechtigd het huurcontract per direct te ontbinden.
                            </td>
                        </tr>

                    </tbody>
                </table>

                <h5 class="font-weight-bold ct-u-paddingBottom10">Feitelijk gebruik</h5>
                <table class="ct-u-marginBottom30">
                    <tbody>
                        <tr>
                            <td width="40">4.1</td>
                            <td>Het gehuurde is uitsluitend bedoeld voor kort verblijf van personen, korter dan 6 maanden bewoond door één en dezelfde persoon. Huurder garandeert dat geen van de gebruikers gedurende het verblijf zijn middelpunt van zijn maatschappelijk leven zal overbrengen naar de gehuurde conform (Staatscourant paragraaf 7.4.1 van het Besluit Onroerende zaken)<br>BTW</td>
                        </tr>
                        <tr>
                            <td>4.2</td>
                            <td> Huurder en verhuurder verklaren uitdrukkelijk dat op deze huurovereenkomst het verlaagde btw tarief van 9% zoals bedoeld in post B 11 van Tabel I behorende bij de Wet op de omzetbelasting 1968 verplicht van toepassing is.</td>
                        </tr>
                        <tr>
                            <td>4.3</td>
                            <td>Huurder is verplicht om periodiek bewoners registraties bij te houden en aan verhuurder te verstrekken, indien hierom verzocht wordt.</td>
                        </tr>
                        <tr>
                            <td>4.4 </td>
                            <td>Indien huurder tekortschiet in de nakoming van de op haar rustende verplichting inzake verhuur kort verblijf, komen alle daaruit voortvloeiende gevolgen in de ruimste zin des woords volledig voor rekening van huurder.</td>
                        </tr>

                    </tbody>
                </table>

                <h5 class="font-weight-bold ct-u-paddingBottom10">Betalingsverplichting, betaalperiode</h5>
                <table class="ct-u-marginBottom30">
                    <tbody>
                        <tr>
                            <td width="40">5.1</td>
                            <td>Met ingang van de ingangsdatum van deze huurovereenkomst bestaat de betalingsverplichting van huurder uit:
                                <ul>
                                    <li>de huurprijs;RYANRENT SHOULD BE ABLE SHOW OR HIDE THE FOLLOWING SENTENCES</li>
                                    <li>de vergoeding in verband met de levering van elektriciteit, gas en water voor het verbruik in het woonruimtegedeelte van het gehuurde op basis van een zich in dat gedeelte bevindende individuele meter bestaat uit een maandelijks voorschotbedrag welke achteraf wordt afgerekend op basis van de meterstanden.</li>
                                    <li>de vergoeding voor de maandelijkse afvalverwerking.</li>
                                    <li>overige zaken en diensten die geleverd worden in verband met de bewoning van het gehuurde (servicekosten);</li>
                                </ul>
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Stoffering</td>
                                            <td><select>
                                                    <option>Exclusief</option>
                                                    <option>Inclusief</option>
                                                </select></td>
                                        </tr>
                                        {{-- <tr>--}}
                                        {{-- <td>Meubilering</td>--}}
                                        {{-- <td><select>--}}
                                        {{-- <option>Inclusief</option>--}}
                                        {{-- <option>Exclusief</option>--}}
                                        {{-- </select></td>--}}
                                        {{-- </tr>--}}
                                        {{-- <tr>--}}
                                        {{-- <td>Internet</td>--}}
                                        {{-- <td><select>--}}
                                        {{-- <option>Inclusief</option>--}}
                                        {{-- <option>Exclusief</option>--}}
                                        {{-- </select></td>--}}
                                        {{-- </tr>--}}
                                        {{-- <tr>--}}
                                        {{-- <td>Bedlinnen pakket </td>--}}
                                        {{-- <td><select>--}}
                                        {{-- <option>Inclusief</option>--}}
                                        {{-- <option>Exclusief</option>--}}
                                        {{-- </select></td>--}}
                                        {{-- </tr>--}}
                                        {{-- <tr>--}}
                                        {{-- <td>Tuinonderhoud</td>--}}
                                        {{-- <td><select>--}}
                                        {{-- <option>Inclusief</option>--}}
                                        {{-- <option>Exclusief</option>--}}
                                        {{-- </select></td>--}}
                                        {{-- </tr>--}}
                                        {{-- <tr>--}}
                                        {{-- <td>Eindschoonmaak</td>--}}
                                        {{-- <td><select>--}}
                                        {{-- <option>Inclusief</option>--}}
                                        {{-- <option>Exclusief</option>--}}
                                        {{-- </select></td>--}}
                                        {{-- </tr>--}}
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>5.2</td>
                            <td>De totale huurprijs als bedoeld in artikel 4.1 is bij vooruitbetaling verschuldigd, steeds te voldoen vóór of op de eerste dag van de periode waarop de betaling betrekking heeft door middel van overschrijving op <strong>IBAN: NLXX RABO XXXX XXXX XX ten name van RyanRent B.V..</strong></td>
                        </tr>
                        <tr>
                            <td>5.3</td>
                            <td> Per maand wordt er € [TOTAL AMOUT INCLUDING TAXES] gefactureerd, bestaande uit:

                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>Bedrag excl.(€)</td>
                                            <td>BTW bedrag(€)</td>
                                            <td>Bedrag incl. (€)</td>
                                        </tr>
                                        <tr>
                                            <td>Huur woonruimte (9%)</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Inspectie + Schoonmaak (21%)</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Voorschot GWE (21%) (SEE ABOVE 5.1 IF POINT ONE IS HIDDEN - HIDE THIS TOO)</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Afvalverwerking (21%)(SEE ABOVE 5.1 IF POINT TWO IS HIDDEN - HIDE THIS TOO</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total</strong></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>5.4</td>
                            <td>Met het oog op de datum van ingang van deze huurovereenkomst heeft de eerste betaalperiode betrekking op de periode van [05 FEB 2023 ] tot en met [ 28 FEB 2023 ] en is het over deze eerste periode verschuldigde bedrag:THESE TWO DATES ARE FOR THE FIRST MONTH - IF NOT THE WHOLE MONTH, SEE ABOVE FOR CALCULATIONS PER DAY/PER HALF MONTH

                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Huur exclusief BTW</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Inspectie + Schoonmaak exclusief BTW</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Voorschot GWE exclusief BTW</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Afvalverwerking exclusief BTW</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p>Huurder zal dit bedrag voldoen vóór of op [DATE HERE SHOULD BE BEFORE THE PERIOD STARGING IN 5.4 ].</p>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <h5 class="font-weight-bold ct-u-paddingBottom10">Huurprijswijziging</h5>
                <table class="ct-u-marginBottom30">
                    <tbody>
                        <tr>
                            <td width="40">6</td>
                            <td>De huurprijs wordt voor het eerst per [01 JULY 2024 - THIS DATE WILL CHANGE EVERY YEAR TO NEXT YEAR ] en vervolgens jaarlijks aangepast overeenkomstig het gestelde in artikel 16 van de algemene bepalingen. Bovenop en gelijktijdig met de jaarlijkse aanpassing overeenkomstig artikel 16 van de algemene bepalingen, heeft de verhuurder het recht om de huurprijs te verhogen met maximaal 5%.</td>
                        </tr>
                    </tbody>
                </table>

                <h5 class="font-weight-bold ct-u-paddingBottom10">Kosten voor nutsvoorzieningen met een individuele meter </h5>
                <table class="ct-u-marginBottom30">
                    <tbody>
                        <tr>
                            <td width="40">7</td>
                            <td> [ Huurder/Verhuurder - SEE 5.1 ABOVE AND FIRST POINT HIDDEN, THEN SHOW ‘VERHUURDER’ AND IF AT 5.1 UNHIDDEN, THEN SHOW ‘HUURDER”] zal zorgdragen voor de levering van elektriciteit, gas en water voor het verbruik in het woonruimte gedeelte van het gehuurde op basis van een zich in dat gedeelte bevindende individuele</td>
                        </tr>
                    </tbody>
                </table>

                <h5 class="font-weight-bold ct-u-paddingBottom10">Servicekosten</h5>
                <table class="ct-u-marginBottom30">
                    <tbody>
                        <tr>
                            <td width="40">8</td>
                            <td>Verhuurder zal zorgdragen voor de levering van de zaken en diensten in verband met de bewoning van het gehuurde zoals benoemd in artikel 4.1.</td>
                        </tr>
                    </tbody>
                </table>
                <h5 class="font-weight-bold ct-u-paddingBottom10">Beheerder</h5>
                <table class="ct-u-marginBottom30">
                    <tbody>
                        <tr>
                            <td width="40">9.1</td>
                            <td>Totdat verhuurder anders meedeelt, treedt als beheerder op:<strong> RyanRent B.V.</strong></td>
                        </tr>
                        <tr>
                            <td width="40">9.2</td>
                            <td>Tenzij schriftelijk anders overeengekomen, dient huurder voor wat betreft de inhoud en alle verdere aangelegenheden betreffende deze huurovereenkomst met de beheerder contact op te nemen. Het kantoor van beheerder is telefonisch bereikbaar van maandag t/m vrijdag van 09:00u tot 17:00u op telefoonnummer <strong>06-82 74 63 68</strong>. Indien er geen spoed is, kunnen beheerszaken worden gemaild naar info@ryanrent.nl
                            </td>
                        </tr>
                    </tbody>
                </table>

                <h5 class="font-weight-bold ct-u-paddingBottom10">Belastingen en andere heffingen</h5>
                <table class="ct-u-marginBottom30">
                    <tbody>
                        <tr>
                            <td width="40">10.1</td>
                            <td>Tenzij dit op grond van de wet of daaruit voortvloeiende regelgeving is toegestaan, zijn voor rekening van huurder, ook als verhuurder daarvoor wordt aangeslagen:
                                <ol class="n">
                                    <li>de onroerende zaakbelasting en de waterschap- of polderlasten ter zake van het feitelijk gebruik van het gebruik van het gehuurde en het feitelijk medegebruik van dienstruimten, algemene en gemeenschappelijke ruimten;</li>
                                    <li>milieuheffingen, waaronder de verontreinigingsheffing oppervlaktewateren en zuiveringsheffing afvalwater;
                                    </li>
                                    <li>baatbelasting, of daarmee verwante belastingen of heffingen, geheel of een evenredig gedeelte daarvan, indien en voor zover huurder is gebaat bij datgene op grond waarvan de aanslag of heffing wordt opgelegd;
                                    </li>
                                    <li>overige bestaande of toekomstige belastingen, milieubescherming bijdragen, lasten, heffingen en retributies <br>
                                        - ter zake van het feitelijk gebruik van het gehuurde;<br>
                                        - ter zake van goederen van huurder;<br>
                                        - die niet geheel of gedeeltelijk zouden zijn geheven of opgelegd, als het gehuurde niet in gebruik zou zijn gegeven.

                                    </li>

                                </ol>
                            </td>
                        </tr>

                        <tr>
                            <td>10.2</td>
                            <td> Indien de voor rekening van huurder komende heffingen, belastingen, retributies of andere lasten bij verhuurder worden geïnd, moeten deze door huurder op eerste verzoek aan verhuurder worden voldaan. Verhuurder kan huurder eveneens aanslaan voor voorgaande benoemde belastingen, heffingen en of lasten die in het navolgende jaar worden geïnd, maar nog betrekking hebben op het voorgaande jaar waarin huurder het gehuurde in gebruik heeft gehad, zelfs in het geval huurder op het desbetreffende moment geen huurder meer is van het gehuurde. </td>
                        </tr>
                    </tbody>
                </table>

                <h5 class="font-weight-bold ct-u-paddingBottom10">Waarborgsom</h5>
                <table class="ct-u-marginBottom30">
                    <tbody>
                        <tr>
                            <td width="40">11.1</td>
                            <td> Huurder zal voor de ingangsdatum een waarborgsom betalen ter grootte van een bedrag van € [5.3 FIRST AMOUNT EXCLUDING 9% TAX, SO JUST THE RENT AMOUNT] .</td>
                        </tr>

                        <tr>
                            <td>11.2</td>
                            <td>Waarborgsom zal binnen redelijke termijn na het beëindigen van de huurovereenkomst worden geretourneerd aan huurder, mits alle afspraken en verplichtingen die voortvloeien uit deze overeenkomst zijn nagekomen. Indien er sprake is van schade, dient het schadebedrag definitief te worden vastgesteld alvorens verhuurder overgaat tot eventuele uitbetaling van het restant van de waarborgsom. </td>
                        </tr>
                        <tr>
                            <td>11.3</td>
                            <td> Over de waarborgsom wordt geen rente vergoed. </td>
                        </tr>

                    </tbody>
                </table>

                <h5 class="font-weight-bold ct-u-paddingBottom10">Bijzondere bepalingen</h5>
                <table class="ct-u-marginBottom30">
                    <tbody>
                        <tr>
                            <td width="40">12</td>
                            <td> Verhuurder en huurder verklaren het gehuurde te hebben overgedragen en aanvaard in de staat van oplevering welke is vastgesteld in het opleveringsrapport welke door beide partijen akkoord is bevonden.</td>
                        </tr>

                        <tr>
                            <td>13</td>
                            <td>Eventuele later ontstane gebreken dienen door huurder, voor zover dit redelijkerwijs verwacht kan worden, gemeld te worden bij beheerder. Huurder is verantwoordelijk voor eventuele (vervolg)schade als gevolg van nalatigheid hierin.</td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td> Verhuurder is verplicht op verlangen van de huurder gebreken aan het gehuurde binnen redelijke termijn te verhelpen, tenzij dit niet mogelijk is of uitgaven vereist die redelijkerwijs niet van de verhuurder zijn te vergen, dan wel voor zover in gevolge de wet, deze overeenkomst of het gebruik voor rekening van huurder komen. Hiervoor geldt dat verhuurder streeft naar het verhelpen van gebreken binnen 48 uur na de melding, indien de verhuurder hierin niet afhankelijk is van derden.</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>Bij het einde van de huurovereenkomst is huurder verplicht het gehuurde onder afgifte van alle sleutels geheel ontruimd en schoon aan verhuurder op te leveren in dezelfde goede staat, waarin hij het gehuurde met de daarin aanwezige installaties, voorzieningen en eventuele inventaris bij de aanvang van huur heeft aanvaard, behoudens voor zover er sprake is van normale slijtage, die voor rekening en risico van verhuurder komt. Indien huurder niet aan deze verplichting voldoet, is verhuurder gerechtigd om het gehuurde professioneel te laten reinigen en te laten ontruimen van persoonlijke eigendommen van huurder/de bewoners. De kosten die verhuurder hiervoor maakt, zullen worden doorberekend aan huurder, dan wel worden ingehouden bij de verrekening van de waarborgsom.</td>
                        </tr>
                        <tr>
                            <td>16</td>
                            <td> Huurder zal het gehuurde gebruiken en onderhouden zoals het een goed huurder betaamt. Hieronder mede inbegrepen het correct schoonhouden van de woning, de (gemeenschappelijke) (buiten)ruimten en alle aanhorigheden.</td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td> Huurder is volledig verantwoordelijk en aansprakelijk voor eventuele schade, vernieling en diefstal. Verhuurder verplicht zich tot het correct onderhouden en waar nodig vervangen van de inventaris zoals deze bij aanvang bij partijen bekend is.</td>
                        </tr>
                        <tr>
                            <td>18</td>
                            <td> Het is huurder niet toegestaan zonder schriftelijk toestemming van verhuurder wijzigingen en veranderingen, in de breedste zin van het woord, aan het gehuurde, de daarbij behorende inventaris en de gemeenschappelijke ruimten aan te brengen.</td>
                        </tr>
                        <tr>
                            <td>19</td>
                            <td> Verhuurder is gerechtigd om periodiek inspecties uit te voeren in het gehuurde. Deze inspecties mogen zowel aangekondigd als onaangekondigd plaatsvinden, mits deze tijdens kantoortijden wordt uitgevoerd.</td>
                        </tr>
                        <tr>
                            <td>20</td>
                            <td> Het houden van huisdieren is zonder schriftelijke toestemming van verhuurder niet toegestaan.</td>
                        </tr>
                        <tr>
                            <td>21</td>
                            <td>Het gebruiken, telen, produceren, het voorhanden hebben voor zowel (recreatief) eigen gebruik als verkoop van verdovende middelen, waarbij geen onderscheid wordt gemaakt tussen soft- en harddrugs, wapens en alle andere zaken verboden per Opiumwet en de wet wapens en munitie zijn ten strengste verboden in de woning en aanhorigheden.</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td> Indien sprake is van een VvE (Vereniging van Eigenaars) dient huurder zich onvoorwaardelijk aan de reglementen en statuten van de VvE te houden.</td>
                        </tr>
                        <tr>
                            <td>23</td>
                            <td>Op deze overeenkomst is het Nederlands recht van toepassing.</td>
                        </tr>

                    </tbody>
                </table>
            </section>
            <section>
                <p>Aldus opgemaakt en ondertekend in tweevoud</p>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td>Vlaarding</td>
                                        </tr>
                                        <tr>
                                            <td>_______________________</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>{{$tenant_name}}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>(verhuurder)</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>{{ $todays_date }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td width="50"></td>
                            <td>
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td>Plaats</td>
                                            <td>{{$todays_date}}</td>
                                        </tr>
                                        <tr>
                                            <td>_______________________</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>{{$contract_officer}}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>(huurder)</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>{{ $todays_date }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </section>


        </div>
    </section>
    <!-- JavaScripts -->

    <script src="{{ asset('backend/global/vendor/jquery/jquery.min599c.js?v4.0.2') }}"></script>
    <script src="{{ asset('backend/global/vendor/bootstrap/bootstrap.min599c.js?v4.0.2') }}"></script>
    <script src="assets/js/dependencies.js"></script>
    <script src="assets/js/select2/select2.min.js"></script>
    <script src="assets/js/slider-bootstrap/bootstrap-slider.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIjilmMEnfn4h1qOfm3eubSf6PuvGAZzs"></script>
    <script src="assets/js/gmaps/gmap3.min.js"></script>
    <script src="assets/js/ct-mediaSection/jquery.stellar.min.js"></script>
    <script src="assets/js/main.js"></script>
    <div id="goog-gt-" class="skiptranslate VIpgJd-yAWNEb-L7lbkb" dir="ltr">
        <div style="padding: 8px;">
            <div>
                <div class="VIpgJd-yAWNEb-l4eHX"><img src="https://www.gstatic.com/images/branding/product/1x/translate_24dp.png" width="20" height="20" alt="Google Translate"></div>
            </div>
        </div>
        <div style="padding: 8px; float: left; width: 100%;">
            <h1 class="VIpgJd-yAWNEb-r4nke VIpgJd-yAWNEb-mrxPge">Original text</h1>
        </div>
        <div style="padding: 8px;">
            <div class="VIpgJd-yAWNEb-nVMfcd-fmcmS"></div>
        </div>
        <div class="VIpgJd-yAWNEb-cGMI2b" style="padding: 8px;">
            <div class="VIpgJd-yAWNEb-Z0Arqf-PLDbbf"><span class="VIpgJd-yAWNEb-Z0Arqf-hSRGPd">Contribute a better translation</span></div>
            <div class="VIpgJd-yAWNEb-fw42Ze-Z0Arqf-haAclf">
                <hr style="color: #ccc; background-color: #ccc; height: 1px; border: none;">
                <div class="VIpgJd-yAWNEb-Z0Arqf-H9tDt"></div>
            </div>
        </div>
        <div class="VIpgJd-yAWNEb-jOfkMb-Ne3sFf" style="display: none;"></div>
    </div>
</body>

</html>