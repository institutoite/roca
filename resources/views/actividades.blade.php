<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actividades</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    @include('encabezado')
    
    <div class="container mt-4">
        <table class="table table-bordered table-hover table-striped">
            <tr>
            <th>N°</th>
            <th>FECHA</th>
            <th>ACTIVIDAD</th>
            <th>LUGAR</th>
            <th>SECTOR</th>
            <th>DPTO</th>
            </tr>
            <tr>
            <td>1</td>
            <td>7-feb.</td>
            <td>Estudio Sectorial</td>
            <td>B. España</td>
            <td>CIUDAD</td>
            <td>SANTA CRUZ</td>
            </tr>
            <tr>
            <td>2</td>
            <td>28-feb.</td>
            <td>Conferencia Nal.</td>
            <td>Pinamar</td>
            <td>Buenos Aires – Arg.</td>
            <td>ARGENTINA</td>
            </tr>
            <tr>
            <td>3</td>
            <td>7-mar.</td>
            <td>Campaña de Evang.</td>
            <td>Kinchamali</td>
            <td>Cotagaita</td>
            <td>POTOSI</td>
            </tr>
            <tr>
            <td>4</td>
            <td>14-mar.</td>
            <td>Conferencia</td>
            <td>Tablaya Palca</td>
            <td>Cotagaita</td>
            <td>POTOSI</td>
            </tr>
            <tr>
            <td>5</td>
            <td>23-mar.</td>
            <td>Establecimiento Uruguay</td>
            <td></td>
            <td></td>
            <td></td>
            </tr>
            <tr>
            <td>6</td>
            <td>27-mar.</td>
            <td>Conferencia Nal.</td>
            <td>Escobar</td>
            <td>Buenos Aires – Arg.</td>
            <td>ARGENTINA</td>
            </tr>
            <tr>
            <td>7</td>
            <td>11-abr.</td>
            <td>Estudio Sectorial</td>
            <td>Sullchi</td>
            <td>Uyuni</td>
            <td>POTOSI</td>
            </tr>
            <tr>
            <td>8</td>
            <td>16-abr.</td>
            <td>Estudio Sectorial</td>
            <td>Suquicha</td>
            <td>Suquicha</td>
            <td>POTOSI</td>
            </tr>
            <tr>
            <td>9</td>
            <td>24-abr.</td>
            <td>Estudio Nal. Arg.</td>
            <td></td>
            <td></td>
            <td>ARGENTINA</td>
            </tr>
            <tr>
            <td>10</td>
            <td>25-abr.</td>
            <td>Conferencia</td>
            <td>Vicchaco</td>
            <td>Cotagaita</td>
            <td>POTOSI</td>
            </tr>
            <tr>
            <td>11</td>
            <td>25-abr.</td>
            <td>Estudio Sectorial</td>
            <td>El Fuerte</td>
            <td>Valle</td>
            <td>CHUQUISACA</td>
            </tr>
            <tr>
            <td>12</td>
            <td>25-abr.</td>
            <td>Campaña de Evang.</td>
            <td>Chuquicayara</td>
            <td>Puna</td>
            <td>POTOSI</td>
            </tr>
            <tr>
            <td>13</td>
            <td>2-may.</td>
            <td>Conferencia</td>
            <td>Pelca</td>
            <td>Yura</td>
            <td>POTOSI</td>
            </tr>
            <tr>
            <td>14</td>
            <td>9-may.</td>
            <td>Conferencia</td>
            <td>Trablaya Chica</td>
            <td>Cotagaita</td>
            <td>POTOSI</td>
            </tr>
            <tr>
            <td>15</td>
            <td>15-may.</td>
            <td>Estudio Sectorial</td>
            <td>4 Cañadas</td>
            <td>SAN JULIAN</td>
            <td>SANTA CRUZ</td>
            </tr>
            <tr>
            <td>16</td>
            <td>16-may.</td>
            <td>Campaña de Evang.</td>
            <td>Sapecho</td>
            <td>La paz</td>
            <td>LA PAZ</td>
            </tr>
            <tr>
            <td>17</td>
            <td>21-may.</td>
            <td>Estudio Sectorial</td>
            <td>Machacoyo</td>
            <td>Puna</td>
            <td>POTOSI</td>
            </tr>
            <tr>
            <td>18</td>
            <td>23-may.</td>
            <td>Estudio Sectorial</td>
            <td></td>
            <td></td>
            <td>COCHABAMBA</td>
            </tr>
            <tr>
                <td>19</td>
                <td>13-jun.</td>
                <td>Campaña de Evang.</td>
                <td>Vitichi</td>
                <td>Toropalca</td>
                <td>POTOSI</td>
              </tr>
              <tr>
                <td>20</td>
                <td>19-jun.</td>
                <td>Estudio Sectorial</td>
                <td>Quinto</td>
                <td>Jujuy</td>
                <td>ARGENTINA</td>
              </tr>
              <tr>
                <td>21</td>
                <td>27-jun.</td>
                <td>Conferencia</td>
                <td>Hayrani</td>
                <td>Toropalca</td>
                <td>POTOSI</td>
              </tr>
              <tr>
                <td>22</td>
                <td>4-jul.</td>
                <td>Conferencia</td>
                <td>Yapacani</td>
                <td>NORTE</td>
                <td>SANTA CRUZ</td>
              </tr>
              <tr>
                <td>23</td>
                <td>11-jul.</td>
                <td>Conferencia</td>
                <td>Chacna</td>
                <td>Toropalca</td>
                <td>POTOSI</td>
              </tr>
              <tr>
                <td>24</td>
                <td>18-jul.</td>
                <td>Conferencia</td>
                <td>Torcochi Chico</td>
                <td>Toropalca</td>
                <td>POTOSI</td>
              </tr>
              <tr>
                <td>25</td>
                <td>25-jul.</td>
                <td>Campaña de Evang.</td>
                <td>Chutahua</td>
                <td>Puna</td>
                <td>POTOSI</td>
              </tr>
              <tr>
                <td>26</td>
                <td>25-jul.</td>
                <td>Campaña de Evang.</td>
                <td>Kepallo</td>
                <td>Suquicha</td>
                <td>POTOSI</td>
              </tr>
              <tr>
                <td>27</td>
                <td>1-ago.</td>
                <td>Campaña de Evang.</td>
                <td>Yaretas</td>
                <td>Ckochas</td>
                <td>POTOSI</td>
              </tr>
              <tr>
                <td>28</td>
                <td>7-ago.</td>
                <td>Estudio Sectorial</td>
                <td>Litoral Marotas</td>
                <td>NORTE</td>
                <td>SANTA CRUZ</td>
              </tr>
              <tr>
                <td>29</td>
                <td>8-ago.</td>
                <td>Conferencia</td>
                <td>Capira</td>
                <td>Valle</td>
                <td>CHUQUISACA</td>
              </tr>
              <tr>
                <td>30</td>
                <td>8-ago.</td>
                <td>Estudio Sectorial</td>
                <td>Cerdas</td>
                <td>Uyuni</td>
                <td>POTOSI</td>
              </tr>
              <tr>
                <td>31</td>
                <td>8-ago.</td>
                <td>Campaña de Evang.</td>
                <td>Cruzpata</td>
                <td>Ckochas</td>
                <td>POTOSI</td>
              </tr>
              <tr>
                <td>32</td>
                <td>21-ago.</td>
                <td>Estudi Nacional</td>
                <td></td>
                <td></td>
                <td>ARGENTINA</td>
              </tr>
              <tr>
                <td>33</td>
                <td>21-ago.</td>
                <td>Campaña de Evang.</td>
                <td>Rio Mulatos</td>
                <td>Rio Mulatos</td>
                <td>POTOSI</td>
              </tr>
              <tr>
                <td>34</td>
                <td>22-ago.</td>
                <td>Campaña de Evang.</td>
                <td>Integracion San Martin</td>
                <td>SAN JULIAN</td>
                <td>SANTA CRUZ</td>
              </tr>
              <tr>
                <td>35</td>
                <td>28-ago.</td>
                <td>Estudio Sectorial</td>
                <td>Bella Vista</td>
                <td>Puna</td>
                <td>POTOSI</td>
              </tr>
              <tr>
                <td>36</td>
                <td>29-ago.</td>
                <td>Estudio Sectorial</td>
                <td></td>
                <td></td>
                <td>COCHABAMBA</td>
              </tr>
              <tr>
                <td>37</td>
                <td>29-ago.</td>
                <td>Conferencia</td>
                <td>San Gregorio</td>
                <td>Valle</td>
                <td>CHUQUISACA</td>
              </tr>
              <tr>
                <td>38</td>
                <td>7-14-sep-2024</td>
                <td>Visita Nacional e Internacional Bolivia – Brasil - Chile</td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>39</td>
                <td>19-sep.</td>
                <td>Campaña de Evang.</td>
                <td>San Miguel</td>
                <td>Ckochas</td>
                <td>POTOSI</td>
              </tr>
              <tr>
                <td>40</td>
                <td>26-sep.</td>
                <td>Campaña de Evang.</td>
                <td>El Palmar</td>
                <td>Beni</td>
                <td>BENI</td>
              </tr>
              <tr>
                <td>41</td>
                <td>26-sep.</td>
                <td>Conferencia</td>
                <td>Limeta</td>
                <td>Cotagaita</td>
                <td>POTOSI</td>
              </tr>
              <tr>
                <td>42</td>
                <td>9-oct.</td>
                <td>Estudio Sectorial</td>
                <td>Tocla</td>
                <td>Suquicha</td>
                <td>POTOSI</td>
              </tr>
              <tr>
                <td>43</td>
                <td>19-oct.</td>
                <td>Visita Internacional Argentina- Uruguay</td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>44</td>
                <td>6-nov.</td>
                <td>Estudio Sectorial</td>
                <td>CLARA SERRANO</td>
                <td>CIUDAD</td>
                <td>SANTA CRUZ</td>
              </tr>
              <tr>
                <td>45</td>
                <td>14-nov.</td>
                <td>Estudio Sectorial</td>
                <td></td>
                <td></td>
                <td>COCHABAMBA</td>
              </tr>
              <tr>
                <td>46</td>
                <td>20-nov.</td>
                <td>Estudio Deptal</td>
                <td>Tres Cruces Belen</td>
                <td></td>
                <td>POTOSI</td>
              </tr>
              <tr>
                <td>47</td>
                <td>5-dic.</td>
                <td>Estudio Sectorial</td>
                <td></td>
                <td></td>
                <td>POTOSI</td>
              </tr>
              <tr>
                <td>48</td>
                <td>12-dic.</td>
                <td>Campaña de Evang.</td>
                <td>San Cristobal</td>
                <td>CIUDAD</td>
                <td>POTOSI</td>
            </tr>
            <tr>
                <td>49</td>
                <td>20-dic.</td>
                <td>Reunion de Obreros y Colaboradores –El alto- La Paz</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>50</td>
                <td>25-dic.</td>
                <td>Estudio Nal. Arg.</td>
                <td></td>
                <td>Argentina</td>
                <td>ARGENTINA</td>
            </tr>
            <tr>
                <td>51</td>
                <td>26-dic.</td>
                <td>Conferencia</td>
                <td>Villa</td>
                <td>Rio Mulatos</td>
                <td>POTOSI</td>
            </tr>
            <tr>
                <td>52</td>
                <td>15-ene-25</td>
                <td>Estudio Inter Bolivia</td>
                <td>Betanzos</td>
                <td>Ckochas</td>
                <td>POxTOSI</td>
            </tr>
        </tbody>
        </table>

</div>
@include('footer')
</body>

</html>