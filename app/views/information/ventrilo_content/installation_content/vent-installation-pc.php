<h3 class="text-center">Installing Ventrilo on a Windows PC</h3>
<?php


$array = array(
    array(10, 12, 14, 16, 18),
    array(9, 11, 13, 15, 17),
    array(8, 10, 0, 14, 16),
);
 
if (count($array) == 0 || count($array[0]) == 0)
    exit();
 
$minimum = $array[0][0];
 
foreach ($array as $element):
    foreach ($element as $number):
        if ($number < $minimum):
            $minimum = $number;
        endif;
    endforeach;
endforeach;
 
echo 'The lowest value in the 2D array is ' . $minimum;
RAW Paste Data

$array = array(
	array(10, 12, 14, 16, 18),
	array(9, 11, 13, 15, 17),
	array(8, 10, 0, 14, 16),
);

if (count($array) == 0 || count($array[0]) == 0)
	exit();

$minimum = $array[0][0];

foreach ($array as $element):
	foreach ($element as $number):
		if ($number < $minimum):
			$minimum = $number;
		endif;
	endforeach;
endforeach;

echo 'The lowest value in the 2D array is ' . $minimum;
                

class Data
{
    public $m_name;
    public $m_caption;
    public $m_content;
 
    public function __construct ($name, $capt, $cont)
    {
        $this->m_name = $name;
        $this->m_caption = $capt;
        $this->m_content = $cont;
    }
 
    public function __toString()
    {
        return $this->m_name . ':' . $this->m_caption . ':' . $this->m_content;
    }
}
 
$myArray = array(
    new Data( 'steve', 'caption', 'content' ),
    new Data( 'joe', 'caption', 'content' ),
    new Data( 'snake', 'caption', 'content' ),
);
   
foreach ($myArray as $data)
{
    echo $data . '<br>';
}



?>
<div class="row">
    <div id="install-ventwinpc-ullist" class="list-group">
        <?php foreach($vent_installDocArray as $vent_winpc_id => $vent_winpc_caption):?>
            <a href="#" type="button" class="btn btn-edit btn-lg list-group-item" data-toggle="modal" data-target="#<?= $vent_winpc_id; ?>-modal">
                <h3 class ="list-group-item-heading"><?= $vent_winpc_id; ?></h3>
                <p class="list-group-item-text"><?= $vent_winpc_caption; ?></p>
            </a>
        <?php endforeach; ?>
    </div>
    <?php foreach($vent_documentArray as $vent_winpc_id => $vent_winpc_content): ?>
        <div class="modal fade" id="<?= $vent_winpc_id; ?>-modal" tabindex="-1" role="dialog" aria-labelledby="downloadvent-modal-label">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?= $vent_winpc_id; ?></h4>
                    </div>
                    <div class="modal-body">
                       <?php include('../views/information/ventrilo_content/installation_content/modal/' . $vent_winpc_content . '.php'); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-edit" data-dismiss="modal">Ok.</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;?>




    <li class="list-group-item">Follow the Installation Process.</li>
    <li class="list-group-item">Click on the --> symbol next to Users Name.</li>
    <li class="list-group-item">Click the new button.</li>
    <li class="list-group-item">Enter in a User Name; click ok.</li>
    <li class="list-group-item">Move down a row, then click the server's  --> symbol.</li>
    <li class="list-group-item">Enter in a Server Name "MPC".</li>
    <li class="list-group-item">Enter Host Name and IP as "<b>lead.typefrag.com</b>".</li>
    <li class="list-group-item">Enter port number <b>7920</b>.</li>
    <li class="list-group-item">Click OK.</li>
    <li class="list-group-item">Click the Connect button to enter.</li>
    <li class="list-group-item">Click on Setup on the right side.</li>
    <li class="list-group-item">In the pop up window, look to the top left, place checkmark on "<b>enable outgoing voice communications</b>".</li>
    <li class="list-group-item">Option 1: place checkmark on Push to Talk hotkey(PTT Mode); or adjust Sensitivity for your microphone.</li>
    <li class="list-group-item">Option 1: after check mark, look for the first open box to set your hotkey to talk.</li>
    <li class="list-group-item">Option 2: Use the sensitivity box to react when you speak. 0 is the most sensitive and consistant voice streaming. Silence Time is how long until the connection is cut off after speaking.</li>
    <li class="list-group-item">After using Option 1, or Option 2, Click TEST at the bottom left, or Click OK on the bottom right.</li>
    <li class="list-group-item">Begin Speaking on Ventrilo.</li>





    <p>Check your downloads folder to find the file, or where your current settings are set to you for downloads to fall into when completed.</p>
    <img src="img/information_page/ventrilo_downloadcomplete.PNG" class="img-responsive img-rounded img-center img-center" alt="ventrilo_downloadcomplete.PNG" />
    <p>When downloading either program it is always best to get the latest version of the component you want. Direct links to specific files are not possible for this reason. If you are posting a link to Ventrilo then please direct it to the main domain www.ventrilo.com so that people can get a quick introduction to what the Ventrilo system is.</p>
    <p>Ventrilo is supported on different platforms as well. When downloading either the client it is important that you download the appropriate platform version. For example, Microsoft Windows is the currently supported platform for the client programs. However, in the future the client program might be available for the Apple Macintosh or Linux Operating Systems.</p>
    <p>Once you've downloaded the appropriate client you can start the installer. If for any reason the installer program gives you the error like (I/O) or (CRC error) then this means that the installer program was corrupted during the download process. This is usually caused by using old web browsers when downloading the file or your browser is accessing the web through a proxy server. Unfortunately it's hard to say exactly which is the real culprit. Before downloading the file again you should flush your browsers cache to assure that a fresh copy is pulled down from the Ventrilo web site, and consider accessing the web without using a proxy.</p>
    <p>Depending on your computer or device, check each page during the installation for what you're going to have. Any customizations you may want to include, or exclude in your installation.</p>
    <img src="img/information_page/ventrilo_installer.PNG" class="img-responsive img-rounded img-center img-center" alt="ventrilo_installer.PNG" />
    <p>Once you've selected the installer Icon to begin the installation, you'll then see on your screen from what's displayed in the image above.</p>
    <p>Once the installation program is finished it will have accomplished several things:</p>
    <p>1) All files will be installed into the specified location.</p>
    <p>2) A folder called "Ventrilo" will be created in your Start / Programs menu.</p>
    <p>3) Registry entries for "ventrilo://" web links have been created.</p>
    <p>Now open up Ventrilo, and check the next slide for more details on basic Setup.</p>
</div>