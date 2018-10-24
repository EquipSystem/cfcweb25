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

        $criteria_COD_ENTIDADE_NOSSAEMPRESA = new TCriteria();
        $criteria_COD_ENTIDADE_FUNCIONARIOS = new TCriteria();
        $criteria_COD_ENTIDADE_FROTA = new TCriteria();
        $criteria_COD_ENTIDADE_CONVENIADOS = new TCriteria();
        $criteria_COD_ENTIDADE_ALUNOS = new TCriteria();

        $criteria_COD_ENTIDADE_NOSSAEMPRESA->setProperty('order', 'FANTASIA asc');
        $criteria_COD_ENTIDADE_FUNCIONARIOS->setProperty('order', 'NOME asc');
        $criteria_COD_ENTIDADE_FROTA->setProperty('order', 'DESCRICAO asc');
        $criteria_COD_ENTIDADE_CONVENIADOS->setProperty('order', 'FANTASIA asc');
        $criteria_COD_ENTIDADE_ALUNOS->setProperty('order', 'NOME asc');

        $NR_RECIBO = new TEntry('NR_RECIBO');
        $COD_ENTIDADE = new TEntry('COD_ENTIDADE');
        $NOME = new TEntry('NOME');
        $COD_SUBENTIDADE = new TDBCombo('COD_SUBENTIDADE', 'cfcwebsystem', 'Cfcweb15', 'CODIGO', '{DESCRICAO}','CODIGO asc'  );
        $COD_TIPOENTIDADE = new TDBCombo('COD_TIPOENTIDADE', 'cfcwebsystem', 'Cfcweb23', 'CODIGO', '{NOME_ENTIDADE}','CODIGO asc'  );
        $COD_ENTIDADE_NOSSAEMPRESA = new TDBSeekButton('COD_ENTIDADE_NOSSAEMPRESA', 'cfcwebsystem', self::$formName, 'Cfcweb01', 'FANTASIA', 'COD_ENTIDADE_NOSSAEMPRESA', 'COD_ENTIDADE_NOSSAEMPRESA_display' , $criteria_COD_ENTIDADE_NOSSAEMPRESA );
        $COD_ENTIDADE_NOSSAEMPRESA_display = new TEntry('COD_ENTIDADE_NOSSAEMPRESA_display');
        $COD_ENTIDADE_FUNCIONARIOS = new TDBSeekButton('COD_ENTIDADE_FUNCIONARIOS', 'cfcwebsystem', self::$formName, 'Cfcweb05', 'NOME', 'COD_ENTIDADE_FUNCIONARIOS', 'COD_ENTIDADE_FUNCIONARIOS_display' , $criteria_COD_ENTIDADE_FUNCIONARIOS );
        $COD_ENTIDADE_FUNCIONARIOS_display = new TEntry('COD_ENTIDADE_FUNCIONARIOS_display');
        $COD_ENTIDADE_FROTA = new TDBSeekButton('COD_ENTIDADE_FROTA', 'cfcwebsystem', self::$formName, 'Cfcweb06', 'DESCRICAO', 'COD_ENTIDADE_FROTA', 'COD_ENTIDADE_FROTA_display' , $criteria_COD_ENTIDADE_FROTA );
        $COD_ENTIDADE_FROTA_display = new TEntry('COD_ENTIDADE_FROTA_display');
        $COD_ENTIDADE_CONVENIADOS = new TDBSeekButton('COD_ENTIDADE_CONVENIADOS', 'cfcwebsystem', self::$formName, 'Cfcweb07', 'FANTASIA', 'COD_ENTIDADE_CONVENIADOS', 'COD_ENTIDADE_CONVENIADOS_display' , $criteria_COD_ENTIDADE_CONVENIADOS );
        $COD_ENTIDADE_CONVENIADOS_display = new TEntry('COD_ENTIDADE_CONVENIADOS_display');
        $COD_ENTIDADE_ALUNOS = new TDBSeekButton('COD_ENTIDADE_ALUNOS', 'cfcwebsystem', self::$formName, 'Cfcweb20', 'NOME', 'COD_ENTIDADE_ALUNOS', 'COD_ENTIDADE_ALUNOS_display' , $criteria_COD_ENTIDADE_ALUNOS );
        $COD_ENTIDADE_ALUNOS_display = new TEntry('COD_ENTIDADE_ALUNOS_display');
        $TIPO_LANCAMENTO = new TCombo('TIPO_LANCAMENTO');
        $VALOR = new TNumeric('VALOR', '2', ',', '.' );
        $DTA = new TDate('DTA');
        $HISTORICO1 = new TEntry('HISTORICO1');
        $HISTORICO2 = new TEntry('HISTORICO2');
        $HISTORICO3 = new TEntry('HISTORICO3');
        $COD_CFCFILIAL = new TDBCombo('COD_CFCFILIAL', 'cfcwebsystem', 'Cfcweb02', 'CODIGO', '{FANTASIA}','FANTASIA asc'  );
        $QTDE_2RODAS = new TEntry('QTDE_2RODAS');
        $DESCONTO_A2R = new TEntry('DESCONTO_A2R');
        $QTDE_4RODAS = new TEntry('QTDE_4RODAS');
        $DESCONTO_A4R = new TEntry('DESCONTO_A4R');
        $DATA_VENCIMENTO = new TDate('DATA_VENCIMENTO');
        $COD_PAGREC = new TEntry('COD_PAGREC');

        $COD_TIPOENTIDADE->setChangeAction(new TAction([$this,'onChangeCodEntidade']));

        $COD_SUBENTIDADE->addValidation('COD SUBENTIDADE', new TRequiredValidator()); 
        $TIPO_LANCAMENTO->addValidation('TIPO LANCAMENTO', new TRequiredValidator()); 
        $VALOR->addValidation('VALOR', new TRequiredValidator()); 
        $DTA->addValidation('DATA', new TRequiredValidator()); 

        $TIPO_LANCAMENTO->addItems(['C'=>'Crédito','D'=>'Débito']);
        $DTA->setMask('dd/mm/yyyy');
        $DATA_VENCIMENTO->setMask('dd/mm/yyyy');

        $DTA->setDatabaseMask('yyyy-mm-dd');
        $DATA_VENCIMENTO->setDatabaseMask('yyyy-mm-dd');

        $COD_ENTIDADE_ALUNOS->setDisplayMask('{NOME}');
        $COD_ENTIDADE_FROTA->setDisplayMask('{DESCRICAO}');
        $COD_ENTIDADE_FUNCIONARIOS->setDisplayMask('{NOME}');
        $COD_ENTIDADE_CONVENIADOS->setDisplayMask('{FANTASIA}');
        $COD_ENTIDADE_NOSSAEMPRESA->setDisplayMask('{FANTASIA}');

        $COD_ENTIDADE_FROTA->setAuxiliar($COD_ENTIDADE_FROTA_display);
        $COD_ENTIDADE_ALUNOS->setAuxiliar($COD_ENTIDADE_ALUNOS_display);
        $COD_ENTIDADE_CONVENIADOS->setAuxiliar($COD_ENTIDADE_CONVENIADOS_display);
        $COD_ENTIDADE_NOSSAEMPRESA->setAuxiliar($COD_ENTIDADE_NOSSAEMPRESA_display);
        $COD_ENTIDADE_FUNCIONARIOS->setAuxiliar($COD_ENTIDADE_FUNCIONARIOS_display);

        $DTA->setEditable(false);
        $NOME->setEditable(false);
        $NR_RECIBO->setEditable(false);
        $COD_PAGREC->setEditable(false);
        $COD_ENTIDADE->setEditable(false);
        $COD_ENTIDADE_FROTA_display->setEditable(false);
        $COD_ENTIDADE_ALUNOS_display->setEditable(false);
        $COD_ENTIDADE_CONVENIADOS_display->setEditable(false);
        $COD_ENTIDADE_NOSSAEMPRESA_display->setEditable(false);
        $COD_ENTIDADE_FUNCIONARIOS_display->setEditable(false);

        $DTA->setSize(140);
        $NOME->setSize('36%');
        $VALOR->setSize('15%');
        $NR_RECIBO->setSize(70);
        $HISTORICO3->setSize('70%');
        $HISTORICO2->setSize('70%');
        $HISTORICO1->setSize('70%');
        $COD_PAGREC->setSize('19%');
        $COD_ENTIDADE->setSize('8%');
        $QTDE_4RODAS->setSize('11%');
        $QTDE_2RODAS->setSize('11%');
        $DESCONTO_A4R->setSize('10%');
        $DESCONTO_A2R->setSize('11%');
        $DATA_VENCIMENTO->setSize(140);
        $COD_CFCFILIAL->setSize('70%');
        $TIPO_LANCAMENTO->setSize('14%');
        $COD_ENTIDADE_FROTA->setSize(70);
        $COD_SUBENTIDADE->setSize('30%');
        $COD_ENTIDADE_ALUNOS->setSize(70);
        $COD_TIPOENTIDADE->setSize('27%');
        $COD_ENTIDADE_CONVENIADOS->setSize(70);
        $COD_ENTIDADE_NOSSAEMPRESA->setSize(70);
        $COD_ENTIDADE_FUNCIONARIOS->setSize(70);
        $COD_ENTIDADE_FROTA_display->setSize(650);
        $COD_ENTIDADE_ALUNOS_display->setSize(650);
        $COD_ENTIDADE_CONVENIADOS_display->setSize(650);
        $COD_ENTIDADE_NOSSAEMPRESA_display->setSize(650);
        $COD_ENTIDADE_FUNCIONARIOS_display->setSize(650);







        $this->form->appendPage('(( DADOS RECIBO ))');
        $row1 = $this->form->addFields([new TLabel('NR.RECIBO:', null, '14px', null)],[$NR_RECIBO,new TLabel('CÓD.ENTIDADE:', '#ff0000', '14px', null),$COD_ENTIDADE,new TLabel('NOME:', '#ff0000', '14px', null),$NOME]);
        $row2 = $this->form->addContent([new TFormSeparator('(( DADOS RECIBO ))', '#24b4d0', '18', '#24b4d0')]);
        $row3 = $this->form->addFields([new TLabel('CÓD.SUBENTIDADE/FORMA PGTO:', '#ff0000', '14px', null)],[$COD_SUBENTIDADE,new TLabel('TIPO ENTIDADE:', '#ff0000', '14px', null),$COD_TIPOENTIDADE]);
        $row4 = $this->form->addFields([new TLabel('CÓD.NOSSA EMPRESA:', '#ff0000', '14px', null)],[$COD_ENTIDADE_NOSSAEMPRESA]);
        $row5 = $this->form->addFields([new TLabel('CÓD.FUNCIONÁRIO:', '#ff0000', '14px', null)],[$COD_ENTIDADE_FUNCIONARIOS]);
        $row6 = $this->form->addFields([new TLabel('CÓD.VEÍCULO:', '#ff0000', '14px', null)],[$COD_ENTIDADE_FROTA]);
        $row7 = $this->form->addFields([new TLabel('CÓD.CONVENIADO/ASSOCIADO:', '#ff0000', '14px', null)],[$COD_ENTIDADE_CONVENIADOS]);
        $row8 = $this->form->addFields([new TLabel('CÓD.ALUNO:', '#ff0000', '14px', null)],[$COD_ENTIDADE_ALUNOS]);
        $row9 = $this->form->addFields([new TLabel('TIPO LANÇAMENTO (C/D):', '#ff0000', '14px', null)],[$TIPO_LANCAMENTO,new TLabel('VALOR:', '#ff0000', '14px', null),$VALOR,new TLabel('DATA:', '#ff0000', '14px', null),$DTA]);
        $row10 = $this->form->addFields([new TLabel('PROVENIENTE DE:', '#ff0000', '14px', null)],[$HISTORICO1]);
        $row11 = $this->form->addFields([new TLabel('NOME ALUNO/CPF OU OBS1:', '#128b69', '14px', null)],[$HISTORICO2]);
        $row12 = $this->form->addFields([new TLabel('OBS2:', '#128b69', '14px', null)],[$HISTORICO3]);
        $row13 = $this->form->addFields([new TLabel('CÓD.CFCFILIAL:', '#ff0000', '14px', null)],[$COD_CFCFILIAL]);

        $this->form->appendPage('(( VENDA AULAS AVULSAS ))');
        $row14 = $this->form->addContent([new TFormSeparator('(( VENDA AULAS AVULSAS ))', '#24b4d0', '18', '#24b4d0')]);
        $row15 = $this->form->addFields([new TLabel('QTDE AULA 2RODAS:', '#bed14b', '14px', null)],[$QTDE_2RODAS,new TLabel('DESCONTO AULA 2 RODAS:', '#bed14b', '14px', null),$DESCONTO_A2R]);
        $row16 = $this->form->addFields([new TLabel('QTDE AULA 4 RODAS:', '#ebd12f', '14px', null)],[$QTDE_4RODAS,new TLabel('DESCONTO AULA 4 RODAS:', '#ebd12f', '14px', null),$DESCONTO_A4R]);

        $this->form->appendPage('(( CONTAS A RECEBER/BOLETOS ))');
        $row17 = $this->form->addFields([new TLabel('Rótulo:', null, '14px', null)],[]);
        $row18 = $this->form->addContent([new TFormSeparator('(( CONTAS A RECEBER/BOLETOS)', '#24b4d0', '18', '#24b4d0')]);
        $row19 = $this->form->addFields([new TLabel('DATA VENCIMENTO:', null, '14px', null)],[$DATA_VENCIMENTO,new TLabel('CÓD.ARECEBER/BOLETOS', null, '14px', null),$COD_PAGREC]);

        $DTA->setValue(date("Y-m-d"));

        $this->onCarregarUnidades($param);
        //$this->form = (new TAction(array($this,'onCarregarUnidades')));

        //$object->unit = TSession::getValue('userunitid');         
        //$this->form->setData($object); // preenche o form

        self::onChangeCodEntidade( ['COD_TIPOENTIDADE' => '1'] );

        // create the form actions
        $btn_onsave = $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onedit = $this->form->addAction('Novo', new TAction(['Cfcweb25Form', 'onEdit']), 'fa:plus #000000');
        $btn_onedit->addStyleClass('btn-success'); 

        $btn_onshow = $this->form->addAction('Pesquisar', new TAction(['Cfcweb25List', 'onShow']), 'fa:search #000000');
        $btn_onshow->addStyleClass('btn-info'); 

        $btn_onclear = $this->form->addAction('Deletar', new TAction([$this, 'onClear']), 'fa:eraser #edeae9');
        $btn_onclear->addStyleClass('btn-danger'); 

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(TBreadCrumb::create(['Operações Diárias','Recibos Emitidos']));
        $container->add($this->form);

        parent::add($container);

    }

    public static function onChangeCodEntidade($param = null) 
    {
        try 
        {
          //code here
          if ($param['COD_TIPOENTIDADE'] == '1')
          {
             BootstrapFormBuilder::showField((self::$formName), 'COD_ENTIDADE_NOSSAEMPRESA');
             BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_FUNCIONARIOS');
             BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_FROTA');
             BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_CONVENIADOS');
             BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_ALUNOS');
          }
          else {
               if ($param['COD_TIPOENTIDADE'] == '2')
               {
                  BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_NOSSAEMPRESA');
                  BootstrapFormBuilder::showField((self::$formName), 'COD_ENTIDADE_FUNCIONARIOS');
                  BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_FROTA');
                  BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_CONVENIADOS');
                  BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_ALUNOS');
               }
               else {
                    if ($param['COD_TIPOENTIDADE'] == '3')
                    {
                       BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_NOSSAEMPRESA');
                       BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_FUNCIONARIOS');
                       BootstrapFormBuilder::showField((self::$formName), 'COD_ENTIDADE_FROTA');
                       BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_CONVENIADOS');
                       BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_ALUNOS');
                    }
                    else {
                         if ($param['COD_TIPOENTIDADE'] == '4')
                         {
                            BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_NOSSAEMPRESA');
                            BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_FUNCIONARIOS');
                            BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_FROTA');
                            BootstrapFormBuilder::showField((self::$formName), 'COD_ENTIDADE_CONVENIADOS');
                            BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_ALUNOS');
                         }
                         else {
                              //--- Foi Colocado os ifs e elses para que, quando cadastrar em tipo de entidade superior a 4, então a tabela sempre pra ser aluno 
                              //if ($param['COD_TIPOENTIDADE'] == '5')
                              //{
                              BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_NOSSAEMPRESA');
                              BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_FUNCIONARIOS');
                              BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_FROTA');
                              BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_CONVENIADOS');
                              BootstrapFormBuilder::showField((self::$formName), 'COD_ENTIDADE_ALUNOS');
                              //}
                         }
                    }
               }
          }

            //</autoCode>
        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
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

            //$form_Cfcweb25 = TSession::getValue('form_Cfcweb25');

            //if ($items) 
            //{
            //--- Verifica tipo entidade para guardar cod_entidade da tabela referente.
            if ($object->COD_TIPOENTIDADE == '1')
            {
                $Cfcweb01 = new Cfcweb01($data->COD_ENTIDADE_NOSSAEMPRESA);
                if ($Cfcweb01)
                {
                   $object->COD_ENTIDADE = $Cfcweb01->CODIGO;
                   $object->NOME         = $Cfcweb01->FANTASIA;
                }
            }
            else {
                 if ($object->COD_TIPOENTIDADE == '2')
                 {
                    $Cfcweb05 = new Cfcweb05($data->COD_ENTIDADE_FUNCIONARIOS);
                    if ($Cfcweb05)
                    {
                       $object->COD_ENTIDADE = $Cfcweb05->CODIGO;
                       $object->NOME         = $Cfcweb05->NOME;
                    }
                 }           
                 else {
                      if ($object->COD_TIPOENTIDADE == '3')
                      {
                         $Cfcweb06 = new Cfcweb06($data->COD_ENTIDADE_FROTA);
                         if ($Cfcweb06)
                         {
                            $object->COD_ENTIDADE = $Cfcweb06->CODIGO;
                            $object->NOME         = $Cfcweb06->DESCRICAO;
                         }
                      }
                      else {
                           if ($object->COD_TIPOENTIDADE == '4')
                           {
                              $Cfcweb07 = new Cfcweb07($data->COD_ENTIDADE_CONVENIADOS);
                              if ($Cfcweb07)
                              {
                                 $object->COD_ENTIDADE = $Cfcweb07->CODIGO;
                                 $object->NOME         = $Cfcweb07->FANTASIA;
                              }
                           }                     
                           else {
                                $Cfcweb20 = new Cfcweb20($data->COD_ENTIDADE_ALUNOS);
                                if ($Cfcweb20)
                                {
                                   $object->COD_ENTIDADE = $Cfcweb20->CODIGO;
                                   $object->NOME         = $Cfcweb20->NOME;
                                }
                           }                          
                      }

                 }
            }
            //---
            //}

            $object->store(); // save the object 

            // get the generated {PRIMARY_KEY}
            $data->NR_RECIBO = $object->NR_RECIBO; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            /**
            // To define an action to be executed on the message close event:
            $messageAction = new TAction(['className', 'methodName']);
            **/

            new TMessage('info', AdiantiCoreTranslator::translate('Registro Salvo com Sucesso!'), $messageAction);

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

    public static function onCarregarUnidades($param = null) 
    {
        try 
        {
            //code here
            TTransaction::open('permission');

            //$data = $this->form->getData();

            echo 'passou onCarregarUnidades'; 
            $UNIDADE = (TSession::getValue('userunitid')); 

            //TTransaction::close();

            TTransaction::open(self::$database);

            $Cfcweb02 = new Cfcweb02($UNIDADE);
            if ($Cfcweb02)
            {
               $object->COD_CFCFILIAL = $Cfcweb02->CODIGO;
               //$object->NOME         = $Cfcweb01->FANTASIA;
            }

            //$filter = new TFilter('system_group_id','=',$data->grupo_id);
            //$critaria = new TCriteria();
            //$critaria->add($filter);

            //$programs = SystemGroupProgram::getObjects($critaria);

            //$ids = [];

            //foreach($programs as $p)
            //{
            //  $ids[] = $p->system_program_id;
            //}

            //$criterio2 = new TCriteria();
            //$filter2 = new TFilter('id','IN',$ids);
            //$criterio2->add($filter2);

            //TSession::setValue('data', $data);
            //TSession::setValue('programs_group4',$criterio2);

            //$this->form->setData($data);
            //AdiantiCoreApplication::loadPage('DropsForm');

            TTransaction::close();
        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

}

