<?php
require_once('campo.php');
class CampoFile extends Campo {
    
    public $requiere_datos=false;

    protected function display($modo, $dato,$etapa_id) {
        if(!$etapa_id){
            $display='<label class="control-label">' . $this->etiqueta . (in_array('required', $this->validacion) ? '' : ' (Opcional)') . '</label>';
            $display.='<div class="controls">';
            $display.='<input id="'.$this->id.'" type="hidden" name="' . $this->nombre . '" value="" />';
            $display.='<button type="button" class="btn">Subir archivo</button>';
            
            if($this->ayuda)
                $display.='<span class="help-block">'.$this->ayuda.'</span>';
            $display.='</div>';
            return $display;
        }
        
        $etapa = Doctrine::getTable('Etapa')->find($etapa_id);
        
        $display='<label class="control-label">' . $this->etiqueta . (in_array('required', $this->validacion) ? '' : ' (Opcional)') . '</label>';
        $display.='<div class="controls">';
        $display.='<div class="file-uploader" data-action="'.site_url('uploader/datos/'.$this->id.'/'.$etapa->id).'" '. ($modo=='visualizacion'?' hidden':'') .' "></div>';
        $display.='<input id="'.$this->id.'" type="hidden" name="' . $this->nombre . '" value="' . ($dato ? htmlspecialchars($dato->valor) : '') . '" />';
        
        if ($dato){
            $file=Doctrine::getTable('File')->findOneByTipoAndFilename('dato',$dato->valor);
            if($file){
                $display.='<p class="link"><a href="' . site_url('uploader/datos_get/'.$file->filename).'?id='.$file->id.'&amp;token='.$file->llave.'" target="_blank">' . htmlspecialchars ($dato->valor) . '</a>';
                if(!($modo=='visualizacion'))
                    $display.='(<a class="remove" href="#">X</a>)</p>';
            }else{
                $display.='<p class="link">No se ha subido archivo.</p>';
            }
        }
        else
            $display.='<p class="link"></p>';
        
        if($this->ayuda)
            $display.='<span class="help-block">'.$this->ayuda.'</span>';
        
        $display.='</div>';

        return $display;
    }

    
    public function extraForm() {
        $filetypes=array();
        if(isset($this->extra->filetypes))
            $filetypes=$this->extra->filetypes;
        
        $output= '<select name="extra[filetypes][]" multiple>';
        $output.='<option name="jpg" '.(in_array('jpg', $filetypes)?'selected':'').'>jpg</option>';
        $output.='<option name="png" '.(in_array('png', $filetypes)?'selected':'').'>png</option>';
        $output.='<option name="gif" '.(in_array('gif', $filetypes)?'selected':'').'>gif</option>';
        $output.='<option name="pdf" '.(in_array('pdf', $filetypes)?'selected':'').'>pdf</option>';
        $output.='<option name="doc" '.(in_array('doc', $filetypes)?'selected':'').'>doc</option>';
        $output.='<option name="docx" '.(in_array('docx', $filetypes)?'selected':'').'>docx</option>';
        $output.='<option name="xls" '.(in_array('xls', $filetypes)?'selected':'').'>xls</option>';
        $output.='<option name="xlsx" '.(in_array('xlsx', $filetypes)?'selected':'').'>xlsx</option>';
        $output.='<option name="mpp" '.(in_array('mpp', $filetypes)?'selected':'').'>mpp</option>';
        $output.='<option name="vsd" '.(in_array('vsd', $filetypes)?'selected':'').'>vsd</option>';
        $output.='<option name="ppt" '.(in_array('ppt', $filetypes)?'selected':'').'>ppt</option>';
        $output.='<option name="pptx" '.(in_array('pptx', $filetypes)?'selected':'').'>pptx</option>';
        $output.='<option name="zip" '.(in_array('zip', $filetypes)?'selected':'').'>zip</option>';
        $output.='<option name="rar" '.(in_array('rar', $filetypes)?'selected':'').'>rar</option>';
        $output.='<option name="odt" '.(in_array('odt', $filetypes)?'selected':'').'>odt</option>';
        $output.='<option name="odp" '.(in_array('odp', $filetypes)?'selected':'').'>odp</option>';
        $output.='<option name="ods" '.(in_array('ods', $filetypes)?'selected':'').'>ods</option>';
        $output.='<option name="odg" '.(in_array('odg', $filetypes)?'selected':'').'>odg</option>';
        $output.='</select>';
        
        return $output;
    }
}