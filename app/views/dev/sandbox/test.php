$array = array(
        array(
            'type'=>'mpcintro',
            'source'=>'https://www.youtube.com/embed/ZfK_PgBBacs',
            'credits'=>'MPC-SeaDog - 2015',
        ),
        array(
            'type'=>'micro',
            'source'=>'https://www.youtube.com/embed/YbpCLqryN-Q',
            'credits'=>'Nada & Moon'
        ),
        array(
            'type'=>'miacro',
            'source'=>'#',
            'credits'=>'',
        )
    );

foreach($array as $element)
{
  print('Array----
');
  foreach ($element as $key => $subelement)
  {
    print($key . ' -- ' . $subelement . '
')}