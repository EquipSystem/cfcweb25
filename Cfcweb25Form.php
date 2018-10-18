<?php

class Cfcweb25Form extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'cfcwebsystem';
    private static $activeRecord = 'Cfcweb25';
    private static $primaryKey = 'NR_RECIBO';
    private static $formName = 'form_Cfcweb25';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle('Recibos Emitidos');

        $criteria_COD_ENTIDADE = new TCriteria();

        $criteria_COD_ENTIDADE->setProperty('order', 'CODIGO asc');

        $NR_RECIBO = new TEntry('NR_RECIBO');
        $COD_SUBENTIDADE = new TDBCombo('COD_SUBENTIDADE', 'cfcwebsystem', 'Cfcweb15', 'CODIGO', '{DESCRICAO}','CODIGO asc'  );
        $TIPO_ENTIDADE = new TCombo('TIPO_ENTIDADE');
        $COD_ENTIDADE = new TDBSeekButton('COD_ENTIDADE', 'cfcwebsystem', self::$formName, 'Cfcweb20', 'CODIGO', 'COD_ENTIDADE', 'COD_ENTIDADE_display' , $criteria_COD_ENTIDADE );
        $COD_ENTIDADE_display = new TEntry('COD_ENTIDADE_display');
        $NOME = new TEntry('NOME');
        $TIPO_LANCAMENTO = new TCombo('TIPO_LANCAMENTO');
        $VALOR = new TNumeric('VALOR', '2', ',', '.' );
        $DTA = new TDate('DTA');
        $HISTORICO1 = new TEntry('HISTORICO1');
        $HISTORICO2 = new TEntry('HISTORICO2');
        $HISTORICO3 = new TEntry('HISTORICO3');
        $QTDE_2RODAS = new TEntry('QTDE_2RODAS');
        $DESCONTO_A2R = new TNumeric('DESCONTO_A2R', '2', ',', '.' );
        $QTDE_4RODAS = new TEntry('QTDE_4RODAS');
        $DESCONTO_A4R = new TNumeric('DESCONTO_A4R', '2', ',', '.' );
        $COD_CFCFILIAL = new TDBCombo('COD_CFCFILIAL', 'cfcwebsystem', 'Cfcweb02', 'CODIGO', '{FANTASIA}','CODIGO asc'  );
        $USUARIO = new TEntry('USUARIO');
        $DATA_VENCIMENTO = new TDate('DATA_VENCIMENTO');
        $COD_PAGREC = new TEntry('COD_PAGREC');
        $COD_CONVENIO = new TDBCombo('COD_CONVENIO', 'cfcwebsystem', 'Cfcweb07', 'CODIGO', '{FANTASIA}','CODIGO asc'  );
        $COD_ALUNO = new TDBCombo('COD_ALUNO', 'cfcwebsystem', 'Cfcweb20', 'CODIGO', '{NOME}','CODIGO asc'  );
        $COD_SUBENT_TROC = new TDBCombo('COD_SUBENT_TROC', 'cfcwebsystem', 'Cfcweb11', 'CODIGO', '{DESCRICAO}','CODIGO asc'  );
        $VALOR_TROCO = new TNumeric('VALOR_TROCO', '2', ',', '.' );

        $TIPO_ENTIDADE->setChangeAction(new TAction([$this,'onTipoEntidadeChange']));

        $COD_SUBENTIDADE->addValidation('COD SUBENTIDADE', new TRequiredValidator()); 
        $TIPO_ENTIDADE->addValidation('TIPO ENTIDADE', new TRequiredValidator()); 
        $COD_ENTIDADE->addValidation('COD ENTIDADE', new TRequiredValidator()); 
        $TIPO_LANCAMENTO->addValidation('TIPO LANCAMENTO', new TRequiredValidator()); 
        $VALOR->addValidation('VALOR', new TRequiredValidator()); 
        $DTA->addValidation('DTA', new TRequiredValidator()); 
        $HISTORICO1->addValidation('HISTORICO1', new TRequiredValidator()); 
        $COD_CFCFILIAL->addValidation('COD CFCFILIAL', new TRequiredValidator()); 

        $COD_ENTIDADE->setDisplayMask('{NOME}');
        $COD_ENTIDADE->setAuxiliar($COD_ENTIDADE_display);
        $TIPO_LANCAMENTO->addItems(['C'=>'Crédito','D'=>'Débito']);
        $TIPO_ENTIDADE->addItems(['1'=>'Aluno','2'=>'Conveniado/Associado','3'=>'Instrutor','4'=>'Funcionário','5'=>'Nossa Empresa','6'=>'Bancário','7'=>'Aulas','8'=>'Tickets','9'=>'Retestes','A'=>'Simulador']);

        $DTA->setMask('dd/mm/yyyy');
        $DATA_VENCIMENTO->setMask('dd/mm/yyyy');

        $DTA->setDatabaseMask('yyyy-mm-dd');
        $DATA_VENCIMENTO->setDatabaseMask('yyyy-mm-dd');

        $NOME->setEditable(false);
        $USUARIO->setEditable(false);
        $NR_RECIBO->setEditable(false);
        $COD_PAGREC->setEditable(false);
        $COD_ENTIDADE_display->setEditable(false);

        $DTA->setSize(150);
        $NOME->setSize('70%');
        $VALOR->setSize('15%');
        $NR_RECIBO->setSize(80);
        $USUARIO->setSize('15%');
        $COD_ALUNO->setSize('70%');
        $COD_ENTIDADE->setSize(70);
        $HISTORICO3->setSize('70%');
        $COD_PAGREC->setSize('10%');
        $QTDE_4RODAS->setSize('8%');
        $QTDE_2RODAS->setSize('8%');
        $HISTORICO2->setSize('70%');
        $HISTORICO1->setSize('70%');
        $VALOR_TROCO->setSize('10%');
        $DESCONTO_A2R->setSize('10%');
        $DESCONTO_A4R->setSize('10%');
        $COD_CONVENIO->setSize('71%');
        $COD_CFCFILIAL->setSize('48%');
        $DATA_VENCIMENTO->setSize(150);
        $TIPO_ENTIDADE->setSize('20%');
        $COD_SUBENTIDADE->setSize('49%');
        $TIPO_LANCAMENTO->setSize('14%');
        $COD_SUBENT_TROC->setSize('50%');
        $COD_ENTIDADE_display->setSize(200);





        $row1 = $this->form->addFields([new TLabel('NR.RECIBO:', null, '14px', null)],[$NR_RECIBO,new TLabel('CÓD.SUBENTIDADE:', '#ff0000', '14px', null),$COD_SUBENTIDADE]);
        $row2 = $this->form->addFields([new TLabel('TIPO_ENTIDADE:', '#ff0000', '14px', null)],[$TIPO_ENTIDADE,new TLabel('CÓD.ENTIDADE:', '#ff0000', '14px', null),$COD_ENTIDADE]);
        $row3 = $this->form->addFields([new TLabel('NOME:', '#ff0000', '14px', null)],[$NOME]);
        $row4 = $this->form->addFields([new TLabel('TIPO LANÇAMENTO:', '#ff0000', '14px', null)],[$TIPO_LANCAMENTO,new TLabel('VALOR:', '#ff0000', '14px', null),$VALOR,new TLabel('DATA:', '#ff0000', '14px', null),$DTA]);
        $row5 = $this->form->addFields([new TLabel('PROVENIENTE DE:', '#ff0000', '14px', null)],[$HISTORICO1]);
        $row6 = $this->form->addFields([new TLabel('NOME ALUNO / CPF ou (OBS_1):', '#4585e3', '14px', null)],[$HISTORICO2]);
        $row7 = $this->form->addFields([new TLabel('(OBS_2):', '#4585e3', '14px', null)],[$HISTORICO3]);
        $row8 = $this->form->addContent([new TFormSeparator('(( VENDA AULAS AVULSAS ))', '#1bc3e8', '18', '#1bc3e8')]);
        $row9 = $this->form->addFields([new TLabel('QTDE 2RODAS:', null, '14px', null)],[$QTDE_2RODAS,new TLabel('DESCONTO A2R:', null, '14px', null),$DESCONTO_A2R]);
        $row10 = $this->form->addFields([new TLabel('QTDE 4RODAS:', null, '14px', null)],[$QTDE_4RODAS,new TLabel('DESCONTO A4R:', null, '14px', null),$DESCONTO_A4R]);
        $row11 = $this->form->addFields([new TLabel('CÓD.CFCFILIAL:', '#ff0000', '14px', null)],[$COD_CFCFILIAL,new TLabel('USUÁRIO:', null, '14px', null),$USUARIO]);
        $row12 = $this->form->addContent([new TFormSeparator('(( CONTA A PAGAR/RECEBER ))', '#a7d621', '18', '#a7d621')]);
        $row13 = $this->form->addFields([new TLabel('DATA VENCIMENTO:', null, '14px', null)],[$DATA_VENCIMENTO,new TLabel('CÓD.PAGAR/RECEBER:', null, '14px', null),$COD_PAGREC]);
        $row14 = $this->form->addFields([new TLabel('CÓD.CONVENIADO/ASSOCIADO:', null, '14px', null)],[$COD_CONVENIO]);
        $row15 = $this->form->addFields([new TLabel('CÓD.ALUNO:', null, '14px', null)],[$COD_ALUNO]);
        $row16 = $this->form->addContent([new TFormSeparator('(( SOMENTE PARA TROCO ))', '#83dff2', '18', '#83dff2')]);
        $row17 = $this->form->addFields([new TLabel('CÓD.SUBENTIDADE P/ TROCO:', null, '14px', null)],[$COD_SUBENT_TROC,new TLabel('VALOR TROCO:', null, '14px', null),$VALOR_TROCO]);
        $row18 = $this->form->addContent([new TFormSeparator('', '#333333', '18', '#eeeeee')]);

        // create the form actions
        $btn_onsave = $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(TBreadCrumb::create(['Operações Diárias','Recibos Emitidos']));
        $container->add($this->form);

        parent::add($container);

    }

    public static function onTipoEntidadeChange($param = null) 
    {

        if (!empty ($param['TIPO_ENTIDADE']) )
        {
           try 
           {
             //code here
             //echo "Tipo Entidade:", ($param['TIPO_ENTIDADE']);

             //TScript::create("$('#apelido').html('Fantasia');");
             //$lbapelido = new TLabel('Apelido:'); 
             //$lbapelido->setId('apelido'); 
             //$obj = new StdClass;	
             //if ($param['TIPO_ENTIDADE'] == '1') 
             //{ 
             //   $obj->COD_ENTIDADE = 'COD.ALUNO:';	
             //} 
             //else { 
             //     $obj->COD_ENTIDADE = 'COD.CONVENIADO/ASSOCIADO:'; 
             //}	
             //TForm::sendData('form_Cfcweb25',$obj); 

             // Valida o CPF para pessoas físicas
             //if ($object->TIPO_ENTIDADE == 1)
             if ( ($param['TIPO_ENTIDADE']) == '1')
             {   
                echo "Tipo Entidade:", ($param['TIPO_ENTIDADE']);

                $COD_ENTIDADE = new TDBSeekButton('COD_ENTIDADE', 'cfcwebsystem', self::$formName, 'Cfcweb20', 'CODIGO', 'COD_ENTIDADE', 'COD_ENTIDADE_display' , $criteria_COD_ENTIDADE );
                $COD_ENTIDADE_display = new TEntry('COD_ENTIDADE_display');
                $COD_ENTIDADE->setDisplayMask('{NOME}');
                $COD_ENTIDADE->setAuxiliar($COD_ENTIDADE_display);

                //$row2 = $this->form->addFields([new TLabel('TIPO_ENTIDADE:', '#ff0000', '14px', null)],[$TIPO_ENTIDADE,new TLabel('CÓD.ALUNO:', '#ff0000', '14px', null),$COD_ENTIDADE]);
                //$COD_ENTIDADE = new TDBUniqueSearch('COD_ENTIDADE', 'cfcwebsystem', 'Cfcweb20', 'CODIGO', 'CODIGO','CODIGO asc'  );

                //$validator = new TRequiredValidator;
                //validator->validate('COD.ALUNO:', $object->COD_ENTIDADE);  

                //if($object->cpf_cnpj != '000.000.000-00')
                //{
                //    $validator = new TCPFValidator;
                //    $validator->validate('CPF',$object->cpf_cnpj);
                //    
                //    $id = $this->form->getField('id');
                //
                //$validator = new TUniqueValidator;
                //$validator->validate('CODIGO', $object->COD_ENTIDADE, array('class'=>'cfcweb20','field'=>'CODIGO','pk'=>$CODIGO)); 
                //}  
             }

             // Valida o CNPJ para pessoas jurídicas
             //if ($object->TIPO_ENTIDADE == 2)
             if ( ($param['TIPO_ENTIDADE']) == '2')
             {
                echo "Tipo Entidade:", ($param['TIPO_ENTIDADE']);

                $COD_ENTIDADE = new TDBSeekButton('COD_ENTIDADE', 'cfcwebsystem', self::$formName, 'Cfcweb07', 'CODIGO', 'COD_ENTIDADE', 'COD_ENTIDADE_display' , $criteria_COD_ENTIDADE );
                $COD_ENTIDADE_display = new TEntry('COD_ENTIDADE_display');
                $COD_ENTIDADE->setDisplayMask('{FANTASIA}');
                $COD_ENTIDADE->setAuxiliar($COD_ENTIDADE_display);

                //$row2 = $this->form->addFields([new TLabel('TIPO_ENTIDADE:', '#ff0000', '14px', null)],[$TIPO_ENTIDADE,new TLabel('CÓD.CONVENIADO/ASSOCIADO:', '#ff0000', '14px', null),$COD_ENTIDADE]);
                //$COD_ENTIDADE = new TDBUniqueSearch('COD_ENTIDADE', 'cfcwebsystem', 'Cfcweb07', 'CODIGO', 'CODIGO','CODIGO asc'  );

                //$validator = new TRequiredValidator;
                //$validator->validate('COD.CONVENIADO/ASSOCIADO:',$object->COD_ENTIDADE); 

                //if($object->cpf_cnpj != '00.000.000/0000-00')
                //{
                //
                //    $validator = new TCNPJValidator;
                //    $validator->validate('CNPJ',$object->cpf_cnpj);
                //    
                //    $id = $this->form->getField('id');
                //    
                //    $validator = new TUniqueValidator;
                //    $validator->validate('CNPJ',$object->cpf_cnpj,array('class'=>'Cliente','field'=>'cpf_cnpj','pk'=>$id));     
                //}
             } 

             //if ( ($param['TIPO_ENTIDADE']) == '1')
             //{
             //   //echo 'passou entidade = 1';
             //}
             //else {
             //     if ( ($param['TIPO_ENTIDADE']) == '2')
             //     {
             //        //echo 'passou entidade = 2';
             //     }
             //}

            //</autoCode>
           }
           catch (Exception $e) 
           {
               new TMessage('error', $e->getMessage());    
           }
        }
    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            /**
            // Enable Debug logger for SQL operations inside the transaction
            TTransaction::setLogger(new TLoggerSTD); // standard output
            TTransaction::setLogger(new TLoggerTXT('log.txt')); // file
            **/

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new Cfcweb25(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            // get the generated {PRIMARY_KEY}
            $data->NR_RECIBO = $object->NR_RECIBO; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            /**
            // To define an action to be executed on the message close event:
            $messageAction = new TAction(['className', 'methodName']);
            **/

            new TMessage('info', AdiantiCoreTranslator::translate('Record saved'), $messageAction);

        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> 

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new Cfcweb25($key); // instantiates the Active Record 

                $this->form->setData($object); // fill the form 

                TTransaction::close(); // close the transaction 
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

    }

    public function onShow($param = null)
    {

    } 

}

