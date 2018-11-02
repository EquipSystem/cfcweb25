<?php

class Cfcweb26Report extends TPage
{
    private $form; // form
    private $loaded;
    private static $database = 'cfcwebsystem';
    private static $activeRecord = 'Cfcweb26';
    private static $primaryKey = 'id';
    private static $formName = 'formReport_Cfcweb26';

    //-----------------------------------------------------
    private static $paginas = 1;
    //-----------------------------------------------------

    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);

        // define the form title
        $this->form->setFormTitle('Financeiro Caixa');

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

        $id = new TEntry('id');
        $DTA_INI = new TDate('DTA_INI');
        $DTA_FIM = new TDate('DTA_FIM');
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
        $COD_ENTIDADE = new TEntry('COD_ENTIDADE');
        $NOME = new TEntry('NOME');
        $COD_SUBENTIDADE = new TDBCombo('COD_SUBENTIDADE', 'cfcwebsystem', 'Cfcweb15', 'CODIGO', '{DESCRICAO}','CODIGO asc'  );
        $COD_CFCFILIAL = new TDBCombo('COD_CFCFILIAL', 'cfcwebsystem', 'Cfcweb02', 'CODIGO', '{FANTASIA}','FANTASIA asc'  );
        $USUARIO = new TEntry('USUARIO');

        $COD_TIPOENTIDADE->setChangeAction(new TAction([$this,'onChangeCodEntidade']));

        $DTA_INI->setMask('dd/mm/yyyy');
        $DTA_FIM->setMask('dd/mm/yyyy');

        $DTA_INI->setDatabaseMask('yyyy-mm-dd');
        $DTA_FIM->setDatabaseMask('yyyy-mm-dd');

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

        $COD_ENTIDADE_FROTA_display->setEditable(false);
        $COD_ENTIDADE_ALUNOS_display->setEditable(false);
        $COD_ENTIDADE_CONVENIADOS_display->setEditable(false);
        $COD_ENTIDADE_NOSSAEMPRESA_display->setEditable(false);
        $COD_ENTIDADE_FUNCIONARIOS_display->setEditable(false);

        $id->setSize(80);
        $NOME->setSize('49%');
        $DTA_INI->setSize(150);
        $DTA_FIM->setSize(150);
        $USUARIO->setSize('15%');
        $COD_ENTIDADE->setSize('10%');
        $COD_CFCFILIAL->setSize('49%');
        $COD_ENTIDADE_FROTA->setSize(70);
        $COD_SUBENTIDADE->setSize('70%');
        $COD_ENTIDADE_ALUNOS->setSize(70);
        $COD_TIPOENTIDADE->setSize('62%');
        $COD_ENTIDADE_CONVENIADOS->setSize(70);
        $COD_ENTIDADE_FUNCIONARIOS->setSize(70);
        $COD_ENTIDADE_NOSSAEMPRESA->setSize(70);
        $COD_ENTIDADE_FROTA_display->setSize(650);
        $COD_ENTIDADE_ALUNOS_display->setSize(650);
        $COD_ENTIDADE_CONVENIADOS_display->setSize(650);
        $COD_ENTIDADE_NOSSAEMPRESA_display->setSize(650);
        $COD_ENTIDADE_FUNCIONARIOS_display->setSize(650);





        $row1 = $this->form->addFields([new TLabel('ID.:', null, '14px', null)],[$id,new TLabel('DATA INICIAL:', null, '14px', null),$DTA_INI,new TLabel('DATA FINAL:', null, '14px', null),$DTA_FIM]);
        $row2 = $this->form->addFields([new TLabel('TIPO ENTIDADE:', null, '14px', null)],[$COD_TIPOENTIDADE]);
        $row3 = $this->form->addFields([new TLabel('CÓD.NOSSA EMPRESA:', null, '14px', null)],[$COD_ENTIDADE_NOSSAEMPRESA]);
        $row4 = $this->form->addFields([new TLabel('CÒD.FUNCIONÁRIO:', null, '14px', null)],[$COD_ENTIDADE_FUNCIONARIOS]);
        $row5 = $this->form->addFields([new TLabel('CÓD.VEÍCULO:', null, '14px', null)],[$COD_ENTIDADE_FROTA]);
        $row6 = $this->form->addFields([new TLabel('CÓD.CONVENIADO/ASSOCIADO:', null, '14px', null)],[$COD_ENTIDADE_CONVENIADOS]);
        $row7 = $this->form->addFields([new TLabel('CÓD.ALUNO:', null, '14px', null)],[$COD_ENTIDADE_ALUNOS]);
        $row8 = $this->form->addFields([new TLabel('CÓD.ENTIDADE:', null, '14px', null)],[$COD_ENTIDADE,new TLabel('NOME ENTIDADE:', null, '14px', null),$NOME]);
        $row9 = $this->form->addFields([new TLabel('CÓD.SUBENTIDADE:', null, '14px', null)],[$COD_SUBENTIDADE]);
        $row10 = $this->form->addFields([new TLabel('CÓD.CFCFILIAL:', null, '14px', null)],[$COD_CFCFILIAL,new TLabel('USUÁRIO:', null, '14px', null),$USUARIO]);

        self::onChangeCodEntidade( ['COD_TIPOENTIDADE' => '1'] );

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $btn_ongeneratehtml = $this->form->addAction('Gerar HTML', new TAction([$this, 'onGenerateHtml']), 'fa:code #ffffff');
        $btn_ongeneratehtml->addStyleClass('btn-primary'); 

        $btn_ongeneratepdf = $this->form->addAction('Gerar PDF', new TAction([$this, 'onGeneratePdf']), 'fa:file-pdf-o #d44734');

        $btn_ongeneratexls = $this->form->addAction('Gerar XLS', new TAction([$this, 'onGenerateXls']), 'fa:file-excel-o #00a65a');

        $btn_ongeneratertf = $this->form->addAction('Gerar RTF', new TAction([$this, 'onGenerateRtf']), 'fa:file-text-o #324bcc');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(TBreadCrumb::create(['Operações Diárias','Relatório Financeiro Caixa']));
        $container->add($this->form);

        parent::add($container);

    }

    //-----------------------------------------------------
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
          } else
            {
               if ($param['COD_TIPOENTIDADE'] == '2')
               {
                  BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_NOSSAEMPRESA');
                  BootstrapFormBuilder::showField((self::$formName), 'COD_ENTIDADE_FUNCIONARIOS');
                  BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_FROTA');
                  BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_CONVENIADOS');
                  BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_ALUNOS');
               } else
                 {
                    if ($param['COD_TIPOENTIDADE'] == '3')
                    {
                       BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_NOSSAEMPRESA');
                       BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_FUNCIONARIOS');
                       BootstrapFormBuilder::showField((self::$formName), 'COD_ENTIDADE_FROTA');
                       BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_CONVENIADOS');
                       BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_ALUNOS');
                    } else 
                      {
                         if ($param['COD_TIPOENTIDADE'] == '4')
                         {
                            BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_NOSSAEMPRESA');
                            BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_FUNCIONARIOS');
                            BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_FROTA');
                            BootstrapFormBuilder::showField((self::$formName), 'COD_ENTIDADE_CONVENIADOS');
                            BootstrapFormBuilder::hideField((self::$formName), 'COD_ENTIDADE_ALUNOS');
                         } else
                           {
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
        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }
    //-----------------------------------------------------

    public function onGenerateHtml($param = null) 
    {
        $this->onGenerate('html');
    }//</end>
    public function onGeneratePdf($param = null) 
    {
        $this->onGenerate('pdf');
    }//</end>
    public function onGenerateXls($param = null) 
    {
        $this->onGenerate('xls');
    }//</end>
    public function onGenerateRtf($param = null) 
    {
        $this->onGenerate('rtf');
    }//</end>

    /**
     * Register the filter in the session
     */
    public function getFilters()
    {
        // get the search form data
        $data = $this->form->getData();

        $filters = [];

        TSession::setValue(__CLASS__.'_filter_data', NULL);
        TSession::setValue(__CLASS__.'_filters', NULL);

        if (isset($data->id) AND ( (is_scalar($data->id) AND $data->id !== '') OR (is_array($data->id) AND (!empty($data->id)) )) )
        {

            $filters[] = new TFilter('id', '=', $data->id);// create the filter 
        }
        if (isset($data->DTA_INI) AND ( (is_scalar($data->DTA_INI) AND $data->DTA_INI !== '') OR (is_array($data->DTA_INI) AND (!empty($data->DTA_INI)) )) )
        {

            $filters[] = new TFilter('DTA', '>=', $data->DTA_INI);// create the filter 
        }
        if (isset($data->DTA_FIM) AND ( (is_scalar($data->DTA_FIM) AND $data->DTA_FIM !== '') OR (is_array($data->DTA_FIM) AND (!empty($data->DTA_FIM)) )) )
        {

            $filters[] = new TFilter('DTA', '<=', $data->DTA_FIM);// create the filter 
        }
        if (isset($data->COD_TIPOENTIDADE) AND ( (is_scalar($data->COD_TIPOENTIDADE) AND $data->COD_TIPOENTIDADE !== '') OR (is_array($data->COD_TIPOENTIDADE) AND (!empty($data->COD_TIPOENTIDADE)) )) )
        {

            $filters[] = new TFilter('COD_TIPOENTIDADE', '=', $data->COD_TIPOENTIDADE);// create the filter 
        }
        if (isset($data->COD_ENTIDADE_NOSSAEMPRESA) AND ( (is_scalar($data->COD_ENTIDADE_NOSSAEMPRESA) AND $data->COD_ENTIDADE_NOSSAEMPRESA !== '') OR (is_array($data->COD_ENTIDADE_NOSSAEMPRESA) AND (!empty($data->COD_ENTIDADE_NOSSAEMPRESA)) )) )
        {

            $filters[] = new TFilter('COD_ENTIDADE', '=', $data->COD_ENTIDADE_NOSSAEMPRESA);// create the filter 
        }
        if (isset($data->COD_ENTIDADE_FUNCIONARIOS) AND ( (is_scalar($data->COD_ENTIDADE_FUNCIONARIOS) AND $data->COD_ENTIDADE_FUNCIONARIOS !== '') OR (is_array($data->COD_ENTIDADE_FUNCIONARIOS) AND (!empty($data->COD_ENTIDADE_FUNCIONARIOS)) )) )
        {

            $filters[] = new TFilter('COD_ENTIDADE', '=', $data->COD_ENTIDADE_FUNCIONARIOS);// create the filter 
        }
        if (isset($data->COD_ENTIDADE_FROTA) AND ( (is_scalar($data->COD_ENTIDADE_FROTA) AND $data->COD_ENTIDADE_FROTA !== '') OR (is_array($data->COD_ENTIDADE_FROTA) AND (!empty($data->COD_ENTIDADE_FROTA)) )) )
        {

            $filters[] = new TFilter('COD_ENTIDADE', '=', $data->COD_ENTIDADE_FROTA);// create the filter 
        }
        if (isset($data->COD_ENTIDADE_CONVENIADOS) AND ( (is_scalar($data->COD_ENTIDADE_CONVENIADOS) AND $data->COD_ENTIDADE_CONVENIADOS !== '') OR (is_array($data->COD_ENTIDADE_CONVENIADOS) AND (!empty($data->COD_ENTIDADE_CONVENIADOS)) )) )
        {

            $filters[] = new TFilter('COD_ENTIDADE', '=', $data->COD_ENTIDADE_CONVENIADOS);// create the filter 
        }
        if (isset($data->COD_ENTIDADE_ALUNOS) AND ( (is_scalar($data->COD_ENTIDADE_ALUNOS) AND $data->COD_ENTIDADE_ALUNOS !== '') OR (is_array($data->COD_ENTIDADE_ALUNOS) AND (!empty($data->COD_ENTIDADE_ALUNOS)) )) )
        {

            $filters[] = new TFilter('COD_ENTIDADE', '=', $data->COD_ENTIDADE_ALUNOS);// create the filter 
        }
        if (isset($data->COD_ENTIDADE) AND ( (is_scalar($data->COD_ENTIDADE) AND $data->COD_ENTIDADE !== '') OR (is_array($data->COD_ENTIDADE) AND (!empty($data->COD_ENTIDADE)) )) )
        {

            $filters[] = new TFilter('COD_ENTIDADE', '=', $data->COD_ENTIDADE);// create the filter 
        }
        if (isset($data->NOME) AND ( (is_scalar($data->NOME) AND $data->NOME !== '') OR (is_array($data->NOME) AND (!empty($data->NOME)) )) )
        {

            $filters[] = new TFilter('NOME', '=', $data->NOME);// create the filter 
        }
        if (isset($data->COD_SUBENTIDADE) AND ( (is_scalar($data->COD_SUBENTIDADE) AND $data->COD_SUBENTIDADE !== '') OR (is_array($data->COD_SUBENTIDADE) AND (!empty($data->COD_SUBENTIDADE)) )) )
        {

            $filters[] = new TFilter('COD_SUBENTIDADE', '=', $data->COD_SUBENTIDADE);// create the filter 
        }
        if (isset($data->COD_CFCFILIAL) AND ( (is_scalar($data->COD_CFCFILIAL) AND $data->COD_CFCFILIAL !== '') OR (is_array($data->COD_CFCFILIAL) AND (!empty($data->COD_CFCFILIAL)) )) )
        {

            $filters[] = new TFilter('COD_CFCFILIAL', '=', $data->COD_CFCFILIAL);// create the filter 
        }
        if (isset($data->USUARIO) AND ( (is_scalar($data->USUARIO) AND $data->USUARIO !== '') OR (is_array($data->USUARIO) AND (!empty($data->USUARIO)) )) )
        {

            $filters[] = new TFilter('USUARIO', '=', $data->USUARIO);// create the filter 
        }

        // fill the form with data again
        $this->form->setData($data);

        // keep the search data in the session
        TSession::setValue(__CLASS__.'_filter_data', $data);

        return $filters;
    }

    public function onGenerate($format)
    {
        try
        {
            $filters = $this->getFilters();
            // open a transaction with database 'cfcwebsystem'
            TTransaction::open(self::$database);
            $param = [];
            // creates a repository for Cfcweb26
            $repository = new TRepository(self::$activeRecord);
            // creates a criteria
            $criteria = new TCriteria;

            $param['order'] = 'COD_TIPOENTIDADE,COD_SUBENTIDADE';
            $param['direction'] = 'asc';

            $criteria->setProperties($param);

            if ($filters)
            {
                foreach ($filters as $filter) 
                {
                    $criteria->add($filter);       
                }
            }

            // load the objects according to criteria
            $objects = $repository->load($criteria, FALSE);

            if ($objects)
            {
                $widths = array(200,200,200,200,200,200,200,200,200,200,200,200);

                switch ($format)
                {
                    case 'html':
                        $tr = new TTableWriterHTML($widths);
                        break;
                    case 'xls':
                        $tr = new TTableWriterXLS($widths);
                        break;
                    case 'pdf':
                        $tr = new TTableWriterPDF($widths, 'L');
                        break;
                    case 'rtf':
                        if (!class_exists('PHPRtfLite_Autoloader'))
                        {
                            PHPRtfLite::registerAutoloader();
                        }
                        $tr = new TTableWriterRTF($widths, 'L');
                        break;
                }

                if (!empty($tr))
                {
                    // create the document styles
                    $tr->addStyle('title', 'Helvetica', '10', 'B',   '#000000', '#dbdbdb');
                    $tr->addStyle('datap', 'Arial', '10', '',    '#333333', '#f0f0f0');
                    $tr->addStyle('datai', 'Arial', '10', '',    '#333333', '#ffffff');
                    $tr->addStyle('header', 'Helvetica', '16', 'B',   '#5a5a5a', '#6B6B6B');
                    $tr->addStyle('footer', 'Helvetica', '10', 'B',  '#5a5a5a', '#A3A3A3');
                    $tr->addStyle('break', 'Helvetica', '10', 'B',  '#ffffff', '#9a9a9a');
                    $tr->addStyle('total', 'Helvetica', '10', 'I',  '#000000', '#c7c7c7');
                    $tr->addStyle('breakTotal', 'Helvetica', '10', 'I',  '#000000', '#c6c8d0');

                    //-----------------------------------------------------
                    //$tr->addRow();
                    //$tr->addCell('Relatório Financeiros Caixa', 'center', 'header', 13);

                    if($format == 'pdf')
                    {
                      //$tr = new TTableWriterPDF($widths);
                      //$fpdf = $tr->getNativeWriter();
                      //$tr->setHeaderCallback(array($this, 'header'));
                      //$tr->setFooterCallback(array($this, 'footer'));

                      $fpdf = $tr->getNativeWriter();
                      $fpdf->AliasNbPages();
                      $fpdf->setHeaderCallback(array($this,'header'));
                      $fpdf->setFooterCallback(array($this,'footer'));

                      $this->header($fpdf);
                    }
                    //-----------------------------------------------------

                    // add titles row
                    $tr->addRow();
                    $tr->addCell('ID', 'left', 'title');
                    $tr->addCell('CÓD.ENTIDADE', 'left', 'title');
                    $tr->addCell('NOME ENTIDADE', 'left', 'title');
                    $tr->addCell('DATA', 'left', 'title');
                    $tr->addCell('C/D', 'left', 'title');
                    $tr->addCell('HISTÓRICO', 'left', 'title');
                    $tr->addCell('USUÁRIO', 'left', 'title');
                    $tr->addCell('COD SUBENTIDADE', 'left', 'title');
                    $tr->addCell('CÓD.CFCFILIAL', 'left', 'title');
                    $tr->addCell('CRÉDITO', 'left', 'title');
                    $tr->addCell('DÉBITO', 'left', 'title');
                    $tr->addCell('SALDO', 'left', 'title');

                    $grandTotal = [];
                    $breakTotal = [];
                    $breakValue = null;
                    $firstRow = true;

                    //--- Zera variaveis para iniciar calculo de relatório.
                    //-----------------------------------------------------
                    $valor    = 0;
                    $credito  = 0;
                    $debito   = 0;
                    $saldo    = 0;
                    $subtotal = 0; 
                    $total    = 0; 
                    //-----------------------------------------------------



                    //-----------------------------------------------------
                    //--- Calcula quebra e imprime body.
                    //-----------------------------------------------------
                    // controls the background filling
                    $colour = false;                
                    foreach ($objects as $object)
                    {
                        $style = $colour ? 'datap' : 'datai';

                        //$column_calculated_1 = $object->evaluate('=( {VALOR}  )');
                        //$column_calculated_2 = $object->evaluate('=( {VALOR}  )');
                        //$column_calculated_3 = $object->evaluate('=( {VALOR}  )');

                        //--- Verifca TIPO_LANCAMENTO para posicionar coluna credito e debito.
                        //-----------------------------------------------------
                        $valor = $object->VALOR;
                         
                        if ($object->TIPO_LANCAMENTO == 'C') 
                        {
                            $credito = $valor;
                            $debito  = 0;
                        }

                        if ($object->TIPO_LANCAMENTO == 'D') 
                        {
                            $credito = 0;
                            $debito  = $valor;
                        }

                        //--- Re-Calcular saldo de credito e debito do registro corrente.
                        //-----------------------------------------------------
                        $saldo               = ($saldo + $credito - $debito);
                        $subtotal            = ($subtotal + $credito - $debito);
                        $column_calculated_1 = $credito;
                        $column_calculated_2 = $debito; 
                        $column_calculated_3 = $saldo;
                        //-----------------------------------------------------



                        if ($object->COD_TIPOENTIDADE !== $breakValue)
                        {
                            if (!$firstRow)
                            {
                                //-----------------------------------------------------
                                //--- Calcula e imprime saldo.
                                //-----------------------------------------------------
                                $tr->addRow();
                
                                //--- Re-inicia Calculo em quebra de tipoentidade, credito, debito saldo.
                                //-----------------------------------------------------
                                $saldo    = 0;
                                $subtotal = 0;
                                $saldo               = ($saldo + $credito - $debito);
                                $subtotal            = ($subtotal + $credito - $debito);
                                $column_calculated_1 = $credito;
                                $column_calculated_2 = $debito; 
                                $column_calculated_3 = $saldo;


                                $breakTotal_id = count($breakTotal['id']);
                                $breakTotal_column_calculated_1 = array_sum($breakTotal['column_calculated_1']);
                                $breakTotal_column_calculated_2 = array_sum($breakTotal['column_calculated_2']);
                                $breakTotal_column_calculated_3 = array_sum($breakTotal['column_calculated_3']);
                                   
                                //---
                                //-----------------------------------------------------
                                $credito = $breakTotal_column_calculated_1;
                                $debito  = $breakTotal_column_calculated_2;
                                $total   = ($credito - $debito);
                                $breakTotal_column_calculated_3 = $total; //($credito - $debito);
                                //echo 'credito: ' . $credito . "<br>";
                                //echo 'debito : ' . $debito  . "<br>";
                                //echo 'total  : ' . $total   . "<br>";
                                //-----------------------------------------------------
                                //---

                                $breakTotal_column_calculated_1 = call_user_func(function($value)
                                {
                                    if(!$value)
                                    {
                                        $value = 0;
                                    }

                                    if(is_numeric($value))
                                    {
                                        return "R$ " . number_format($value, 2, ",", ".");
                                    }
                                    else
                                    {
                                        return $value;
                                    }
                                }, $breakTotal_column_calculated_1); 

                                $breakTotal_column_calculated_2 = call_user_func(function($value)
                                {
                                    if(!$value)
                                    {
                                        $value = 0;
                                    }

                                    if(is_numeric($value))
                                    {
                                        return "R$ " . number_format($value, 2, ",", ".");
                                    }
                                    else
                                    {
                                        return $value;
                                    }
                                }, $breakTotal_column_calculated_2); 

                                $breakTotal_column_calculated_3 = call_user_func(function($value)
                                {
                                    if(!$value)
                                    {
                                        $value = 0;
                                    }

                                    if(is_numeric($value))
                                    {
                                        return "R$ " . number_format($value, 2, ",", ".");
                                    }
                                    else
                                    {
                                        return $value;
                                    }
                                }, $breakTotal_column_calculated_3); 

                                $tr->addCell($breakTotal_id, 'left', 'breakTotal');
                                $tr->addCell('', 'center', 'breakTotal');
                                $tr->addCell('', 'center', 'breakTotal');
                                $tr->addCell('', 'center', 'breakTotal');
                                $tr->addCell('', 'center', 'breakTotal');
                                $tr->addCell('', 'center', 'breakTotal');
                                $tr->addCell('', 'center', 'breakTotal');
                                $tr->addCell('', 'center', 'breakTotal');
                                $tr->addCell('SUBTOTAL=>', 'center', 'breakTotal');

                                $tr->addCell($breakTotal_column_calculated_1, 'left', 'breakTotal');
                                $tr->addCell($breakTotal_column_calculated_2, 'left', 'breakTotal');
                                $tr->addCell($breakTotal_column_calculated_3, 'left', 'breakTotal');
                                //-----------------------------------------------------
                                //--- Calcula e imprime saldo.
                                //-----------------------------------------------------



                            }
                            $tr->addRow();
                            $tr->addCell($object->render('{fk_COD_TIPOENTIDADE->NOME_ENTIDADE}'), 'left', 'break', 12);
                            $breakTotal = [];
                        }

                        $breakValue = $object->COD_TIPOENTIDADE;

                        $grandTotal['id'][] = $object->id;
                        $breakTotal['id'][] = $object->id;
                        $grandTotal['column_calculated_1'][] = $column_calculated_1;
                        $breakTotal['column_calculated_1'][] = $column_calculated_1;
                        $grandTotal['column_calculated_2'][] = $column_calculated_2;
                        $breakTotal['column_calculated_2'][] = $column_calculated_2;
                        $grandTotal['column_calculated_3'][] = $column_calculated_3;
                        $breakTotal['column_calculated_3'][] = $column_calculated_3;
                        //-----------------------------------------------------
                        //--- Calcula e imprime saldo.
                        //-----------------------------------------------------



                        //-----------------------------------------------------
                        //--- Calcula e imprime saldo.
                        //-----------------------------------------------------
                        $firstRow = false;

                        $column_calculated_1 = call_user_func(function($value, $object, $row) 
                        {
                            if(!$value)
                            {
                                $value = 0;
                            }

                            if(is_numeric($value))
                            {
                                return "R$ " . number_format($value, 2, ",", ".");
                            }
                            else
                            {
                                return $value;
                            }
                        }, $column_calculated_1, $object, null);

                        $column_calculated_2 = call_user_func(function($value, $object, $row) 
                        {
                            if(!$value)
                            {
                                $value = 0;
                            }

                            if(is_numeric($value))
                            {
                                return "R$ " . number_format($value, 2, ",", ".");
                            }
                            else
                            {
                                return $value;
                            }
                        }, $column_calculated_2, $object, null);

                        $column_calculated_3 = call_user_func(function($value, $object, $row) 
                        {
                            if(!$value)
                            {
                                $value = 0;
                            }

                            if(is_numeric($value))
                            {
                                return "R$ " . number_format($value, 2, ",", ".");
                            }
                            else
                            {
                                return $value;
                            }
                        }, $column_calculated_3, $object, null);

                        $tr->addRow();

                        $tr->addCell($object->id, 'left', $style);
                        $tr->addCell($object->COD_ENTIDADE, 'left', $style);
                        $tr->addCell($object->NOME, 'left', $style);
                        $tr->addCell($object->DTA, 'left', $style);
                        $tr->addCell($object->TIPO_LANCAMENTO, 'left', $style);
                        $tr->addCell($object->HISTORICO, 'left', $style);
                        $tr->addCell($object->USUARIO, 'left', $style);
                        $tr->addCell($object->fk_COD_SUBENTIDADE->DESCRICAO, 'left', $style);
                        $tr->addCell($object->fk_COD_CFCFILIAL->FANTASIA, 'left', $style);

                        $tr->addCell($column_calculated_1, 'left', $style);
                        $tr->addCell($column_calculated_2, 'left', $style);
                        $tr->addCell($column_calculated_3, 'left', $style);

                        $colour = !$colour;
                        //-----------------------------------------------------
                        //--- Fim Calcula e imprime saldo.
                        //-----------------------------------------------------
                        


                    }
                    //-----------------------------------------------------
                    //--- Fim Calcula quebra e imprime body.
                    //-----------------------------------------------------




                    //-----------------------------------------------------
                    //--- Calcula e imprime subtotal.
                    //-----------------------------------------------------
                    $tr->addRow();

                    $breakTotal_id = count($breakTotal['id']);
                    $breakTotal_column_calculated_1 = array_sum($breakTotal['column_calculated_1']);
                    $breakTotal_column_calculated_2 = array_sum($breakTotal['column_calculated_2']);
                    $breakTotal_column_calculated_3 = array_sum($breakTotal['column_calculated_3']);
                   
                    //--- Re-Calcular ultimo subtotal do relatório.
                    //-----------------------------------------------------
                    $credito = $breakTotal_column_calculated_1;
                    $debito  = $breakTotal_column_calculated_2;
                    $total   = ($credito - $debito);
                    $breakTotal_column_calculated_3 = $total; //($credito - $debito);
                    //echo 'credito: ' . $credito . "<br>";
                    //echo 'debito : ' . $debito  . "<br>";
                    //echo 'total  : ' . $total   . "<br>";
                    //-----------------------------------------------------
 
                    $breakTotal_column_calculated_1 = call_user_func(function($value)
                    {
                        if(!$value)
                        {
                            $value = 0;
                        }

                        if(is_numeric($value))
                        {
                            return "R$ " . number_format($value, 2, ",", ".");
                        }
                        else
                        {
                            return $value;
                        }
                    }, $breakTotal_column_calculated_1); 

                    $breakTotal_column_calculated_2 = call_user_func(function($value)
                    {
                        if(!$value)
                        {
                            $value = 0;
                        }

                        if(is_numeric($value))
                        {
                            return "R$ " . number_format($value, 2, ",", ".");
                        }
                        else
                        {
                            return $value;
                        }
                    }, $breakTotal_column_calculated_2); 

                    $breakTotal_column_calculated_3 = call_user_func(function($value)
                    {
                        if(!$value)
                        {
                            $value = 0;
                        }

                        if(is_numeric($value))
                        {
                            return "R$ " . number_format($value, 2, ",", ".");
                        }
                        else
                        {
                            return $value;
                        }
                    }, $breakTotal_column_calculated_3); 

                    $tr->addCell($breakTotal_id, 'left', 'breakTotal');
                    $tr->addCell('', 'center', 'breakTotal');
                    $tr->addCell('', 'center', 'breakTotal');
                    $tr->addCell('', 'center', 'breakTotal');
                    $tr->addCell('', 'center', 'breakTotal');
                    $tr->addCell('', 'center', 'breakTotal');
                    $tr->addCell('', 'center', 'breakTotal');
                    $tr->addCell('', 'center', 'breakTotal');
                    $tr->addCell('SUBTOTAL=>', 'center', 'breakTotal');


                    $tr->addCell($breakTotal_column_calculated_1, 'left', 'breakTotal');
                    $tr->addCell($breakTotal_column_calculated_2, 'left', 'breakTotal');
                    $tr->addCell($breakTotal_column_calculated_3, 'left', 'breakTotal');
                    //-----------------------------------------------------
                    //--- Fim Calcula e imprime subtotal.
                    //-----------------------------------------------------




                    //-----------------------------------------------------
                    //--- Calcula e imprime total.
                    //-----------------------------------------------------
                    $tr->addRow();

                    $grandTotal_id = count($grandTotal['id']);
                    $grandTotal_column_calculated_1 = array_sum($grandTotal['column_calculated_1']);
                    $grandTotal_column_calculated_2 = array_sum($grandTotal['column_calculated_2']);
                    $grandTotal_column_calculated_3 = array_sum($grandTotal['column_calculated_3']);

                    //--- Re-Calcular total geral do relatório.
                    //-----------------------------------------------------
                    $credito = $grandTotal_column_calculated_1;
                    $debito  = $grandTotal_column_calculated_2;
                    $total   = ($credito - $debito);
                    $grandTotal_column_calculated_3 = $total; //($credito - $debito);
                    //echo 'credito: ' . $credito . "<br>";
                    //echo 'debito : ' . $debito  . "<br>";
                    //echo 'total  : ' . $total   . "<br>";
                    //-----------------------------------------------------

                    $grandTotal_column_calculated_1 = call_user_func(function($value)
                    {
                        if(!$value)
                        {
                            $value = 0;
                        }

                        if(is_numeric($value))
                        {
                            return "R$ " . number_format($value, 2, ",", ".");
                        }
                        else
                        {
                            return $value;
                        }
                    }, $grandTotal_column_calculated_1); 

                    $grandTotal_column_calculated_2 = call_user_func(function($value)
                    {
                        if(!$value)
                        {
                            $value = 0;
                        }

                        if(is_numeric($value))
                        {
                            return "R$ " . number_format($value, 2, ",", ".");
                        }
                        else
                        {
                            return $value;
                        }
                    }, $grandTotal_column_calculated_2); 

                    $grandTotal_column_calculated_3 = call_user_func(function($value)
                    {
                        if(!$value)
                        {
                            $value = 0;
                        }

                        if(is_numeric($value))
                        {
                            return "R$ " . number_format($value, 2, ",", ".");
                        }
                        else
                        {
                            return $value;
                        }
                    }, $grandTotal_column_calculated_3); 

                    $tr->addCell($grandTotal_id, 'left', 'total');
                    $tr->addCell('', 'center', 'total');
                    $tr->addCell('', 'center', 'total');
                    $tr->addCell('', 'center', 'total');
                    $tr->addCell('', 'center', 'total');
                    $tr->addCell('', 'center', 'total');
                    $tr->addCell('', 'center', 'total');
                    $tr->addCell('', 'center', 'total');
                    $tr->addCell('TOTAL=>', 'center', 'total');

                    $tr->addCell($grandTotal_column_calculated_1, 'left', 'total');
                    $tr->addCell($grandTotal_column_calculated_2, 'left', 'total');
                    $tr->addCell($grandTotal_column_calculated_3, 'left', 'total');
                    //-----------------------------------------------------
                    //--- Fim Calcula e Imprime total.
                    //-----------------------------------------------------



                    //-----------------------------------------------------
                    //--- Imprime rodapé.
                    //-----------------------------------------------------
                    $tr->addRow();
                    $tr->addCell(date('d/m/Y H:i:s'), 'center', 'footer', 13);
                    //-----------------------------------------------------
                    //---

                    $file = 'report_'.uniqid().".{$format}";
                    // stores the file
                    if (!file_exists("app/output/{$file}") || is_writable("app/output/{$file}"))
                    {
                        $tr->save("app/output/{$file}");
                    }
                    else
                    {
                        throw new Exception(_t('Permission denied') . ': ' . "app/output/{$file}");
                    }

                    parent::openFile("app/output/{$file}");

                    // shows the success message
                    new TMessage('info', _t('Report generated. Please, enable popups'));
                }
            }
            else
            {
                new TMessage('error', _t('No records found'));
            }

            // close the transaction
            TTransaction::close();
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }

    public function onShow($param = null)
    {

    }

    //-----------------------------------------------------
    public function header($pdf) 
    { 
      $pdf->SetFont('Arial','B',15); 
      // Move to the right 
      $pdf->Cell(80); 
      // Title 
      $pdf->Cell(30,10, utf8_decode('Relatório Financeiro Caixa') ,0,0,'C'); 
      // Line break 
      $pdf->Ln(20);  
    }
    //-----------------------------------------------------

    //-----------------------------------------------------
    public function footer($pdf) 
    { 
      $numeroPagina = self::$paginas;
      $pdf->SetY(-40);
      $pdf->SetFont('Arial','B',15); 
      // Move to the right 
      $pdf->Cell(110); 
      // Title 
      $pdf->PageNo();
      $pdf->Cell(0,10, utf8_decode("Página: {$numeroPagina} /{nb}") ,0,0,'R');
      // Line break 
      $pdf->Ln(20); 
      self::$paginas++;
    }
    //-----------------------------------------------------

}

