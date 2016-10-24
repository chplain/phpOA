<?php

class model_salary_class extends model_base {

	public $page;
	public $num;
	public $start;
	public $db;
	private $salaryClass;
	public $userSta;
	public $nowy;
	public $nowm;
	public $zero;
	public $globalUtil;
	public $openMon;
	public $floatPer;
	public $emailClass;
	public $userLevel;
	public $userSpe;
	public $speType;
	public $flowName;
	public $flowSta;
	public $flowStepSta;
	public $expflag;
	public $fnStatU;
	public $flaotMon;
	public $yebyear;
	public $salarySql;
	public $salaryCom;
	public $accType;
	public $divDept;
	public $lastpy;//���µ����
	public $lastpm;//���µ��·�

	//*******************************���캯��***********************************
	function __construct() {
		set_time_limit(600);
		if ($_POST) {
			$_POST = mb_iconv($_POST);
		}
		if ($_GET) {
			$_GET = mb_iconv($_GET);
		}
		parent::__construct();
		$this->db = new mysql();
		$this->salaryClass = new model_salary_util();
		$this->login_ck();
		$this->zero = $this->salaryClass->encryptDeal(0);
		$this->globalUtil = new includes_class_global();
		$this->emailClass = new includes_class_sendmailsalary();
		$this->userSta = array(0 => '����ְ', 1 => '������', 2 => '��ת��', 3 => '��ְ');
		$this->userLevel = array(0 => '�ܾ���', 1 => '����', 2 => '�ܼ�', 3 => '����',4=>'�ǹ����');
		$this->userSpe = array(0 => '�༭', 1 => '�ύ', 2 => '���', 3 => '���');
		$this->speType = array(0 => '����', 1 => '�۳�');
		$this->accType = array(0 => '�����˰', 1 => '�������˰');
		$this->flowName = array('spe' => '��������'
				,'nym_3' => '����ȵ�н-��ͨ','nym_11' => '����ȵ�н-��ͨ'
				,'nym_10' => '����ȵ�н-��ͨ','nym_4' => '����ȵ�н-��ͨ'
				,'nym_6' => '����ȵ�н-��ͨ'
				,'nym_5' => '����ȵ�н-�ܼ�','nym_2' => '����ȵ�н-�ܼ�'
				,'nym_1' => '����ȵ�н-����'
				,'nym_0' => '����ȵ�н-�ܲ�','nym_8' => '����ȵ�н-�ܲ�'
				,'nym_9' => '����ȵ�н-�ܲ�','nym_7' => '����ȵ�н-�ܲ�'

				,'nym_xs_3' => '����ȵ�н(֪����)-��ͨ','nym_xs_11' => '����ȵ�н(֪����)-��ͨ'
				,'nym_xs_10' => '����ȵ�н(֪����)-��ͨ','nym_xs_4' => '����ȵ�н(֪����)-��ͨ'
				,'nym_xs_6' => '����ȵ�н(֪����)-��ͨ'
				,'nym_xs_5' => '����ȵ�н(֪����)-�ܼ�','nym_xs_2' => '����ȵ�н(֪����)-�ܼ�'
				,'nym_xs_1' => '����ȵ�н(֪����)-�ܼ�'
				,'nym_xs_0' => '����ȵ�н(֪����)-�ܼ�','nym_xs_8' => '����ȵ�н(֪����)-�ܼ�'
				,'nym_xs_9' => '����ȵ�н(֪����)-�ܼ�','nym_xs_7' => '����ȵ�н(֪����)-�ܼ�'
				,'nym_xs_12' => '����ȵ�н(֪����)-�ܼ�'

				,'pro_3' => '��Ŀ��-��ͨ','pro_11' => '��Ŀ��-��ͨ'
				,'pro_10' => '��Ŀ��-��ͨ','pro_4' => '��Ŀ��-��ͨ'
				,'pro_6' => '��Ŀ��-��ͨ'
				,'pro_5' => '��Ŀ��-�ܼ�','pro_2' => '��Ŀ��-�ܼ�'
				,'pro_1' => '��Ŀ��-����'
				,'pro_0' => '��Ŀ��-�ܲ�','pro_8' => '��Ŀ��-�ܲ�'
				,'pro_9' => '��Ŀ��-�ܲ�','pro_7' => '��Ŀ��-�ܲ�'

				,'pro_xs_3' => '��Ŀ��(֪����)-��ͨ','pro_xs_11' => '��Ŀ��(֪����)-��ͨ'
				,'pro_xs_10' => '��Ŀ��(֪����)-��ͨ','pro_xs_4' => '��Ŀ��(֪����)-��ͨ'
				,'pro_xs_6' => '��Ŀ��(֪����)-��ͨ'
				,'pro_xs_5' => '��Ŀ��(֪����)-�ܼ�','pro_xs_2' => '��Ŀ��(֪����)-�ܼ�'
				,'pro_xs_1' => '��Ŀ��(֪����)-�ܾ���'
				,'pro_xs_0' => '��Ŀ��(֪����)-�ܾ���','pro_xs_8' => '��Ŀ��(֪����)-�ܾ���'
				,'pro_xs_9' => '��Ŀ��(֪����)-�ܾ���','pro_xs_7' => '��Ŀ��(֪����)-�ܾ���'
				,'pro_xs_12' => '��Ŀ��(֪����)-���ܾ���'

				,'sdyhr_3' => '���²���-��ͨ','sdyhr_11' => '���²���-��ͨ'
				,'sdyhr_10' => '���²���-��ͨ','sdyhr_4' => '���²���-��ͨ'
				,'sdyhr_6' => '���²���-��ͨ'
				,'sdyhr_5' => '���²���-�ܼ�','sdyhr_2' => '���²���-�ܼ�'
				,'sdyhr_1' => '���²���-����'
				,'sdyhr_0' => '���²���-�ܲ�','sdyhr_8' => '���²���-�ܲ�'
				,'sdyhr_9' => '���²���-�ܲ�','sdyhr_7' => '���²���-�ܲ�'

				,'sdyhr_xs_3' => '���²���(֪����)-��ͨ','sdyhr_xs_11' => '���²���(֪����)-��ͨ'
				,'sdyhr_xs_10' => '���²���(֪����)-��ͨ','sdyhr_xs_4' => '���²���(֪����)-��ͨ'
				,'sdyhr_xs_6' => '���²���(֪����)-��ͨ'
				,'sdyhr_xs_5' => '���²���(֪����)-�ܼ�','sdyhr_xs_2' => '���²���(֪����)-�ܼ�'
				,'sdyhr_xs_1' => '���²���(֪����)-�ܾ���'
				,'sdyhr_xs_0' => '���²���(֪����)-�ܾ���','sdyhr_xs_8' => '���²���(֪����)-�ܾ���'
				,'sdyhr_xs_9' => '���²���(֪����)-�ܾ���','sdyhr_xs_7' => '���²���(֪����)-�ܾ���'
				,'sdyhr_xs_12' => '���²���(֪����)-���ܾ���'

				,'spe_3' => '��������-��ͨ','spe_11' => '��������-��ͨ'
				,'spe_10' => '��������-��ͨ','spe_4' => '��������-��ͨ'
				,'spe_6' => '��������-��ͨ'
				,'spe_5' => '��������-�ܼ�','spe_2' => '��������-�ܼ�'
				,'spe_1' => '��������-����'
				,'spe_0' => '��������-�ܲ�','spe_8' => '��������-�ܲ�'
				,'spe_9' => '��������-�ܲ�','spe_7' => '��������-�ܲ�'

				,'spe_xs_3' => '��������(֪����)-��ͨ','spe_xs_11' => '��������(֪����)-��ͨ'
				,'spe_xs_10' => '��������(֪����)-��ͨ','spe_xs_4' => '��������(֪����)-��ͨ'
				,'spe_xs_6' => '��������(֪����)-��ͨ'
				,'spe_xs_5' => '��������(֪����)-�ܼ�','spe_xs_2' => '��������(֪����)-�ܼ�'
				,'spe_xs_1' => '��������(֪����)-�ܾ���'
				,'spe_xs_0' => '��������(֪����)-�ܾ���','spe_xs_8' => '��������(֪����)-�ܾ���'
				,'spe_xs_9' => '��������(֪����)-�ܾ���','spe_xs_7' => '��������(֪����)-�ܾ���'
				,'spe_xs_12' => '��������(֪����)-���ܾ���'

				,'pro' => '��Ŀ��','bos'=>'���ʽ���' , 'sdyhr'=>'���²���'
				,'fla'=>'���Ƚ�','ymd'=>'��ȵ�н','prod'=>'��Ŀ����ϸ'
				);
		$this->flowSta=array(0=>'����',1=>'��������',2=>'���',3=>'���');
		$this->flowStepSta=array(''=>'����','yes'=>'ͨ��','no'=>'���');
		$this->expflag=array(0=>'��˾Ա��',1=>'����Ա��');
		$this->page = intval($_GET['page']) ? intval($_GET['page']) : 1;
		$this->start = ($this->page == 1) ? 0 : ($this->page - 1) * pagenum;
		$this->num = intval($_GET['num']) ? intval($_GET['num']) : false;
		$this->openMon = array(1, 4, 7, 10);
		$this->floatPer = array(10 => 0.1, 20 => 0.2, 30 => 0.3);
		$this->fnStatU=array('yanping.li','rlchen','dafa.yu','danian.zhu','admin','yu.long','yunxia.zhu','tianlin.zhang');
		$this->flaotMon=array("1"=>1 ,"2"=>2,"3"=>3
				,"4"=>1 ,"5"=>2,"6"=>3
				,"7"=>1 ,"8"=>2,"9"=>3
				,"10"=>1 ,"11"=>2,"12"=>3
				);
		//���ܼ���Ĺ�����ص������������ڵ�Ϊ���Ÿ��ܻ��߲����ܼ�ʱ,���͵��ܾ�������
		$this->fuZong=array('feng.guo','zequan.xu','hua.yin');
		$this->ZJL='danian.zhu'; //�ܾ���
		$this->yebyear='2015';
		$this->divDept=array(113,114,115);//ר�� 113,114,115,'66','71','40'
		// $this->salarySql=array('dl'=>'dloa','sy'=>'shiyuanoa','br'=>'beiruanoa');
		$this->salaryCom=array('dl'=>'���Ͷ���','sy'=>'��Դ��ͨ','br'=>'���ݱ���','bx'=>'���ݱ�Ѷ');
		$this->model_get_data();
		$this->model_salary_ini();
		//$this->get_decrypt_deal();
		//$this->model_flow_auto_do();//�Զ�����
		//$this->update_salary_yeb();//���ս�����
		//$this->update_salary();
		//$this->model_cesse_chg();//��ʱ˰������
		//$this->model_float_chg();//��ʱ���Ƚ�����
		//        $this->deal_pro();

	}

	//*********************************���ݴ���********************************
	function login_ck(){
		//      if($_SESSION['USER_ID']!="admin"){
		//          echo '���� ϵͳ ���� ';
		//          die();
		//      }
		if($_SESSION['prikey']==""&&!$_POST['prikey']){
			include(WEB_TOR.'model/salary/login_salary.php');
			die();
		}elseif($_SESSION['prikey']==""&&$_POST['prikey']){
			$checkZero=$this->salaryClass->rsaClass->decrypt(
					$this->salaryClass->salaryRsa['SalaryZero']
					,$_POST['prikey']
					,$this->salaryClass->salaryRsa['SalaryModulo']);
			if($checkZero!='0'){
				echo '4';
			}else {
				@session_start();
				$_SESSION['prikey']=$this->salaryClass->configCrypt(trim($_POST['prikey']));
			}
			die();
		}elseif(!empty($_SESSION['prikey'])){
			$checkZero=$this->salaryClass->rsaClass->decrypt(
					$this->salaryClass->salaryRsa['SalaryZero']
					,$this->salaryClass->configCrypt($_SESSION['prikey'], 'decode')
					,$this->salaryClass->salaryRsa['SalaryModulo']);
			if($checkZero!='0'){
				echo 'Session ��ʱ �� ˽Կ���� �� �����µ�¼ �� ';
				die();
			}
		}
	}
	//********************************��ʾ����**********************************

	function model_hr() {

	}
	/**
	 * ��������
	 */
	function model_close_stat(){
		$str = '';
		$sql = " SELECT
			s.id,
			s.pyear,
			s.pmon,
			s.com ,
			i.NameCN
				FROM `salary_config` s
				LEFT JOIN branch_info i on (s.com = i.NamePT )";
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			$str.= '<tr>
				<td>'.$row['NameCN'].'</td>
				<td>'.$row['pyear'].'��'.$row['pmon'].'��'.'</td>
				<td><a href="#" onclick = "ck(\''.$row['id'].'\',\''.$row['NameCN'].'\',\''.$row['pyear'].'\',\''.$row['pmon'].'\')">����</a></td>
				</tr>';
		}
		return $str;
	}

	function model_close_stat_in(){
		$y = $_POST['y'];
		$m = $_POST['m'];
		$key = $_POST['key'];

		$nt = mktime(0, 0, 0, $m+1, 1,  $y);
		$ny = date('Y',$nt);
		$nm = date('n',$nt);

		$sql = " update salary_config set
			pyear = '$ny' , pmon = '$nm'
			where id = '$key' ";
		$query = $this->db->query($sql);

		return  $query;
	}
	/**
	 *
	 * @param <type> $flag true ���� flase ����
	 * @param <type> $sqlflag
	 * @return <type>
	 */
	function model_hr_join_list($flag=true,$sqlflag=''){
		$page = $_GET['page'];
		$limit = $_GET['rows'];
		$sidx = $_GET['sidx'];
		$sord = $_GET['sord'];
		$schOper = $_GET['searchOper'];
		$schStr = $_GET['searchString'];
		$schField = $_GET['searchField'];
		$seadept = $_REQUEST['seadept'];
		$seaname = $_REQUEST['seaname'];
		$sqlSch = '';
		if ($schOper) {
			$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
		}
		if($flag==false){
			$sqlSch.=$sqlflag;
		}
		if($seadept){
			$sqlSch.=" and d.dept_name like '%".$seadept."%' ";
		}
		if($seaname){
			$sqlSch.=" and s.oldname like '%".$seaname."%' ";
		}
		$start = $limit * $page - $limit;


		//         $this->model_salary_ini();
		//���������ְģ��

		//����
		if($flag){
			$sql = "select count(*)
				from salary s
				left join hrms h on (s.userid=h.user_id)
				left join user u1 on (s.userid=u1.user_id)
				left join department d on (u1.dept_id=d.dept_id)
				where
				s.userid=h.user_id
				and ( s.usersta='0' or
						( year(s.probationdt)='".$this->nowy."' and  month(s.probationdt)='".$this->nowm."' )
						or s.freezeflag='1' or
						( year(s.recovercdt)='".$this->nowy."' and  month(s.recovercdt)='".$this->nowm."' )
				    )
				$sqlSch ";
		}else{
			$sql = "select count(*)
				from salary s
				left join hrms h on (s.userid=h.user_id)
				left join user u1 on (s.userid=u1.user_id)
				left join department d on (u1.dept_id=d.dept_id)
				where
				s.userid=h.user_id
				and ( s.usersta='0' or ( year(s.probationdt)='".$this->nowy."' and  month(s.probationdt)='".$this->nowm."' ) )
				$sqlSch ";
		}
		$rs = $this->db->get_one($sql);
		$count = $rs['count(*)'];
		if ($count > 0) {
			$total_pages = ceil($count / $limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages){
			$page = $total_pages;
		}
		$i = 0;
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		if($flag){
			$sql="select
				s.rand_key , s.username , s.userid , s.olddept , h.userlevel
				, s.comedt , s.probationam , s.probationnowam , s.probationdt
				, u.user_name , s.usersta
				, s.oldarea , s.idcard , s.acc , s.accbank , s.email , s.oldname
				, h.expflag , s.freezeflag , s.recoverdt , s.recoveram , s.recovernowam , s.recovercdt
				, u1.company , u1.salarycom  , b.NameCN , h.usercard
				, s.gwam , s.jxam
				from salary s
				left join hrms h on ( s.userid=h.user_id )
				left join user u on (s.probationuser=u.user_id)
				left join user u1 on (s.userid=u1.user_id)
				left join department d on (u1.dept_id=d.dept_id)
				left join branch_info b on (b.NamePT = s.usercom )
				where
				s.userid=h.user_id
				and ( s.usersta='0' or
						( year(s.probationdt)='".$this->nowy."' and  month(s.probationdt)='".$this->nowm."' )
						or s.freezeflag='1' or
						( year(s.recovercdt)='".$this->nowy."' and  month(s.recovercdt)='".$this->nowm."' )
				    )
				$sqlSch
				order by s.usersta asc , h.userlevel desc , s.probationdt desc , $sidx $sord
				limit $start , $limit ";
		}else{
			$sql="select
				s.rand_key , s.username , s.userid , s.olddept , h.userlevel
				, s.comedt , s.probationam , s.probationnowam , s.probationdt
				, u.user_name , s.usersta
				, s.oldarea , s.idcard , s.acc , s.accbank , s.email , s.oldname
				, h.expflag , u1.company , u1.salarycom  , b.NameCN , h.usercard
				, s.gwam , s.jxam
				from salary s
				left join hrms h on ( s.userid=h.user_id )
				left join user u on (s.probationuser=u.user_id)
				left join user u1 on (s.userid=u1.user_id)
				left join department d on (u1.dept_id=d.dept_id)
				left join branch_info b on (b.NamePT = s.usercom )
				where
				s.userid=h.user_id
				and ( s.usersta='0' or ( year(s.probationdt)='".$this->nowy."' and  month(s.probationdt)='".$this->nowm."' ) )
				$sqlSch
				order by s.usersta asc , h.userlevel desc , s.probationdt desc , $sidx $sord
				limit $start , $limit ";
		}
		$query = $this->db->query($sql);
		$personnnelDao=new model_hr_personnel_personnel();

		while ($row = $this->db->fetch_array($query)) {

			$ck='no';
			$pa='';
			$pna='';
			$gwam='';
			$jxam='';
			if($row['usersta']==0){
				$ck='yes';
			}elseif(substr($row['probationdt'], 0, 4)==$this->nowy&&substr($row['probationdt'], 5, 2)==$this->nowm){
				$ck='yes';
			}
			if($row['userlevel']!=4&&$flag){
				$pa='-';
				$pna='-';
				$gwam=$this->salaryClass->decryptDeal($row['gwam']);
				$jxam=$this->salaryClass->decryptDeal($row['jxam']);
			}else{
				$pa=$this->salaryClass->decryptDeal($row['probationam']);
				$pna=$this->salaryClass->decryptDeal($row['probationnowam']);
				$gwam=$this->salaryClass->decryptDeal($row['gwam']);
				$jxam=$this->salaryClass->decryptDeal($row['jxam']);
			}
			$responce->rows[$i]['id'] = $row['userid'];
			//            if($row['ProbationAm']==0){
			//              $person=$personnnelDao->getPersonInfoByUserId($row['userid']);//��ȡ���������Ϣ
			//
			//              $Amount=$person['beforeSalary'];//���ù���
			//              $PassAm=$person['afterSalary'];//ת������
			//              $PassOldAm=$person['beforeSalary'];//ת��ǰ����
			//              $ComeDT=$person['entryDate'];//��ְʱ��
			//              //$row['becomeDate']=$person['becomeDate'];//Ԥ��ת��ʱ��
			//              $PassDT=$person['realBecomeDate'];//ʵ��ת������
			//              //$row['Acc']=$person['oftenCardNum'];//���ÿ���
			//              $Acc=$person['oftenAccount'];//�����˺�
			//              $accbank=$person['oftenBank'];//�����˺ſ�����
			//            }

			if($flag){
				if($row['freezeflag']=='1'||( substr($row['recovercdt'], 0, 4)==$this->nowy&&substr($row['recovercdt'], 5, 2)==$this->nowm )){
					$pa=$this->salaryClass->decryptDeal($row['recoveram']);
					$pna=$this->salaryClass->decryptDeal($row['recovernowam']);
					$dt=$row['recoverdt'];
					$cdt=$row['recovercdt'];
					$ck='yes';
					if($row['freezeflag']=='1'){
						$st='����';
					}else{
						$st='�ѻָ�';
					}
				}else{
					$dt=$row['comedt'];
					$cdt=$row['probationdt'];
					$st=$this->userSta[$row['usersta']];
				}
				$responce->rows[$i]['cell'] = un_iconv(
						array("", $row['rand_key'], $row['usercard'], $row['oldname'],$row['NameCN'], $this->expflag[$row['expflag']],$row['olddept']
							, $this->userLevel[$row['userlevel']]
							, $dt, $pa
							,$gwam,$jxam
							, $pna
							, $row['oldarea'] , $row['idcard'] , $row['acc'] ,$row['accbank'] , $row['email']
							, $cdt
							, $row['user_name']
							, $st
							, $ck
							, $compt
						     )
						);
			}else{
				$responce->rows[$i]['cell'] = un_iconv(
						array("", $row['rand_key'], $row['usercard'], $row['oldname'],$row['olddept']
							, $this->userLevel[$row['userlevel']]
							, $row['comedt'], $pa
							,$gwam,$jxam
							, $pna
							, $row['oldarea'] , $row['idcard'] , $row['acc'] ,$row['accbank'] , $row['email']
							, $row['probationdt']
							, $row['user_name']
							, $this->userSta[$row['usersta']]
							, $ck
							, $compt
						     )
						);
			}
			$i++;
		}
		return $responce;
	}
	/**
	 * ��ְ���� ���Ӹ�λ���ʣ���Ч����
	 */
	function model_hr_join_in($flag=true){
		$id = $_POST['id'];
		$val = round($_POST['prob'],2);
		$cdt = $_POST['cdt'];
		$compt = $_POST['compt'];
		$gwam = round($_POST['gwam'],2);
		$jxam = round($_POST['jxam'],2);
		try {
			$this->db->query("START TRANSACTION");
			$sql = "select
				s.userid ,u.dept_id , s.oldarea as area
				,s.amount , s.floatam
				,s.gjjam , s.shbam , s.newflag , s.cogjjam , s.coshbam
				,s.prepaream , s.handicapam , s.manageam , s.cessebase
				,s.olddept
				,s.freezeflag , s.freezesta , p.id as pid
				,s.recovercdt
				from salary s
				left join hrms h on (s.userid=h.user_id)
				left join user u on (s.userid=u.user_id)
				left join area a on (u.area=a.id)
				left join salary_pay p on (p.userid=s.userid and p.pyear='" . $this->nowy . "' and p.pmon='" . $this->nowm . "' )
				where s.rand_key='$id' ";
			$resck=$this->db->get_one($sql);
			if($resck['freezeflag']=='1'||( substr($resck['recovercdt'], 0, 4)==$this->nowy&&substr($resck['recovercdt'], 5, 2)==$this->nowm ) ){
				//�ָ�
				if(empty($cdt)){
					throw new Exception('Data status incorrect');
				}
				if (strtotime($cdt) < strtotime(date('Y-m') . '-01')) {
					$baseNow = 0;
				} else {
					$baseNow = $this->salaryClass->salaryDeal($cdt, $val);
				}
				$this->model_salary_update($id,
						array('amount' => $val
							, 'recoveram'=>$val
							, 'recovernowam'=>$baseNow
							, 'usersta' => $resck['freezesta']
							, 'recovercdt' => 'now()', 'recoveruser' => $_SESSION['USER_ID']
							,'oldname'=>$_POST['username']
							,'olddept'=>$_POST['dept'] , 'oldarea'=>$_POST['area']
							,'idcard'=>$_POST['idcard'],'acc'=>$_POST['acc']
							,'accbank'=>$_POST['accbank'],'email'=>$_POST['email']
							,'recoverdt' =>$cdt
							,'freezeflag'=>0
						     )
						, array(3,4,5,6,7,8,9,10,11,12,13,14,15));
				if($baseNow=='0'||empty($baseNow)){
					$baseAm = $val;
				}else{
					$baseAm = $baseNow;
				}
				if(empty($resck['pid'])){
					$totalAm = $this->salaryClass->cfv($baseAm);
					$cesseAm = $this->salaryClass->cfv($totalAm);
					$payCesse = $this->salaryClass->cesseDeal($cesseAm, $resck['cessebase']);
					$payTotal = $this->salaryClass->cfv($cesseAm - $payCesse);
					$sql = "insert into
						salary_pay
						set
						userid='" . $resck['userid'] . "'
						, deptid='" . $resck['dept_id'] . "'
						, area='" . $resck['area'] . "'
						, salarydept='" . $resck['olddept'] . "'
						, pyear='" . $this->nowy . "'
						, pmon='" . $this->nowm . "'
						, baseam='" . $this->salaryClass->encryptDeal($val) . "'
						, basenowam='" . $this->salaryClass->encryptDeal($baseAm) . "'
						, floatam='" . $this->zero . "'
						, gjjam='" . $this->zero . "'
						, shbam='" . $this->zero . "'
						, totalam='" . $this->salaryClass->encryptDeal($totalAm) . "'
						, cesseam='" . $this->salaryClass->encryptDeal($cesseAm) . "'
						, paycesse='" . $this->salaryClass->encryptDeal($payCesse) . "'
						, paytotal='" . $this->salaryClass->encryptDeal($payTotal) . "'
						, cogjjam='" . $resck['cogjjam'] . "'
						, coshbam='" . $resck['coshbam'] . "'
						, prepaream='" . $resck['prepaream'] . "'
						, handicapam='" . $resck['handicapam'] . "'
						, manageam='" . $resck['manageam'] . "'
						, cessebase='".$resck['cessebase']."'
						, createdt=now()
						, nowamflag=5 ";
					$this->db->query_exc($sql);
				}else{
					$this->model_pay_update($resck['pid'],
							array('baseam' => $val, 'basenowam' => $baseNow, 'nowamflag' => '5')
							, array(2));
					$this->model_pay_stat($resck['pid']);
				}
			}else{//��ְ
				$sql = "select
					p.id , s.comedt , h.userlevel , s.userid , s.usersta
					from salary_pay p
					left join salary s on (p.userid=s.userid)
					left join hrms h on (s.userid=h.user_id)
					where
					p.pyear='" . $this->nowy . "' and p.pmon='" . $this->nowm . "' and p.userid=s.userid
					and  s.rand_key='$id' ";
				$res = $this->db->get_one($sql);
				if(!$res['userid']){
					throw new Exception('No data query');
				}
				if($res['usersta']>1){
					throw new Exception('Data status incorrect');
				}
				if(!empty($cdt)){
					$res['comedt']=$cdt;
				}
				if($flag){//����
					if($res['userlevel']==4){//�ǹ����Ա��
						if (strtotime($res['comedt']) < strtotime(date('Y-m') . '-01')) {
							$baseNow = 0;
						} else {
							$baseNow = $this->salaryClass->salaryDeal($res['comedt'], $val+$gwam+$jxam);
						}
						$this->model_salary_update($id,
								array('amount' => $val, 'probationam' => $val
									,'probationnowam'=>$this->salaryClass->salaryDeal($res['comedt'], $val+$gwam+$jxam)
									,'gwam'=>$gwam
									,'jxam' =>$jxam
									, 'usersta' => '1'
									, 'probationdt' => 'now()', 'probationuser' => $_SESSION['USER_ID']
									,'oldname'=>$_POST['username']
									,'olddept'=>$_POST['dept'] , 'oldarea'=>$_POST['area']
									,'idcard'=>$_POST['idcard'],'acc'=>$_POST['acc']
									,'accbank'=>$_POST['accbank'],'email'=>$_POST['email']
									,'comedt' =>date('Ymd',strtotime($res['comedt']))
								     )
								, array(5,6,7,8,9,10,11,12,13,14,15));
						$this->model_pay_update($res['id'],
								array('baseam' => $val, 'basenowam' => $baseNow
									, 'gwam' => $gwam , 'jxam' => $jxam
									, 'nowamflag' => '1', 'leaveflag'=>'0')
								, array(4,5));
						$this->model_pay_stat($res['id']);
					}else{//�����
						$this->model_salary_update($id,
								array(
									'oldname'=>$_POST['username']
									,'olddept'=>$_POST['dept'] , 'oldarea'=>$_POST['area']
									,'idcard'=>$_POST['idcard'],'acc'=>$_POST['acc']
									,'accbank'=>$_POST['accbank'],'email'=>$_POST['email']
									,'comedt' =>date('Ymd',strtotime($res['comedt']))
								     ),array(0,1,2,3,4,5,6,7)
								);
					}
				}else{
					if (strtotime($res['comedt']) < strtotime(date('Y-m') . '-01')) {
						$baseNow = 0;
					} else {
						$baseNow = $this->salaryClass->salaryDeal($res['comedt'], $val+$gwam+$jxam);
					}
					$this->model_salary_update($id,
							array('amount' => $val, 'probationam' => $val
								,'probationnowam'=>$this->salaryClass->salaryDeal($res['comedt'], $val+$gwam+$jxam)
								,'gwam'=>$gwam
								,'jxam' =>$jxam
								, 'usersta' => '1'
								, 'probationdt' => 'now()', 'probationuser' => $_SESSION['USER_ID']
							     )
							, array(5, 6,7));
					$this->model_pay_update($res['id'],
							array('baseam' => $val, 'basenowam' => $baseNow
								, 'gwam' => $gwam , 'jxam' => $jxam
								, 'nowamflag' => '1', 'leaveflag'=>'0')
							, array(4,5));
					$this->model_pay_stat($res['id']);
				}
			}
			$this->db->query("COMMIT");
			$responce->id = $id;
			$this->globalUtil->insertOperateLog('���ʹ���', $id, 'Ա����ְ', '�ɹ�');
		} catch (Exception $e) {
			$this->db->query("ROLLBACK");
			$responce->error = $e->getMessage();
			$this->globalUtil->insertOperateLog('���ʹ���', $id, 'Ա����ְ', 'ʧ��', $e->getMessage());
		}
		return $responce;
	}
	/**
	/**
	 *ת��
	 */
	function model_hr_pass_list($flag=true,$sqlflag=''){
		$page = $_GET['page'];
		$limit = $_GET['rows'];
		$sidx = $_GET['sidx'];
		$sord = $_GET['sord'];
		$schOper = $_GET['searchOper'];
		$schStr = $_GET['searchString'];
		$schField = $_GET['searchField'];
		$seadept = $_REQUEST['seadept'];
		$seaname = $_REQUEST['seaname'];
		$sqlSch = '';
		if ($schOper) {
			$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
		}
		if($flag==false){
			$sqlSch.=$sqlflag;
		}
		if($seadept){
			$sqlSch.=" and d.dept_name like '%".$seadept."%' ";
		}
		if($seaname){
			$sqlSch.=" and u1.user_name like '%".$seaname."%' ";
		}
		$start = $limit * $page - $limit;
		//����
		$sql = "select count(*)
			from salary s
			left join hrms h on (s.userid=h.user_id)
			left join user u1 on (s.userid=u1.user_id)
			left join department d on (u1.dept_id=d.dept_id)
			where
			s.userid=h.user_id
			and s.usersta>=1
			and ( s.usersta=1 or ( year(s.passuserdt)='".$this->nowy."' and month(s.passuserdt)='".$this->nowm."' ) )
			$sqlSch ";
		$rs = $this->db->get_one($sql);
		$count = $rs['count(*)'];
		if ($count > 0) {
			$total_pages = ceil($count / $limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages){
			$page = $total_pages;
		}
		$i = 0;
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$sql="select
			s.rand_key , u1.user_name as username , s.userid , d.dept_name as olddept , h.userlevel , h.join_date
			, s.passdt , s.passam , s.passnowam , s.passuserdt , b.NameCN
			, u.user_name , s.usersta
			, h.userlevel , h.expflag
			, s.passoldam
			, u1.company , u1.salarycom , h.usercard
			, s.gwam , s.jxam
			from salary s
			left join hrms h on ( s.userid=h.user_id )
			left join user u on (s.passuser=u.user_id)
			left join user u1 on (s.userid=u1.user_id)
			left join department d on (u1.dept_id=d.dept_id)
			left join branch_info b on (b.NamePT = s.usercom )
			where
			s.userid=h.user_id
			and s.usersta>=1
			and ( s.usersta=1 or ( year(s.passuserdt)='".$this->nowy."' and month(s.passuserdt)='".$this->nowm."' ) )
			$sqlSch
			order by s.usersta asc , h.userlevel desc , s.passuserdt desc , $sidx $sord
			limit $start , $limit ";
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {

			$ck='no';
			$pa='';
			$pna='';
			$gwam='';
			$jxam='';
			$tdt=empty($row['passdt'])?$row['join_date']:$row['passdt'];
			if($row['usersta']==1){
				$ck='yes';
			}elseif(substr($row['passuserdt'], 0, 4)==$this->nowy&&substr($row['passuserdt'], 5, 2)==$this->nowm){
				if($row['userlevel']!=4&&$row['passam']&&$flag){
					$ck='no';
				}else{
					$ck='yes';
				}
			}
			if($row['userlevel']!=4&&$flag){
				$pa='-';
				$pna='-';
				$poa='-';
			}else{
				$pa=$this->salaryClass->decryptDeal($row['passam']);
				$pna=$this->salaryClass->decryptDeal($row['passnowam']);
				$poa=$this->salaryClass->decryptDeal($row['passoldam']);

				$gwam=$this->salaryClass->decryptDeal($row['gwam']);
				$jxam=$this->salaryClass->decryptDeal($row['jxam']);
			}
			$responce->rows[$i]['id'] = $row['userid'];
			$responce->rows[$i]['cell'] = un_iconv(
					array("", $row['rand_key'],  $row['usercard'], $row['username'], $row['NameCN']
						, $row['olddept'],$this->expflag[$row['expflag']]
						, $this->userLevel[$row['userlevel']]
						, $tdt
						, $pa
						,$gwam
						,$jxam
						, $pna
						, $poa
						, $row['passuserdt']
						, $row['user_name']
						, $this->userSta[$row['usersta']]
						, $ck
						, $compt
					     )
					);
			$i++;
		}
		return $responce;
	}
	/**
	 * ת������
	 */
	function model_hr_pass_in($flag=true){
		$id = $_POST['id'];
		$passam = $_POST['passam'];
		$passdt = $_POST['passdt'];

		$gwam = $_POST['gwam'];
		$jxam = $_POST['jxam'];

		$sm=false;
		try {
			$this->db->query("START TRANSACTION");
			$sql="select
				p.id , s.amount , h.userlevel , s.userid , s.usersta , s.passoldam , s.username , s.passdt , h.expflag
				, s.gwam , s.jxam
				from salary_pay p
				left join salary s on (p.userid=s.userid)
				left join hrms h on (s.userid=h.user_id)
				where
				p.pyear='" . $this->nowy . "' and p.pmon='" . $this->nowm . "' and p.userid=s.userid
				and  s.rand_key='$id'  ";
			$res = $this->db->get_one($sql);
			if(!$res['userid']){
				throw new Exception('No data query ');
			}
			if($res['usersta']>2||$res['usersta']==0){
				throw new Exception('Data status incorrect');
			}
			if($flag){
				if ($res['userlevel'] == 4) {
					if($res['usersta']==2){
						$passOldAm=$this->salaryClass->decryptDeal($res['passoldam']);
					}else{
						$passOldAm=round( $this->salaryClass->decryptDeal($res['amount'])
								+$this->salaryClass->decryptDeal($res['gwam'])
								+$this->salaryClass->decryptDeal($res['jxam'])
								, 2);
					}
					$passNowAm=$this->salaryClass->salaryPass($passOldAm
							,  round($passam+$gwam+$jxam  ,2)
							, $passdt);
					if(date('Y-m',  strtotime($passdt))==date('Y-m')){//����ת��
						$baseNowAm = $passNowAm;
					}else{
						$baseNowAm = 0;
					}
					$this->model_salary_update($id,
							array('amount' => $passam, 'passam' => $passam, 'usersta' => '2'
								, 'passdt' => $passdt
								, 'passuserdt' => 'now()', 'passuser' => $_SESSION['USER_ID']
								, 'passnowam'=>$passNowAm
								, 'passoldam'=>$passOldAm
								,'gwam'=>$gwam
								,'jxam'=>$jxam
							     )
							, array(2, 3, 4,5));
					$this->model_pay_update($res['id'],
							array('baseam' => $passam, 'basenowam' => $baseNowAm
								,'gwam'=>$gwam
								,'jxam'=>$jxam
								, 'nowamflag' => '2')
							, array(4));
					$this->model_pay_stat($res['id']);
				} else {
					$sm=true;
					$this->model_salary_update($id, array('passdt' => $passdt, 'passuser' => $_SESSION['USER_ID']), array(0, 1));
				}
				$sql="update hrms set join_date='".$passdt."' where user_id='".$res['userid']."' ";
				$this->db->query_exc($sql);
			}else{
				if(!$res['passdt']){
					throw new Exception('Data state error1');
				}
				$passdt=$res['passdt'];
				if($res['usersta']==2){
					$passOldAm=$this->salaryClass->decryptDeal($res['passoldam']);
				}else{
					$passOldAm=round( $this->salaryClass->decryptDeal($res['amount'])
							+$this->salaryClass->decryptDeal($res['gwam'])
							+$this->salaryClass->decryptDeal($res['jxam'])
							, 2);
				}
				$passNowAm=$this->salaryClass->salaryPass($passOldAm
						,  round($passam+$gwam+$jxam  ,2)
						, $passdt);
				if(date('Y-m',  strtotime($passdt))==date('Y-m')){//����ת��
					$baseNowAm = $passNowAm;
				}else{
					$baseNowAm = 0;
				}
				$this->model_salary_update($id,
						array('amount' => $passam, 'passam' => $passam, 'usersta' => '2'
							, 'passdt' => $passdt
							, 'passuserdt' => 'now()', 'passuser' => $_SESSION['USER_ID']
							, 'passnowam'=>$passNowAm
							, 'passoldam'=>$passOldAm
							,'gwam'=>$gwam
							,'jxam'=>$jxam
						     )
						, array(2, 3, 4,5));
				$this->model_pay_update($res['id'],
						array('baseam' => $passam, 'basenowam' => $baseNowAm
							,'gwam'=>$gwam
							,'jxam'=>$jxam
							, 'nowamflag' => '2')
						, array(4));
				$this->model_pay_stat($res['id']);
			}
			$this->db->query("COMMIT");
			if($sm){
				$emaildb=$this->model_get_superiors($res['userid']);
				$body='���ã�<br>
					Ա����'.$res['username'].',��ת������Ҫ��¼��ת����Ĺ��ʡ�<br>
					лл��';
				$this->model_send_email('����--ת������¼��', $body, $emaildb, false);
			}
			$responce->id = $id;
			$this->globalUtil->insertOperateLog('���ʹ���', $id, 'Ա��ת��', '�ɹ�');
		} catch (Exception $e) {
			$this->db->query("ROLLBACK");
			$responce->error = $e->getMessage();
			$this->globalUtil->insertOperateLog('���ʹ���', $id, 'Ա��ת��', 'ʧ��', $e->getMessage());
		}
		return $responce;
	}
	/**
	 *��ְ
	 */
	function model_hr_leave_list(){
		$page = $_GET['page'];
		$limit = $_GET['rows'];
		$sidx = $_GET['sidx'];
		$sord = $_GET['sord'];
		$schOper = $_GET['searchOper'];
		$schStr = $_GET['searchString'];
		$schField = $_GET['searchField'];
		$seadept = $_REQUEST['seadept'];
		$seaname = $_REQUEST['seaname'];
		$sqlSch = '';
		if ($schOper) {
			$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
		}
		if($seadept){
			$sqlSch.=" and d.dept_name like '%".$seadept."%' ";
		}
		if($seaname){
			$sqlSch.=" and u1.user_name like '%".$seaname."%' ";
		}
		$start = $limit * $page - $limit;
		//����
		$sql = "select count(*)
			from salary s
			left join user u1 on (u1.user_id=s.userid)
			left join department d on (u1.dept_id=d.dept_id)
			where
			1
			$sqlSch ";
		$rs = $this->db->get_one($sql);
		$count = $rs['count(*)'];
		if ($count > 0) {
			$total_pages = ceil($count / $limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages){
			$page = $total_pages;
		}
		$i = 0;
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$sql="select
			s.rand_key , u1.user_name as username , d.dept_name as olddept , s.leavedt
			, s.leavecreatedt , u.user_name , s.usersta
			, h.expflag , s.freezedt , u1.user_name as freezeuser , s.freezecdt , s.freezeflag
			, u1.company , u1.salarycom ,b.NameCN , h.usercard
			from salary s
			left join user u on (s.leavecreator=u.user_id)
			left join user u1 on (u1.user_id=s.userid)
			left join department d on (u1.dept_id=d.dept_id)
			left join hrms h on (s.userid=h.user_id)
			left join branch_info b on (b.NamePT = s.usercom )
			where
			1
			$sqlSch
			order by s.usersta , s.leavecreatedt desc , $sidx $sord
			limit $start , $limit ";
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {

			if($row['freezeflag']=='1'){
				$dt=$row['freezedt'];
				$us=$row['freezeuser'];
				$cdt=$row['freezecdt'];
				$st='����';
			}else{
				$dt=$row['leavedt'];
				$us=$row['user_name'];
				$cdt=$row['leavecreatedt'];
				$st=$this->userSta[$row['usersta']];
			}
			if((date('Y', strtotime($dt))==$this->nowy&&date('n',strtotime($dt))==$this->nowm)
					||(date('Y', strtotime($cdt))==$this->nowy&&date('n',strtotime($cdt))==$this->nowm)){
				$ck='yes';
			}else{
				$ck='no';
			}
			$responce->rows[$i]['id'] = $row['userid'];
			$responce->rows[$i]['cell'] = un_iconv(
					array("", $row['rand_key']
						, $row['usercard']
						, $row['username']
						, $row['NameCN']
						, $row['olddept']
						, $this->expflag[$row['expflag']]
						, $dt
						, $cdt
						, $us
						, $st
						, $ck
						, $compt
					     )
					);
			$i++;
		}
		return $responce;
	}
	/**
	 * ��ְ����
	 */
	function model_hr_leave_in(){
		$id = $_POST['id'];
		$leavedt = $_POST['leavedt'];
		$actflag = $_POST['actflag'];
		$compt = $_POST['compt'];
		$sm=false;
		try {
			$this->db->query("START TRANSACTION");
			$sql="select
				p.id , h.expflag , p.userid , p.baseam , s.comedt , s.usersta , s.amount
				from salary_pay p
				left join salary s on (p.userid=s.userid)
				left join hrms h on (s.userid=h.user_id)
				where
				p.pyear='" . $this->nowy . "' and p.pmon='" . $this->nowm . "' and p.userid=s.userid
				and  s.rand_key='$id'  ";
			$res = $this->db->get_one($sql);
			if(!$res['id']){
				throw new Exception('No data query ');
			}
			if($actflag=='lz'){//��ְ
				if(empty($leavedt)){//����ְ
					$this->model_salary_update($id,
							array('sta' => 1
								, 'usersta' => 2
								, 'leavedt' => null
								, 'leavecreatedt' => 'now()'
								, 'leavecreator'=>$_SESSION['USER_ID']
							     )
							, array(0,1,2,3,4));
					//ͳһ
					$pid=$res['id'];
					//��ְ������ְ��������һ���µ���ְ��Աʱ��Ϊ�˲�Ӱ���ϸ��¹������ݣ�ͳһֻ�ܹ�ѡ����һ�ţ�����ʱ���ֶ�������������Ϊ0��
					//�������ݻָ�
					$this->model_pay_update($pid,
							array('nowamflag' => '0','leaveflag'=>'0')
							, array(0,1));
					$this->model_pay_stat($pid);
					$sql="update hrms set userstatmp='1' , LEFT_DATE=null where user_id='".$res['userid']."'";
					$this->db->query_exc($sql);
					//��ϵͳ
					$sql="update  oa_hr_personnel  p set p.quitDate=null
						where p.useraccount='".$res['userid']."'";
					$this->db->query_exc($sql);
				}else{
					$this->model_salary_update($id,
							array('sta' => 1
								, 'usersta' => 3
								, 'leavedt' => $leavedt
								, 'leavecreatedt' => 'now()'
								, 'leavecreator'=>$_SESSION['USER_ID']
							     )
							, array(0,1,2,3,4));
					//ͳһ
					$pid=$res['id'];
					$leaveDateTime = strtotime($leavedt);
					//��ְ������ְ��������һ���µ���ְ��Աʱ��Ϊ�˲�Ӱ���ϸ��¹������ݣ�ͳһֻ�ܹ�ѡ����һ�ţ�����ʱ���ֶ�������������Ϊ0��
					if($leaveDateTime > strtotime(date('Y-m-t'))){//���º���ְ
						//�������ݻָ�
						$this->model_pay_update($pid,
								array('nowamflag' => '0','leaveflag'=>'0')
								, array(0,1));
						$this->model_pay_stat($pid);

					}else {
						//�ϸ�����ְ����������� 6��1�Ų�������ְ��������ְ��������5���������
						if(date('Y',$leaveDateTime)==date('Y')&&(date('m')-date("m",$leaveDateTime)==1)){
							// �³������ϸ�����ְ����Աʱ����Ҫ�ȸ�����ְ��Ա�ϸ��µĹ�����Ϣ
							$year = date('Y');
							if(date('m')=='01'){  //������һ�µĻ����ϸ��������Ҫ��һ
								$year -= 1;
							}
							$salaryPay = $this->getSalaryPay($year,date("m",$leaveDateTime),$res['userid']);

							$this->model_pay_update($salaryPay['ID'],
									array('nowamflag' => '3','leaveflag'=>'0')
									, array(0,1));
						}
						//��ְ�������ڱ��»������£�����Ҫ���±��¹�������
						$this->model_pay_update($pid,
								array('nowamflag' => '3','leaveflag'=>'0')
								, array(0,1));
					}
					$sql="update hrms set userstatmp='1' , LEFT_DATE='".$leavedt."' where user_id='".$res['userid']."'";
					$this->db->query_exc($sql);
					//��ϵͳ
					$sql="update  oa_hr_personnel  p set p.quitDate='".$leavedt."'
						where p.useraccount='".$res['userid']."'";
					$this->db->query_exc($sql);
				}

			}elseif($actflag=='dj'){//����
				if(empty($leavedt)){//��������Ϊ�գ�����ⶳ
					$this->model_salary_update($id,
							array('sta' => 0
								, 'usersta' => 2
								, 'freezedt' => $leavedt
								, 'freezeuser'=>$_SESSION['USER_ID']
								, 'freezecdt'=>'now()'
								, 'freezeflag'=>'0'
								, 'freezesta'=>$res['usersta']
							     )
							, array(0,1,2,3,4,5,6)
							);
					$amount=$this->salaryClass->decryptDeal($res['amount']);
					$pid=$res['id'];
					$this->model_pay_update($pid,
							array('basenowam' => '0', 'nowamflag' => '0','leaveflag'=>0,'baseam' => $amount)
							, array(1,2));
					$this->model_pay_stat($pid);
				}else{
					$this->model_salary_update($id,
							array('sta' => 1
								, 'usersta' => 3
								, 'freezedt' => $leavedt
								, 'freezeuser'=>$_SESSION['USER_ID']
								, 'freezecdt'=>'now()'
								, 'freezeflag'=>'1'
								, 'freezesta'=>$res['usersta']
							     )
							, array(0,1,2,3,4,5,6)
							);
					$amount=$this->salaryClass->decryptDeal($res['amount']);
					$pid=$res['id'];
					$baseNow = $this->salaryClass->getSalaryByDateToWorkDays($amount,$leavedt,false);
					if($baseNow==0){//�ر�
						$amount=$baseNow;
					}
					$this->model_pay_update($pid,
							array('basenowam' => $baseNow, 'nowamflag' => '4','leaveflag'=>0,'baseam' => $amount)
							, array(1,2));
					$this->model_pay_stat($pid);
				}
			}
			$this->db->query("COMMIT");
			$responce->id = $id;
			$this->globalUtil->insertOperateLog('���ʹ���', $id, 'Ա����ְ', '�ɹ�');
		} catch (Exception $e) {
			$this->db->query("ROLLBACK");
			$responce->error = $e->getMessage();
			$this->globalUtil->insertOperateLog('���ʹ���', $id, 'Ա����ְ', 'ʧ��', $e->getMessage());
		}
		return $responce;
	}
	/**
	 * ������ݣ��·��Լ�userId��ȡ��ְ��Ա���¹�������
	 * @param  pYear  ���
	 * @param  pMon   �·�
	 * @param  userId
	 */
	function getSalaryPay($pYear,$pMon,$userId){
		$sql = "select p.ID from salary_pay p where p.PYear=$pYear and p.PMon =$pMon and p.UserId='$userId'";
		return $this->db->get_one($sql);
	}


	/**
	 *���Ų�ѯ��ְ
	 */
	function model_dp_leave_manager_list(){
		global $func_limit;
		$sqlflag='';
		$dppow=$this->model_dp_pow();
		$sqlflag = $this->getSqlParam($func_limit['�������'],$dppow);

		return $this->model_hr_leave_manager_list('list',$sqlflag);
	}
	/**
	 *��ְ�����б�
	 * $outflag list �б� xls ����
	 */
	function model_hr_leave_manager_list($outflag='list',$sqlflag=''){
		$page = $_GET['page'];
		$limit = $_GET['rows'];
		$sidx = $_GET['sidx'];
		$sord = $_GET['sord'];
		$schOper = $_GET['searchOper'];
		$schStr = $_GET['searchString'];
		$schField = $_GET['searchField'];
		$seadept = $_REQUEST['seadept'];
		$seaname = $_REQUEST['seaname'];
		$sealy = $_REQUEST['sealy']?$_REQUEST['sealy']:$this->nowy;
		$sealm = $_REQUEST['sealm']?$_REQUEST['sealm']:'';
		$seapy = $_REQUEST['seapy']?$_REQUEST['seapy']:'';
		$seapm = $_REQUEST['seapm']?$_REQUEST['seapm']:'';
		$seacom = $_REQUEST['seacom']?$_REQUEST['seacom']:'';
		$seaplf = isset($_REQUEST['seaplf'])?$_REQUEST['seaplf']:'-';
		$seapj = $_REQUEST['seapj']?$_REQUEST['seapj']:'';
		$sqlSch = '';
		if ($schOper) {
			$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
		}
		if($seadept){
			$sqlSch.=" and d.dept_name like '%".$seadept."%' ";
		}
		if($seaname){
			$sqlSch.=" and u1.user_name like '%".$seaname."%' ";
		}
		if($sealy&&$sealy!='-'){
			$sqlSch.=" and year(s.leavedt) = '".$sealy."' ";
		}
		if($sealm&&$sealm!='-'){
			$sqlSch.=" and month(s.leavedt) = '".$sealm."' ";
		}
		if($seapy&&$seapy!='-'){
			$sqlSch.=" and s.lpy = '".$seapy."' ";
		}
		if($seapm&&$seapm!='-'){
			$sqlSch.=" and s.lpm = '".$seapm."' ";
		}
		if($seapj&&$seapj!='-'){
			$sqlSch.=" and s.lpj = '".$seapj."' ";
		}
		if($seaplf!='-'){
			$sqlSch.=" and s.payleaveflag = '".$seaplf."' ";
		}
		if($seacom){
			$sqlSch.=" and u1.company = '".$seacom."' ";
		}
		if($sqlflag){
			$sqlSch.=$sqlflag;
		}
		if($outflag=='list'){
			$start = $limit * $page - $limit;
			//����
			$sql = "select count(*)
				from salary s
				left join user u1 on (u1.user_id=s.userid)
				left join department d on (u1.dept_id=d.dept_id)
				where
				1
				$sqlSch ";
			$rs = $this->db->get_one($sql);
			$count = $rs['count(*)'];
			if ($count > 0) {
				$total_pages = ceil($count / $limit);
			} else {
				$total_pages = 0;
			}
			if ($page > $total_pages){
				$page = $total_pages;
			}
			$i = 0;
			$responce->page = $page;
			$responce->total = $total_pages;
			$responce->records = $count;
			$listsql=" , $sidx $sord  limit $start , $limit ";
		}else{
			$responce=array();
		}
		$sql="select
			s.rand_key , u1.user_name as username , d.dept_name as olddept , s.leavedt
			, s.leavecreatedt , u.user_name , s.usersta
			, h.expflag
			, u1.company , u1.salarycom
			, year(s.leavedt) as py , month(s.leavedt) as pm , s.comedt
			, s.accbank , s.acc , s.userid , j.name as jname , s.payleaveflag
			, if(lpy!='',concat(s.lpy,'-',s.lpm,'-',s.lpj), '') as lpd , h.usercard , d.pdeptname
			, s.idcard , b.NameCN
			from salary s
			left join user u on (s.leavecreator=u.user_id)
			left join user u1 on (u1.user_id=s.userid)
			left join hrms h on (s.userid=h.user_id)
			left join department d on (u1.dept_id=d.dept_id)
			left join user_jobs j on (j.id=u1.jobs_id)
			left join branch_info b on (b.NamePT = s.usercom )
			where
			s.usersta=3
			$sqlSch
			order by s.payleaveflag , s.leavecreatedt desc ".$listsql;
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			$res[$row['userid']]=array(
					'username'=>$row['username']
					,'com'=>$row['NameCN']
					,'jname'=>$row['jname']
					,'expflag'=>$row['expflag']
					,'cdt'=>$row['comedt']
					,'ldt'=>$row['leavedt']
					,'lcdt'=>$row['leavecreatedt']
					,'lcu'=>$row['user_name']
					,'py'=>$row['py']
					,'pm'=> $row['pm']
					,'acc'=>$row['acc']
					,'accbank'=> $row['accbank']
					,'rk'=> $row['rand_key']
					,'comcode'=> $row['company']
					,'payleaveflag'=>$row['payleaveflag']
					,'lpd'=>$row['lpd']
					,'usercard'=>$row['usercard']
					,'pdeptname'=>$row['pdeptname']
					,'idcard'=>$row['idcard']
					);

		}
		if(!empty($res)){
			foreach($res as $key=>$val){
				if($val['payleaveflag']=='1'){
					$sp=$this->model_get_pay(
							array('userid'=>$key
								, 'pyear'=>$val['py']
								, 'pmon'=>$val['pm']
							     ),
							array(
								'BaseAm'
								,'BaseNowAm'
								,'PerHolsDays'
								,'SickHolsDays'
								,'HolsDelAm'
								,'SpeRewAm'
								,'AccDelAm'
								,'ShbAm'
								,'GjjAm'
								,'PayCesse'
								,'AccRewAm'
								,'PayTotal'
								,'SalaryDept'
								,'Remark'
								,'ID'
								,'hdar'
								,'bnar'
								,'srar'
								,'shbr'
								,'gjjr'
								,'sdar'
								,'pcr'
								,'arar'
								,'wdt'
								,'wdtr'
								,'OtherAccRewAm'
								,'AccRewAmCes'
								,'oarar'
								,'SdyAm'
								,'OtherAm'
								,'bonusam'
								,'proam'
								,'SpeDelAm'
								,'CoShbAm'
								,'CoGjjAm'
								,'ManageAm'
								)
								);
				}else{//δ������Ա��ȡ�ϸ��»�����������
					if($val['pm']==1){
						$ckpy=$val['py']-1;
						$ckpm=12;
					}else{
						$ckpy=$val['py'];
						$ckpm=$val['pm']-1;
					}
					//���»�������
					$sp1=$this->model_get_pay(
							array('userid'=>$key
								, 'pyear'=>$ckpy
								, 'pmon'=>$ckpm
							     ),
							array(
								'BaseAm'
							     )
							);
					//���»�������
					$sp2=$this->model_get_pay(
							array('userid'=>$key
								, 'pyear'=>$val['py']
								, 'pmon'=>$val['pm']
							     ),
							array(
								'ID'
								,'PerHolsDays'
								,'SickHolsDays'
								,'HolsDelAm'
								,'SpeRewAm'
								,'AccDelAm'
								,'ShbAm'
								,'GjjAm'
								,'PayCesse'
								,'AccRewAm'
								,'PayTotal'
								,'SalaryDept'
								,'Remark'
								,'hdar'
								,'bnar'
								,'srar'
								,'shbr'
								,'gjjr'
								,'sdar'
								,'pcr'
								,'arar'
								,'wdt'
								,'wdtr'
								,'OtherAccRewAm'
								,'AccRewAmCes'
								,'oarar'
								,'SdyAm'
								,'OtherAm'
								,'bonusam'
								,'proam'
								,'SpeDelAm'
								,'CoShbAm'
								,'CoGjjAm'
								,'ManageAm'
								)
								);
					if(empty($sp1)){
						$sp=$sp2;
					}elseif(empty($sp2)){
						$sp=$sp1;
					}else{
						$sp=$sp1+$sp2;
					}
				}

				/*'����','KEY','����','��˾','����','Ա������','��ְ����','��ְ����'
				  ,'��������','�¼�','����','�²��ٿ۳�','ʵ�ʹ���С��','�����'
				  ,'�籣��','������','�����۳�','��������˰','��ְ����','ʵ����ְ����'
				  ,'�˺�','������'
				 *
				 */
				if($outflag=='list'){
					$responce->rows[$i]['id'] = $row['userid'];
					$responce->rows[$i]['cell'] = un_iconv(
							array("", $val['rk']
								, $val['usercard']
								, $val['username']
								, $val['com']
								, $sp['SalaryDept']
								, $val['jname']
								, $this->expflag[$val['expflag']]
								, date('Y-m-d',strtotime($val['cdt']))
								, $val['ldt']
								, $val['lpd']
								, $this->salaryClass->decryptDeal($sp['BaseAm'])
								, $sp['PerHolsDays']
								, $sp['SickHolsDays']
								, ($sp['wdt']=='-1'?($this->salaryClass->getLeaveWorkDays($val['cdt'], $val['ldt'])):$sp['wdt'])
								, $this->salaryClass->decryptDeal($sp['HolsDelAm'])
								, round($this->salaryClass->decryptDeal($sp['BaseNowAm'])-$this->salaryClass->decryptDeal($sp['HolsDelAm']),2)
								, round($this->salaryClass->decryptDeal($sp['SpeRewAm'])+$this->salaryClass->decryptDeal($sp['SdyAm'])
									+$this->salaryClass->decryptDeal($sp['OtherAm'])+$this->salaryClass->decryptDeal($sp['bonusam'])
									+$this->salaryClass->decryptDeal($sp['proam']),2)
								, $this->salaryClass->decryptDeal($sp['ShbAm'])
								, $this->salaryClass->decryptDeal($sp['GjjAm'])

								, $this->salaryClass->decryptDeal($sp['PayCesse'])
								, round($this->salaryClass->decryptDeal($sp['SpeDelAm'])+$this->salaryClass->decryptDeal($sp['AccDelAm']),2)
								, $this->salaryClass->decryptDeal($sp['AccRewAm'])
								, $this->salaryClass->decryptDeal($sp['AccRewAmCes'])
								, $this->salaryClass->decryptDeal($sp['OtherAccRewAm'])
								, $this->salaryClass->decryptDeal($sp['PayTotal'])
								,$val['acc']
								,$val['accbank']
								,$sp['Remark']
								,$val['comcode']
								,'yes'
								,$sp['ID']
								,$sp['hdar'],$sp['bnar'],$sp['srar'],$sp['shbr'],$sp['gjjr'],$sp['sdar'],$sp['pcr'],$sp['arar']
								,($val['payleaveflag']=='1'?'�ѽ���':'δ����')
								,$val['pm'],$sp['wdtr'],$sp['oarar']
								)
								);
					$i++;
				}elseif($outflag=='xls'){
					$responce[]=un_iconv(array(
								$val['usercard']
								, $val['username']
								, $val['com']
								, $val['pdeptname']
								, $sp['SalaryDept']
								, $val['jname']
								, $this->expflag[$val['expflag']]
								, date('Ymd',strtotime($val['cdt']))
								, date('Ymd',strtotime($val['ldt']))
								,($val['payleaveflag']=='1'?'�ѽ���':'δ����')
								, date('Ymd',strtotime($val['lpd']))
								, $this->salaryClass->decryptDeal($sp['BaseAm'])
								, $sp['PerHolsDays']
								, $sp['SickHolsDays']
								, ($sp['wdt']=='-1'?($this->salaryClass->getLeaveWorkDays($val['cdt'], $val['ldt'])):$sp['wdt'])
								, $this->salaryClass->decryptDeal($sp['HolsDelAm'])
								, round($this->salaryClass->decryptDeal($sp['BaseNowAm'])-$this->salaryClass->decryptDeal($sp['HolsDelAm']),2)
								, round($this->salaryClass->decryptDeal($sp['SpeRewAm'])+$this->salaryClass->decryptDeal($sp['SdyAm'])
									+$this->salaryClass->decryptDeal($sp['OtherAm'])+$this->salaryClass->decryptDeal($sp['bonusam'])
									+$this->salaryClass->decryptDeal($sp['proam']),2)
								, $this->salaryClass->decryptDeal($sp['ShbAm'])
								, $this->salaryClass->decryptDeal($sp['GjjAm'])
								, $this->salaryClass->decryptDeal($sp['PayCesse'])
								, $this->salaryClass->decryptDeal($sp['AccDelAm'])
								, $this->salaryClass->decryptDeal($sp['AccRewAm'])
								, $this->salaryClass->decryptDeal($sp['AccRewAmCes'])
								, $this->salaryClass->decryptDeal($sp['OtherAccRewAm'])
								, $this->salaryClass->decryptDeal($sp['PayTotal'])
								, $this->salaryClass->decryptDeal($sp['CoShbAm'])
								, $this->salaryClass->decryptDeal($sp['CoGjjAm'])
								, $this->salaryClass->decryptDeal($sp['ManageAm'])
								,$val['acc']
								,$val['accbank']
								,$val['idcard']
								,($sp['wdtr']!=''? '��ְ���³���������'.$sp['wdtr'].'��':'')
								.($sp['hdar']!=''? '�²��ٿ۳���'.$sp['hdar'].'��':'')
								.($sp['bnar']!=''? '��ְ����С�ƣ�'.$sp['bnar'].'��':'')
								.($sp['srar']!=''? '�������'.$sp['srar'].'��':'')
								.($sp['shbr']!=''? '��ᱣ�շѣ�'.$sp['shbr'].'��':'')
								.($sp['gjjr']!=''? 'ס��������'.$sp['gjjr'].'��':'')
								.($sp['pcr']!=''? '��������˰��'.$sp['pcr'].'��':'')
								.($sp['sdar']!=''? '�����۳���'.$sp['sdar'].'��':'')
								.($sp['arar']!=''? '��ְ������'.$sp['arar'].'��':'')
								.($sp['oarar']!=''? '����˰���跢��'.$sp['oarar'].'��':'')
								.($sp['Remark']!=''? '��ע��'.$sp['Remark'].'��':'')
								));
				}
			}
		}
		return $responce;
	}
	/**
	 *������ְ����
	 */
	function model_cal_leavepay(){
		$key=$_POST['key'];
		$leavedt=$_POST['leavedt'];
		$comedt=$_POST['comedt'];
		$baseam=$_POST['baseam'];
		$ph=$_POST['ph'];
		$sh=$_POST['sh'];
		$sra=$_POST['sra'];
		$shb=$_POST['shb'];
		$gjj=$_POST['gjj'];
		$sda=$_POST['sda'];//˰��۳�
		$ara=$_POST['ara'];
		$wdt=$_POST['wdt'];
		$oara=$_POST['oara'];//����˰��۳�
		$arac=$_POST['arac'];//����˰��
		$comedt=date('Y-m-d',strtotime($comedt));
		//��ְ����
		$swd=round($wdt+$sh+$ph,2);
		$bna = $this->salaryClass->getSalaryByWorkDays($baseam , $swd , $leavedt);
		$hda = round($this->salaryClass->holsDeal($ph, $sh, $baseam,$leavedt),2);
		$bna=round($bna-$hda,2);//��ְС��
		//�����˰
		$cesse=round($bna+$sra-$shb-$gjj,2);
		$pc = $this->salaryClass->cesseDeal($cesse);
		//��=˰ǰ-��˰+����-�۳�-����˰-�����跢
		$ptol=round($cesse-$pc+$ara-$sda-$arac+$oara,2);

		$responce->hda=$hda;
		$responce->bna=$bna;
		$responce->pc=$pc;
		$responce->ptol=$ptol;

		return $responce;

	}
	/**
	 *����
	 */
	function model_cal_leave_in(){

		$key=$_POST['key'];
		$leavedt=$_POST['leavedt'];
		$comedt=$_POST['comedt'];
		$baseam=$_POST['baseam'];
		$ph=$_POST['ph'];
		$sh=$_POST['sh'];
		$sra=$_POST['sra'];
		$shb=$_POST['shb'];
		$gjj=$_POST['gjj'];
		$sda=$_POST['sda'];
		$ara=$_POST['ara'];
		$com=$_POST['comcode'];
		$pid=$_POST['pid'];
		$acc=$_POST['acc'];
		$hdar=$_POST['hdar'];
		$bnar=$_POST['bnar'];
		$srar=$_POST['srar'];
		$shbr=$_POST['shbr'];
		$gjjr=$_POST['gjjr'];
		$sdar=$_POST['sdar'];
		$arar=$_POST['arar'];
		$pcr=$_POST['pcr'];

		$accbank=$_POST['accbank'];
		$remark=$_POST['remark'];
		$comedt=date('Y-m-d',strtotime($comedt));
		//
		$wdt=$_POST['wdt'];
		$wdtr=$_POST['wdtr'];
		$oara=$_POST['oara'];
		$oarar=$_POST['oarar'];
		$arac=$_POST['arac'];
		$lpd=$_POST['lpd'];
		if($lpd){
			$lpy=date('Y',strtotime($lpd));
			$lpm=date('n',strtotime($lpd));
			$lpj=date('j',strtotime($lpd));
		}

		if($key&&$pid){
			$stemp=$this->model_get_salary($key,array('leavedt','userid'));
			//���»���
			$this->model_salary_update($key,
					array(
						'leavedt' => $leavedt
						,'acc'=>$acc
						,'accbank'=>$accbank
						,'payleaveflag'=>1
						,'payleavedt'=>date('Y-m-d H:i:s')
						,'payleaveuser'=>$_SESSION['USER_ID']
						,'lpy'=>$lpy
						,'lpm'=>$lpm
						,'lpj'=>$lpj
						,'amount'=>$baseam
						,'shbam'=>$shb
						,'gjjam'=>$gjj
					     )
					, array(0,1,2,3,4,5,6,7,8));
			//���µ���
			//$res = array('holsdelam' => $holsdelAm, 'totalam' => $totalAm, 'paycesse' => $payCesse, 'paytotal' => $payTotal);
			//��ְ����
			$swd=round($wdt+$sh+$ph,2);
			$bna = $this->salaryClass->getSalaryByWorkDays($baseam , $swd , $leavedt);
			$hda = round($this->salaryClass->holsDeal($ph, $sh, $baseam,$leavedt),2);
			//�����˰
			$cesse=round($bna-$hda+$sra-$shb-$gjj,2);
			$pc = $this->salaryClass->cesseDeal($cesse);
			//��=˰ǰ-��˰+����-�۳�-����˰-�����跢
			$ptol=round($cesse-$pc+$ara-$sda-$arac+$oara,2);
			$this->model_pay_update($pid,
					array(
						'Remark'=>$remark
						, 'PerHolsDays' => $ph
						,'SickHolsDays'=> $sh

						,'hdar' => $hdar
						,'bnar'=> $bnar
						,'srar' => $srar
						,'shbr'=> $shbr
						,'gjjr' => $gjjr
						,'sdar'=> $sdar
						,'pcr'=> $pcr
						,'arar'=> $arar
						,'wdt'=>$wdt
						,'wdtr'=>$wdtr
						,'oarar'=>$oarar

						,'baseam' => $baseam
						,'basenowam' => $bna
						,'SpeRewAm'=>$sra
						,'AccDelAm'=>$sda
						,'AccRewAm'=>$ara
						,'shbam'=>$shb
						,'gjjam'=>$gjj
						,'SdyAm'=>0
						,'OtherAm'=>0
						,'bonusam'=>0
						,'proam'=>0
						,'SpeDelAm'=>0
						,'OtherAccRewAm'=>$oara
						,'AccRewAmCes'=>$arac
						,'holsdelam'=>$hda
						,'totalam'=>$cesse
						,'paycesse'=>$pc
						,'paytotal'=>$ptol
						)
						, array(0,1,2,3,4,5,6,7,8,9,10,11,12,13));
			if($stemp['leavedt']!=$leavedt){
				//�������µ�����
				$sql="update hrms set LEFT_DATE='".$leavedt."' where user_id='".$stemp['userid']."'";
				$this->db->query_exc($sql);
				//��ϵͳ
				$sql="update  oa_hr_personnel p set p.quitDate='".$leavedt."' where p.useraccount='".$stemp['userid']."'";
				$this->db->query_exc($sql);
			}

		}else{
			$responce->error='pid is null or key is null';
		}
		$responce->id=$key;
		return $responce;
	}
	/**
	 *����
	 */
	function model_hr_spe_list(){
		$page = $_GET['page'];
		$limit = $_GET['rows'];
		$sidx = $_GET['sidx'];
		$sord = $_GET['sord'];
		$schOper = $_GET['searchOper'];
		$schStr = $_GET['searchString'];
		$schField = $_GET['searchField'];
		$sqlSch = '';
		if ($schOper) {
			$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
		}
		$start = $limit * $page - $limit;
		//����
		$sql = "select count(*)
			from salary_spe s
			left join salary sa on (s.payuserid=sa.userid)
			left join user u1 on (s.payuserid=u1.user_id)
			where
			s.payuserid=sa.userid
			$sqlSch ";
		$rs = $this->db->get_one($sql);
		$count = $rs['count(*)'];
		if ($count > 0) {
			$total_pages = ceil($count / $limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages){
			$page = $total_pages;
		}
		$i = 0;
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$sql="select
			s.rand_key , u1.user_name as username , sa.userid , d.dept_name as olddept
			, concat(s.payyear,'-',s.paymon) as payym
			, s.paytype , s.amount , s.remark
			, s.spesta , s.paydt , u.user_name
			, s.createdt
			, f.id as fid
			, f.sta as fsta
			, fs.item as fitem
			, s.acctype
			, fs.rand_key as fskey
			from salary_spe s
			left join salary sa on ( s.payuserid=sa.userid )
			left join user u on (s.creator=u.user_id)
			left join salary_flow f on (f.salarykey=s.rand_key )
			left join salary_flow_step fs on (fs.salaryfid=f.id and ( fs.sta='0' or (fs.sta='1' and fs.res='no' ) ) )
			left join user u1 on (s.payuserid=u1.user_id)
			left join department d on (u1.dept_id=d.dept_id)
			where
			s.payuserid=sa.userid
			$sqlSch
			order by s.spesta asc , s.createdt desc, s.id , $sidx $sord
			limit $start , $limit ";
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			$fsta=$row['fitem'];
			if($row['fid']&&$row['fsta']!=''&&$row['fsta']!=3){
				$ck='yes';
				$fsta.='-δ��';
			}else{
				$ck='no';
			}
			$responce->rows[$i]['id'] = $row['userid'];
			$responce->rows[$i]['cell'] = un_iconv(
					array("", $row['rand_key'], $row['username'], $row['olddept']
						, $row['payym']
						, $this->speType[$row['paytype']]
						, $this->accType[$row['acctype']]
						, $this->salaryClass->decryptDeal($row['amount'])
						, $row['remark']
						, $this->userSpe[$row['spesta']]
						, $fsta
						, $row['paydt']
						, $row['user_name']
						, $row['createdt']
						, $ck
						, $row['fskey']
					     )
					);
			$i++;
		}
		return $responce;
	}
	/**
	 *
	 */
	function model_hr_spe_xls(){
		$seay=$_GET['sy'];
		$seam=$_GET['sm'];
		include( WEB_TOR . 'includes/classes/excel_out_class.php');
		$xls = new ExcelXML('gb2312', false, 'My Test Sheet');
		$data = array(1=> array ('���', 'Ա����', '����',  '��˾', 'Ŀǰֱ������', 'Ŀǰ����', '����ֱ������', '���²���','�·�'
					,'����','�Ƿ��˰', '���', '��ע','״̬')
			     );
		$xls->setStyle(array(4));
		if($seay!='-'){
			$sqlst.=" and payyear='".$seay."' ";
		}
		if($seam!='-'){
			$sqlst.=" and paymon='".$seam."' ";
		}
		$sql="select
			s.rand_key , u1.user_name as username , sa.userid , d.dept_name as olddept
			, concat(s.payyear,'-',s.paymon) as payym
			, s.paytype , s.amount , s.remark
			, s.spesta , s.paydt , s.acctype
			, s.createdt
			, dt.dept_name as dtname
			, u1.company ,h.usercard
			, td.dept_name as tdname
			, tdt.dept_name as tdtname
			from salary_spe s
			left join salary sa on ( s.payuserid=sa.userid )
			left join user u1 on (s.payuserid=u1.user_id)
			left join hrms h on (u1.user_id=h.user_id)
			left join department d on (u1.dept_id=d.dept_id)
			left join department dt on (dt.depart_x=left(d.depart_x,2))
			left join salary_pay p on (p.userid=s.payuserid and p.pyear=s.payyear and p.pmon=s.paymon)
			left join department td on (p.deptid=td.dept_id)
			left join department tdt on (tdt.depart_x=left(td.depart_x,2))
			where
			s.payuserid=sa.userid
			and p.userid=s.payuserid and p.pyear=s.payyear and p.pmon=s.paymon
			".$sqlst."
			order by s.spesta asc , s.createdt desc, s.id ";
		$query=$this->db->query($sql);
		$i=1;
		while($row=$this->db->fetch_array($query)){
			$data[]=array(
					$i,$row['usercard'],$row['username'] , $this->salaryCom[$row['company']] , $row['dtname'], $row['olddept']
					, $row['tdtname'], $row['tdname'] ,$row['payym']
					,$this->speType[$row['paytype']],$this->accType[$row['acctype']],$this->salaryClass->decryptDeal($row['amount'])
					,$row['remark'],$this->userSpe[$row['spesta']]
				     );
			$i++;
		}

		$xls->addArray($data);
		$xls->generateXML(time());
	}
	/**
	 * ���⴦��
	 */
	function model_hr_spe_in(){
		set_time_limit(600);
		$id = $_POST['id'];
		$type = $_POST['type'];
		$acctype = $_POST['acctype'];
		$amount = $_POST['amount'];
		$remark = $_POST['remark'];
		$sub = $_POST['sub'];
		$sm=false;
		try {
			$this->db->query("START TRANSACTION");
			if($sub=='submit'){
				$sql="select s.payuserid,h.userlevel,sp.usercom from salary_spe s left join hrms h on h.USER_ID = s.payuserid
					left join salary sp on sp.userid = h.user_id where s.rand_key='".$id."' ";
				$res=$this->db->get_one($sql);
				if(!$res['payuserid']){
					throw new Exception('no user id');
				}
				$sql="update salary_spe
					set
					paytype='".$type."'
					, amount='".$this->salaryClass->encryptDeal($amount)."'
					, remark='".$remark."'
					, createdt=now() , creator='".$_SESSION['USER_ID']."'
					, spesta='1'
					, acctype='".$acctype."'
					where rand_key='".$id."' ";
				$this->db->query_exc($sql);

				$flowname = $this->flowName['spe_'.$res['userlevel']];
				if($res['usercom'] == 'xs') {
					$flowname = $this->flowName['spe_xs_'.$res['userlevel']];
				}
				$info=array('flowname'=> $flowname
						,'userid'=>$res['payuserid']
						,'salarykey'=>$id
						,'changeam'=>0
						,'remark'=>$remark
					   );
				$sm=$this->model_flow_new($info);
			}
			if($sub=='edit'){//����Ƿ������޸�
				$sql="select
					count(*) , f.userid, h.userlevel ,s.usercom
					from
					salary_flow f
					left join hrms h on h.USER_ID = f.UserId left join salary s on u.user_id = s.userid 
					where
					f.salarykey='".$id."' and f.sta!=3
					and f.flowname in ('".$this->flowName['spe']."','".$this->flowName['spe_3']."','".$this->flowName['spe_5']."','".$this->flowName['spe_1']."','".$this->flowName['spe_0']."'
							,'".$this->flowName['spe_xs_3']."','".$this->flowName['spe_xs_5']."','".$this->flowName['spe_xs_1']."','".$this->flowName['spe_xs_0']."','".$this->flowName['spe_xs_12']."') group by f.salarykey";
				$resck=$this->db->get_one($sql);
				if($resck['count(*)']&&$resck['count(*)']==1){
					$sql="update salary_spe
						set
						paytype='".$type."'
						, amount='".$this->salaryClass->encryptDeal($amount)."'
						, remark='".$remark."'
						, createdt=now() , creator='".$_SESSION['USER_ID']."'
						, spesta='1'
						, acctype='".$acctype."'
						where rand_key='".$id."' ";
					$this->db->query_exc($sql);

					$sql="delete from
						salary_flow_step
						where
						salaryfid in (
								select f.id from salary_flow f where
								f.flowname in ('".$this->flowName['spe']."','".$this->flowName['spe_3']."','".$this->flowName['spe_5']."','".$this->flowName['spe_1']."','".$this->flowName['spe_0']."'
									,'".$this->flowName['spe_xs_3']."','".$this->flowName['spe_xs_5']."','".$this->flowName['spe_xs_1']."','".$this->flowName['spe_xs_0']."','".$this->flowName['spe_xs_12']."') and f.salarykey='".$id."'
							     ) ";
					$this->db->query_exc($sql);
					$sql="delete from
						salary_flow
						where 
						flowname in ('".$this->flowName['spe']."','".$this->flowName['spe_3']."','".$this->flowName['spe_5']."','".$this->flowName['spe_1']."','".$this->flowName['spe_0']."'
								,'".$this->flowName['spe_xs_3']."','".$this->flowName['spe_xs_5']."','".$this->flowName['spe_xs_1']."','".$this->flowName['spe_xs_0']."','".$this->flowName['spe_xs_12']."') and salarykey='".$id."' ";
					$this->db->query_exc($sql);
					$flowname = $this->flowName['spe_'.$resck['userlevel']];
					if($resck['usercom'] == 'xs') {
						$flowname = $this->flowName['spe_xs_'.$resck['userlevel']];
					}
					$info=array('flowname'=>$flowname
							,'userid'=>$resck['userid']
							,'salarykey'=>$id
							,'changeam'=>$this->salaryClass->encryptDeal($amount)
							,'remark'=>$remark
						   );
					$sm=$this->model_flow_new($info);

				}else{
					throw new Exception('Can not modify the data has been approved');
				}
			}
			if($sub=='handup'){
				$sql="select s.payuserid , s.amount,h.userlevel, sp.usercom from salary_spe s left join hrms h on h.USER_ID = s.payuserid left join salary sp on h.user_id = s.userid where s.rand_key='".$id."' ";
				$res=$this->db->get_one($sql);
				if(!$res['payuserid']){
					throw new Exception('no user id');
				}
				$sql="update salary_spe
					set
					createdt=now() , creator='".$_SESSION['USER_ID']."'
					, spesta='1'
					where rand_key='".$id."' ";
				$this->db->query_exc($sql);
				$flowname = $this->flowName['spe_'.$res['userlevel']];
				if($res['usercom'] == 'xs') {
					$flowname = $this->flowName['spe_xs_'.$res['userlevel']];
				}
				$info=array('flowname'=>$this->$flowname
						,'userid'=>$res['payuserid']
						,'salarykey'=>$id
						,'changeam'=>$res['amount']
						,'remark'=>$remark
					   );
				$sm=$this->model_flow_new($info);
			}
			if($sub=='back'){
				$sql="select s.payuserid,h.userlevel,sp.usercom from salary_spe s left join hrms h on h.USER_ID = s.payuserid left join salary sp on h.user_id = sp.userid where s.rand_key='".$id."' and s.spesta='2' ";
				$res=$this->db->get_one($sql);
				if(!$res['payuserid']){
					throw new Exception('no user id');
				}
				$sql="update salary_spe
					set
					paytype='".$type."'
					, amount='".$this->salaryClass->encryptDeal($amount)."'
					, remark='".$remark."'
					, createdt=now() , creator='".$_SESSION['USER_ID']."'
					, spesta='1'
					, acctype='".$acctype."'
					where rand_key='".$id."' ";
				$this->db->query_exc($sql);
				$sql="delete from
					salary_flow_step
					where
					salaryfid in (
							select f.id from salary_flow f where
							(f.flowname='".$this->flowName['spe_'.$res['userlevel']]."' or f.flowname='".$this->flowName['spe_xs_'.$res['userlevel']]."') and f.salarykey='".$id."'
						     ) ";
				$this->db->query_exc($sql);
				$sql="delete from
					salary_flow
					where
					flowname in ('".$this->flowName['spe']."','".$this->flowName['spe_3']."','".$this->flowName['spe_5']."','".$this->flowName['spe_1']."','".$this->flowName['spe_0']."'
							,'".$this->flowName['spe_xs_3']."','".$this->flowName['spe_xs_5']."','".$this->flowName['spe_xs_1']."','".$this->flowName['spe_xs_0']."','".$this->flowName['spe_xs_12']."') and salarykey='".$id."' ";
				$this->db->query_exc($sql);
				$flowname = $this->flowName['spe_'.$res['userlevel']];
				if($res['usercom'] == 'xs') {
					$flowname = $this->flowName['spe_xs_'.$res['userlevel']];
				}
				$info=array('flowname'=>$flowname
						,'userid'=>$res['payuserid']
						,'salarykey'=>$id
						,'changeam'=>$this->salaryClass->encryptDeal($amount)
						,'remark'=>$remark
					   );
				$sm=$this->model_flow_new($info);
			}
			if($sub=='del'){
				$sql="select h.userlevel from salary_spe s left join hrms h on h.USER_ID = s.payuserid where s.rand_key='".$id."'";
				$res=$this->db->get_one($sql);
				$sql="delete from salary_spe where rand_key='".$id."' ";
				$this->db->query_exc($sql);
				$sql="delete from
					salary_flow_step
					where
					salaryfid in (
							select f.id from salary_flow f where
							(f.flowname='".$this->flowName['spe_'.$res['userlevel']]."' or f.flowname='".$this->flowName['spe_xs_'.$res['userlevel']]."') and f.salarykey='".$id."'
						     ) ";
				$this->db->query_exc($sql);
				$sql="delete from
					salary_flow
					where
					(flowname='".$this->flowName['spe_'.$res['userlevel']]."' or flowname='".$this->flowName['spe_xs_'.$res['userlevel']]."') and salarykey='".$id."' ";
				$this->db->query_exc($sql);
			}
			if($sub=='new'){
				if(!$id||!trim($id)){
					throw new Exception('no user id');
				}
				if(!$_SESSION['USER_ID']){
					throw new Exception('time out');
				}
				$id=str_replace('haiyang,yang', 'haiyang-yang', $id);
				$tmpua=explode(',', $id);
				if(!empty($tmpua)){
					foreach($tmpua as $val){
						$val=$val=='haiyang-yang'?'haiyang,yang':$val;
						if(!$val||$val==''){
							continue;
						}
						$sql="select h.userlevel,s.usercom from hrms h inner join salary s on s.userid = h.user_id where h.USER_ID='".$val."'";
						$res=$this->db->get_one($sql);
						$spekey=get_rand_key();
						$sql="insert into salary_spe
							( payyear , paymon , amount
							  , payuserid , payuserna ,remark
							  , createdt , creator , spesta ,rand_key , paytype , acctype
							)
							select
							'".$this->nowy."' , '".$this->nowm."' , '".$this->salaryClass->encryptDeal($amount)."'
							, user_id , user_name , '".$remark."'
							, now() , '".$_SESSION['USER_ID']."' , 1 , '".$spekey."' ,'".$type."','".$acctype."'
							from user where user_id='".$val."' ";
						$flowname = $this->flowName['spe_'.$res['userlevel']];
						if($res['usercom'] == 'xs') {
							$flowname = $this->flowName['spe_xs_'.$res['userlevel']];
						}
						$info=array('flowname'=>$flowname
								,'userid'=>$val
								,'salarykey'=>$spekey
								,'changeam'=>$this->salaryClass->encryptDeal($amount)
								,'remark'=>$remark
							   );
						$sm[$val]=$this->model_flow_new($info);
					}
				}
			}
			$this->db->query("COMMIT");
			if(is_array($sm)){
				if(count($sm)){
					foreach($sm as $val){
						$body='���ã�<br><br>
							&nbsp;&nbsp;&nbsp;&nbsp;ϵͳ���й������ݣ�Ա�����⽱��/�۳�����Ҫ����������<br>
							&nbsp;&nbsp;&nbsp;&nbsp;����������'.$_SESSION["USER_NAME"].'�����ύ<br>
							лл��';
						$this->model_send_email('����--Ա�����⽱��/�۳�', $body, $val, false,true);
					}
				}
			}elseif($sm){
				$body='���ã�<br><br>
					&nbsp;&nbsp;&nbsp;&nbsp;ϵͳ���й������ݣ�Ա�����⽱��/�۳�����Ҫ����������<br>
					&nbsp;&nbsp;&nbsp;&nbsp;����������'.$_SESSION["USER_NAME"].'�����ύ<br>
					лл��';
				$this->model_send_email('����--Ա�����⽱��/�۳�', $body, $sm, false,true);
			}
			$responce->id = $id;
			$this->globalUtil->insertOperateLog('���ʹ���', $id, '���⽱��', '�ɹ�');
		} catch (Exception $e) {
			$this->db->query("ROLLBACK");
			$responce->error = $e->getMessage();
			$this->globalUtil->insertOperateLog('���ʹ���', $id, '���⽱��', 'ʧ��', $e->getMessage());
		}
		return $responce;
	}
	/**
	 * ������ϸ
	 */
	function model_hr_prod_list(){
		$page = $_GET['page'];
		$limit = $_GET['rows'];
		$sidx = $_GET['sidx'];
		$sord = $_GET['sord'];
		$schOper = $_GET['searchOper'];
		$schStr = $_GET['searchString'];
		$schField = $_GET['searchField'];
		$sqlSch = '';
		if ($schOper) {
			$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
		}
		$start = $limit * $page - $limit;
		//����
		$sql = "select count(*)
			from salary_prod s
			left join user u on (s.userid=u.user_id)
			left join department d on (u.dept_id=d.dept_id)
			where
			s.flaflag in ( '1' , '2' )
			and s.creator='".$_SESSION['USER_ID']."'
			$sqlSch ";
		$rs = $this->db->get_one($sql);
		$count = $rs['count(*)'];
		if ($count > 0) {
			$total_pages = ceil($count / $limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages){
			$page = $total_pages;
		}
		$i = 0;
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$sql="select
			s.rand_key , u.user_name as username , d.dept_name as olddept
			, concat(s.pyear,'-',s.pmon) as payym
			, s.ccxs , s.khxs
			, s.jjam , s.gljtam
			, s.qtjtam , s.jxzcam, s.lszsam
			, s.remark
			, s.flaflag
			, s.createdt
			, f.id as fid
			, f.sta as fsta
			, fs.item as fitem
			, fs.rand_key as fskey
			from salary_prod s
			left join salary_flow f on (f.salarykey=s.rand_key )
			left join salary_flow_step fs on (fs.salaryfid=f.id and ( fs.sta='0' or (fs.sta='1' and fs.res='no' ) ) )
			left join user u on (s.userid=u.user_id)
			left join department d on (u.dept_id=d.dept_id)
			where
			f.salarykey=s.rand_key and s.flaflag in ( '1' , '2' )
			and s.creator='".$_SESSION['USER_ID']."'
			$sqlSch
			group by s.id
			order by f.sta , $sidx $sord
			limit $start , $limit ";
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			$fsta=$this->flowSta[$row['fsta']];
			if($row['fid']&&$row['fsta']!=''&&$row['fsta']==0){
				$ck='yes';
				$fsta.='-δ��';
			}else{
				$ck='no';
			}
			$responce->rows[$i]['id'] = $row['userid'];
			$responce->rows[$i]['cell'] = un_iconv(
					array("", $row['rand_key'], $row['username'], $row['olddept']

						, $row['ccxs'] , $row['khxs']
						, $row['jjam'] , $row['gljtam']
						, $row['qtjtam'] , $row['jxzcam'], $row['lszsam']
						, $row['payym']
						, $row['remark']
						, $row['createdt']
						, $fsta
						, $ck
						, $row['fskey']
					     )
					);
			$i++;
		}
		return $responce;
	}

	/**
	 * �����ܱ�
	 */
	function model_hr_pro_list(){
		$page = $_GET['page'];
		$limit = $_GET['rows'];
		$sidx = $_GET['sidx'];
		$sord = $_GET['sord'];
		$schOper = $_GET['searchOper'];
		$schStr = $_GET['searchString'];
		$schField = $_GET['searchField'];

		$seapy = $_GET['seapy'];
		$seapm = $_GET['seapm'];
		$seaname = $_REQUEST['seaname'];;

		$sqlSch = '';

		if($seapy&&$seapy!='-'){
			$sqlSch.=" and s.pyear='".$seapy."' ";
		}
		if($seapm&&$seapm!='-'){
			$sqlSch.=" and s.pmon='".$seapm."' ";
		}
		if($seaname){
			$sqlSch.=" and s.username like '%".$seaname."%'  ";
		}

		$start = $limit * $page - $limit;
		//����
		$sql = "select count(1) from salary_pro s left join `user` u on s.userId = u.USER_ID left join 
			department d on u.DEPT_ID = d.DEPT_ID where 1 = 1
			$sqlSch ";
		$rs = $this->db->get_one($sql);
		$count = $rs['count(1)'];
		if ($count > 0) {
			$total_pages = ceil($count / $limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages){
			$page = $total_pages;
		}
		$i = 0;
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$sql="select d.pdeptname ,s.* from salary_pro s left join `user` u on s.userId = u.USER_ID left join 
			department d on u.DEPT_ID = d.DEPT_ID where 1 = 1 $sqlSch ";
		//��ҳ
		$sql = $sql."
			limit $start , $limit ";

		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {

			//�䶯�����ܶ�
			$bdgzze = round($this->salaryClass->decryptDeal($row['lszsAm']) + 
					$this->salaryClass->decryptDeal($row['txjt']) + 
					$this->salaryClass->decryptDeal($row['qtjtam']) + 
					$this->salaryClass->decryptDeal($row['jjAm']) + 
					$this->salaryClass->decryptDeal($row['gljtAm'])  , 2);
			//�������Ų���
			$expenCeiling = $this->salaryClass->decryptDeal($row['expenCeiling']);
			//�����ܶ�
			$gzze = round($bdgzze+$this->salaryClass->decryptDeal($row['baseam']) + $expenCeiling,2);

			//�ϸ�������
			$seapyb = $row['pYear'];
			$seapmb = $row['pMon'];

			//��ȡ��һ������
			if($seapmb == 1) {
				$seapmb = 12;
				$seapyb = $seapyb - 1;
			}else {
				$seapmb = $seapmb - 1;
			}
			//��ȡ��һ��������Ȼ������
			$monthDays = date("t",strtotime($seapyb."-".$seapmb));
			//��Ŀ����ϵ��=��Ͷ�빤����/ͳ������Ȼ������
			$xmcqxs = round($row['inWorkRate']/$monthDays,2);
			//����ϵ��=�¿����ܷ�/ͳ������Ȼ������
			$khxs = round($row['monthScore']/$row['inWorkRate'],2);

			$responce->rows[$i]['id'] = $row['id'];
			$responce->rows[$i]['cell'] = un_iconv(
					array("", $row['id']
						, $row['pdeptname']
						, $row['userCard']
						, $row['userName']
						, $row['pYear'] .'-'.$row['pMon']
						, $xmcqxs
						, $khxs
						, $this->salaryClass->decryptDeal($row['baseam'])
						, $this->salaryClass->decryptDeal($row['jjAm'])
						, $this->salaryClass->decryptDeal($row['gljtAm'])
						, $this->salaryClass->decryptDeal($row['lszsAm'])
						, $this->salaryClass->decryptDeal($row['txjt'])
						, $this->salaryClass->decryptDeal($row['qtjtam'])
						, $bdgzze
						, $gzze
						, $expenCeiling
						, $row['flaflag']
					     )
					);
			$i++;
		}
		return $responce;
	}

	/**
	 * �����ܱ��ӱ�
	 */
	function model_hr_pro_sub_list(){
		$pid = $_GET['id'];
		if($_GET['spid']) {
			$pid = $_GET['spid'];
		}
		// echo $sql;
		// echo ' fjeifhefe ';
		$sql="select sub.*,p.pYear,p.pMon from salary_pro_sub sub left join salary_pro p on p.id = sub.pid where sub.pid = '".$pid."'";
		// echo $sql;
		// die();
		$i = 0;
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			$responce->rows[$i]['id'] = $row['id'];

			//�ϸ�������
			$seapyb = $row['pYear'];
			$seapmb = $row['pMon'];

			//��ȡ��һ������
			if($seapmb == 1) {
				$seapmb = 12;
				$seapyb = $seapyb - 1;
			}else {
				$seapmb = $seapmb - 1;
			}
			//��ȡ��һ��������Ȼ������
			$monthDays = date("t",strtotime($seapyb."-".$seapmb));
			//��Ŀ����ϵ��=��Ͷ�빤����/ͳ������Ȼ������
			$xmcqxs = round($row['inWorkRate']/$monthDays,2);
			//����ϵ��=�¿����ܷ�/ͳ������Ȼ������
			$khxs = round($row['monthScore']/$row['inWorkRate'],2);

			$responce->rows[$i]['cell'] = un_iconv(
					array(    $row['projectCode']
						, $row['projectName'] , $xmcqxs
						, $khxs
						, $this->salaryClass->decryptDeal($row['jjAm'])
						, $this->salaryClass->decryptDeal($row['gljtAm'])
						, $this->salaryClass->decryptDeal($row['lszsAm']) , $this->salaryClass->decryptDeal($row['txjt'])
						, $this->salaryClass->decryptDeal($row['qtjtam']), $this->salaryClass->decryptDeal($row['expenCeiling'])
					     )
					);
			$i++;
		}
		return $responce;
	}
	/**
	 * ���²���
	 */
	function model_hr_sdy_list(){
		$page = $_GET['page'];
		$limit = $_GET['rows'];
		$sidx = $_GET['sidx'];
		$sord = $_GET['sord'];
		$schOper = $_GET['searchOper'];
		$schStr = $_GET['searchString'];
		$schField = $_GET['searchField'];
		$sqlSch = '';
		if ($schOper) {
			$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
		}
		$start = $limit * $page - $limit;
		//����
		$sql = "select count(*)
			from salary_sdy s
			left join user u on (s.userid=u.user_id)
			left join department d on (u.dept_id=d.dept_id)
			where
			s.flaflag in ( '1' , '2' )
			and s.creator='".$_SESSION['USER_ID']."'
			$sqlSch ";
		$rs = $this->db->get_one($sql);
		$count = $rs['count(*)'];
		if ($count > 0) {
			$total_pages = ceil($count / $limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages){
			$page = $total_pages;
		}
		$i = 0;
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$sql="select
			s.rand_key , u.user_name as username , d.dept_name as olddept
			, concat(s.pyear,'-',s.pmon) as payym
			, s.sdymeal , s.sdyother , s.remark
			, s.flaflag
			, s.createdt
			, f.id as fid
			, f.sta as fsta
			, fs.item as fitem
			, fs.rand_key as fskey
			from salary_sdy s
			left join salary_flow f on (f.salarykey=s.rand_key )
			left join salary_flow_step fs on (fs.salaryfid=f.id and ( fs.sta='0' or (fs.sta='1' and fs.res='no' ) ) )
			left join user u on (s.userid=u.user_id)
			left join department d on (u.dept_id=d.dept_id)
			where
			f.salarykey=s.rand_key and s.flaflag in ( '1' , '2' )
			and s.creator='".$_SESSION['USER_ID']."'
			$sqlSch
			group by s.id
			order by f.sta , $sidx $sord
			limit $start , $limit ";
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			$fsta=$this->flowSta[$row['fsta']];
			if($row['fid']&&$row['fsta']!=''&&$row['fsta']==0){
				$ck='yes';
				$fsta.='-δ��';
			}else{
				$ck='no';
			}
			$responce->rows[$i]['id'] = $row['userid'];
			$responce->rows[$i]['cell'] = un_iconv(
					array("", $row['rand_key'], $row['username'], $row['olddept']
						, $this->salaryClass->decryptDeal($row['sdymeal'])
						, $this->salaryClass->decryptDeal($row['sdyother'])
						, $row['payym']
						, $row['remark']
						, $row['createdt']
						, $fsta
						, $ck
						, $row['fskey']
					     )
					);
			$i++;
		}
		return $responce;
	}
	/**
	 * ���²����½�
	 */
	function model_hr_prod_new_in(){
		$id=$_POST['id'];
		$meal=$_POST['meal'];
		$other=$_POST['other'];
		$remark=$_POST['remark'];
		$sub=$_POST['sub'];
		$sm=array();
		try {
			$this->db->query("START TRANSACTION");
			if($sub=='del'){
				if(!$id||!trim($id)){
					throw new Exception('no user id');
				}
				if(!$_SESSION['USER_ID']){
					throw new Exception('time out');
				}
				$sql="select
					id , rand_key , flaflag
					from salary_prod
					where rand_key='".$id."' ";
				$res=$this->db->get_one($sql);
				if(empty($res)){
					throw new Exception('Data can not find');
				}
				if($res['flaflag']=='2'){
					throw new Exception('Information has been handled');
				}
				$sql="delete from salary_prod where rand_key='".$id."'";
				$this->db->query_exc($sql);
				$sql="delete from salary_flow where salarykey='".$id."' and flowname='".$this->flowName['prod']."' ";
				$this->db->query_exc($sql);
			}elseif($sub=='xls'){
				$temparr=array();
				$sql="select
					s.userid , p.id , s.remark , s.rand_key
					from salary_prod s
					left join salary_pay p on ( s.userid=p.userid and s.pyear=p.pyear and s.pmon=p.pmon )
					where
					s.creator='".$_SESSION['USER_ID']."'
					and s.pyear='".$this->nowy."' and s.pmon='".$this->nowm."'
					and s.staflag='1' and  flaflag='1' ";
				$query=$this->db->query($sql);
				while($row=$this->db->fetch_array($query)){
					$temparr[$row['rand_key']]['userid']=$row['userid'];
					$temparr[$row['rand_key']]['id']=$row['id'];
					$temparr[$row['rand_key']]['remark']=$row['remark'];
				}
				if(!empty($temparr)){
					foreach($temparr as $key=>$val){
						$sql="update salary_prod set staflag='0' where rand_key='".$key."' ";
						$this->db->query_exc($sql);
						$info=array('flowname'=>$this->flowName['prod']
								,'userid'=>$val['userid']
								,'salarykey'=>$key
								,'changeam'=>''
								,'remark'=>$val['remark']
							   );
						$sm[$key]=$this->model_flow_new($info,true,false);
					}
				}
			}elseif($sub=='back'){
				if(!$id||!trim($id)){
					throw new Exception('no user id');
				}
				if(!$_SESSION['USER_ID']){
					throw new Exception('time out');
				}
				$sql="select
					id , rand_key , userid , remark
					from salary_sdy
					where rand_key='".$id."' ";
				$res=$this->db->get_one($sql);
				if(empty($res)){
					throw new Exception('Data can not find');
				}
				$sql="delete from salary_flow where salarykey='".$id."' and flowname='".$this->flowName['sdyhr']."' ";
				$this->db->query_exc($sql);
				$sql="update salary_sdy
					set sdymeal='".$this->salaryClass->encryptDeal($meal)."'
					, sdyother='".$this->salaryClass->encryptDeal($other)."'
					, remark='".$remark."'
					where rand_key='".$id."' ";
				$this->db->query_exc($sql);
				$info=array('flowname'=>$this->flowName['sdyhr']
						,'userid'=>$res['userid']
						,'salarykey'=>$id
						,'changeam'=>''
						,'remark'=>$res['remark']
					   );
				$sm[$val]=$this->model_flow_new($info,true,false);
			}
			$responce->id = $id;
			$this->db->query("COMMIT");
			$this->globalUtil->insertOperateLog('���ʹ���', $id, '���²���', '�ɹ�');
		} catch (Exception $e) {
			$this->db->query("ROLLBACK");
			$responce->error = $e->getMessage();
			$this->globalUtil->insertOperateLog('���ʹ���', $id, '���²���', 'ʧ��',$e->getMessage());
		}
		return $responce;
	}

	/**
	 * ���²����½�
	 */
	function model_hr_sdy_new_in(){
		$id=$_POST['id'];
		$meal=$_POST['meal'];
		$other=$_POST['other'];
		$remark=$_POST['remark'];
		$sub=$_POST['sub'];
		$sm=array();
		try {
			$this->db->query("START TRANSACTION");
			if($sub=='new'){
				if(!$id||!trim($id)){
					throw new Exception('no user id');
				}
				if(!$_SESSION['USER_ID']){
					throw new Exception('time out');
				}
				$tmpua=explode(',', $id);
				$sql="select p.id , p.userid , h.userlevel
					from
					salary p
					left join hrms h on (p.userid=h.user_id)
					where
					p.userid in ('".implode("','", $tmpua)."') ";
				$query=$this->db->query($sql);
				$tmpua=array();
				while($row=$this->db->fetch_array($query)){
					$tmpua[$row['userid']]=$row['id'];
				}
				if(!empty($tmpua)){
					foreach($tmpua as $key=>$val){
						if(!$val||$val==''){
							continue;
						}
						$sdykey=get_rand_key();
						$sql="insert into salary_sdy
							( userid , sdymeal , sdyother , remark
							  , creator , createdt , pyear , pmon
							  , flaflag , rand_key
							)
							select
							user_id , '".$this->salaryClass->encryptDeal($meal)."' , '".$this->salaryClass->encryptDeal($other)."'
							, '".$remark."' , '".$_SESSION['USER_ID']."' , now() , '".$this->nowy."' , '".$this->nowm."'
							, '1' , '".$sdykey."'
							from user where user_id='".$key."' ";
						$this->db->query_exc($sql);
						$info=array('flowname'=>$this->flowName['sdyhr']
								,'userid'=>$key
								,'salarykey'=>$sdykey
								,'changeam'=>''
								,'meal'=>$meal,'other'=>$other
								,'remark'=>$remark
							   );
						$sm[$val]=$this->model_flow_new($info,true,false);
					}
				}
			}elseif($sub=='edit'){
				if(!$id||!trim($id)){
					throw new Exception('no user id');
				}
				if(!$_SESSION['USER_ID']){
					throw new Exception('time out');
				}
				$sql="select
					id , rand_key
					from salary_sdy
					where rand_key='".$id."' ";
				$res=$this->db->get_one($sql);
				if(empty($res)){
					throw new Exception('Data can not find');
				}
				$sql="update salary_sdy
					set sdymeal='".$this->salaryClass->encryptDeal($meal)."'
					, sdyother='".$this->salaryClass->encryptDeal($other)."'
					, remark='".$remark."'
					where rand_key='".$id."' ";
				$this->db->query_exc($sql);
			}elseif($sub=='del'){
				if(!$id||!trim($id)){
					throw new Exception('no user id');
				}
				if(!$_SESSION['USER_ID']){
					throw new Exception('time out');
				}
				$sql="select
					id , rand_key , flaflag
					from salary_sdy
					where rand_key='".$id."' ";
				$res=$this->db->get_one($sql);
				if(empty($res)){
					throw new Exception('Data can not find');
				}
				if($res['flaflag']=='2'){
					throw new Exception('Information has been handled');
				}
				$sql="delete from salary_sdy where rand_key='".$id."'";
				$this->db->query_exc($sql);
				$sql="delete from salary_flow where salarykey='".$id."' and flowname='".$this->flowName['sdyhr']."' ";
				$this->db->query_exc($sql);
			}elseif($sub=='xls'){
				$temparr=array();
				$sql="select
					s.userid , p.id , s.remark , s.rand_key,s.sdymeal,s.sdyother,h.userlevel,sp.usercom   
					from salary_sdy s
					left join salary_pay p on ( s.userid=p.userid and s.pyear=p.pyear and s.pmon=p.pmon ) 
					left join hrms h on h.USER_ID = s.UserId 
					where
					s.creator='".$_SESSION['USER_ID']."'
					and s.pyear='".$this->nowy."' and s.pmon='".$this->nowm."'
					and s.staflag='1' and  flaflag='1' ";
				$query=$this->db->query($sql);
				while($row=$this->db->fetch_array($query)){
					$temparr[$row['rand_key']]['userid']=$row['userid'];
					$temparr[$row['rand_key']]['id']=$row['id'];
					$temparr[$row['rand_key']]['remark']=$row['remark'];
					$temparr[$row['rand_key']]['sdymeal']=$row['sdymeal'];
					$temparr[$row['rand_key']]['sdyother']=$row['sdyother'];
					$temparr[$row['rand_key']]['userlevel']=$row['userlevel'];
				}
				if(!empty($temparr)){
					foreach($temparr as $key=>$val){
						$userleveltemp = empty($val['userlevel'])?'3':$val['userlevel'];
						$sql="update salary_sdy set staflag='0' where rand_key='".$key."' ";
						$this->db->query_exc($sql);

						$flowname = $this->flowName['sdyhr_'.$userleveltemp];
						if($val['usercom'] == 'xs') {
							$flowname = $this->flowName['sdyhr_xs_'.$userleveltemp];
						}
						$info=array('flowname'=> $flowname
								,'userid'=>$val['userid']
								,'salarykey'=>$key
								,'changeam'=>''
								,'meal'=>$this->salaryClass->decryptDeal($val['sdymeal']),'other'=>$this->salaryClass->decryptDeal($val['sdyother'])
								,'remark'=>$val['remark']
							   );
						$sm[$key]=$this->model_flow_new($info,true,false);
					}
				}
			}elseif($sub=='back'){
				if(!$id||!trim($id)){
					throw new Exception('no user id');
				}
				if(!$_SESSION['USER_ID']){
					throw new Exception('time out');
				}
				$sql="select
					s.id , s.rand_key , s.userid , s.remark, h.userlevel, s.usercom
					from salary_sdy s left join hrms h on h.USER_ID = s.UserId left join salary sp on h.user_id = sp.userid
					where rand_key='".$id."' ";
				$res=$this->db->get_one($sql);
				if(empty($res)){
					throw new Exception('Data can not find');
				}
				$userleveltemp = empty($res['userlevel'])?'3':$res['userlevel'];
				$sql="delete from salary_flow where salarykey='".$id."' and (flowname='".$this->flowName['sdyhr_'.$userleveltemp]."' or flowname='".$this->flowName['sdyhr_xs_'.$userleveltemp]."') ";
				$this->db->query_exc($sql);
				$sql="update salary_sdy
					set sdymeal='".$this->salaryClass->encryptDeal($meal)."'
					, sdyother='".$this->salaryClass->encryptDeal($other)."'
					, remark='".$remark."'
					where rand_key='".$id."' ";
				$this->db->query_exc($sql);
				$flowname = $this->flowName['sdyhr_'.$userleveltemp];
				if($res['usercom'] == 'xs') {
					$flowname = $this->flowName['sdyhr_'.$userleveltemp];
				}
				$info=array('flowname'=>$flowname
						,'userid'=>$res['userid']
						,'salarykey'=>$id
						,'changeam'=>''
						,'remark'=>$res['remark']
					   );
				$sm[$val]=$this->model_flow_new($info,true,false);
			}
			$responce->id = $id;
			$this->db->query("COMMIT");
			$this->globalUtil->insertOperateLog('���ʹ���', $id, '���²���', '�ɹ�');
		} catch (Exception $e) {
			$this->db->query("ROLLBACK");
			$responce->error = $e->getMessage();
			$this->globalUtil->insertOperateLog('���ʹ���', $id, '���²���', 'ʧ��',$e->getMessage());
		}
		return $responce;
	}
	/**
	 *������/�籣��
	 * @return <type>
	 */
	function model_hr_pay_list($outflag='list'){
		global $func_limit;
		$page = $_GET['page'];
		$limit = $_GET['rows'];
		$sidx = $_GET['sidx'];
		$sord = $_GET['sord'];
		$schOper = $_GET['searchOper'];
		$schStr = $_GET['searchString'];
		$schField = $_GET['searchField'];
		$sqlSch = '';
		if ($schOper) {
			$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
		}
		$seapy = $_GET['seapy']?$_GET['seapy']:$this->nowy;
		$seapm = $_GET['seapm']?$_GET['seapm']:$this->nowm;
		$seadept = $_REQUEST['seadept'];
		$seaname = $_REQUEST['seaname'];
		$seausercom = $_REQUEST['seausercom'];
		$seajfcom = $_REQUEST['seajfcom'];
		$seaexp = $_REQUEST['seaexp'];

		if($seapy&&$seapy!='-'){
			$sqlSch.=" and p.pyear='".$seapy."' ";
		}
		if($seapm&&$seapm!='-'){
			$sqlSch.=" and p.pmon='".$seapm."' ";
		}
		if($seadept){
			$sqlSch.=" and s.olddept like '%".$seadept."%' ";
		}
		if($seaname){
			$sqlSch.=" and ( s.username like '%".$seaname."%' or s.oldname like '%".$seaname."%' ) ";
		}
		if($seausercom){
			$sqlSch.=" and ( p.usercom='".$seausercom."' ) ";
		}if($seajfcom){
			$sqlSch.=" and ( p.jfcom='".$seajfcom."' ) ";
		}
		if(isset($seaexp)&&$seaexp!='-'){
			$sqlSch.=" and ( p.expflag='".$seaexp."' ) ";
		}

		$start = $limit * $page - $limit;
		//����
		$totalarr=array(
				'gjj'=>0,'shb'=>0,'cogjj'=>0,'coshb'=>0,'pre'=>0,'had'=>0,'man'=>0
			       );
		if($outflag=='list'){
			$sql="
				select s.rand_key ,p.gjjam , p.shbam
				, p.cogjjam , p.coshbam
				, p.prepaream , p.handicapam
				, p.manageam
				, p.expflag
				from salary s
				left join salary_pay p on (p.userid=s.userid)
				left join hrms h on (s.userid=h.user_id)
				where
				s.userid=h.user_id and p.userid=s.userid $sqlSch
				";
			$query=$this->db->query($sql);
			$count = $this->db->affected_rows();
			while($row=$this->db->fetch_array($query)){
				$totalarr['gjj']=$totalarr['gjj']+$this->salaryClass->decryptDeal($row['gjjam']);
				$totalarr['shb']=$totalarr['shb']+$this->salaryClass->decryptDeal($row['shbam']);
				$totalarr['cogjj']=$totalarr['cogjj']+$this->salaryClass->decryptDeal($row['cogjjam']);
				$totalarr['coshb']=$totalarr['coshb']+$this->salaryClass->decryptDeal($row['coshbam']);
				$totalarr['pre']=$totalarr['pre']+$this->salaryClass->decryptDeal($row['prepaream']);
				$totalarr['had']=$totalarr['had']+$this->salaryClass->decryptDeal($row['handicapam']);
				$totalarr['man']=$totalarr['man']+$this->salaryClass->decryptDeal($row['manageam']);
			}
			if ($count > 0) {
				$total_pages = ceil($count / $limit);
			} else {
				$total_pages = 0;
			}
			if ($page > $total_pages){
				$page = $total_pages;
			}
			$i = 0;
			$responce->page = $page;
			$responce->total = $total_pages;
			$responce->records = $count;
			$responce->userdata['amount'] = 'total:';
			$responce->userdata['gjjam'] = $this->salaryClass->cfv($totalarr['gjj']);
			$responce->userdata['shbam'] = $this->salaryClass->cfv($totalarr['shb']);
			$responce->userdata['cogjjam'] = $this->salaryClass->cfv($totalarr['cogjj']);
			$responce->userdata['coshbam'] = $this->salaryClass->cfv($totalarr['coshb']);
			$responce->userdata['prepaream'] = $this->salaryClass->cfv($totalarr['pre']);
			$responce->userdata['handicapam'] = $this->salaryClass->cfv($totalarr['had']);
			$responce->userdata['manageam'] = $this->salaryClass->cfv($totalarr['man']);
		}
		$mainsql="select
			s.rand_key , u1.user_name as username , s.userid , d.dept_name as olddept , h.userlevel
			, p.baseam , p.gjjam , p.shbam
			, p.cogjjam , p.coshbam
			, p.prepaream , p.handicapam
			, p.manageam
			, s.paycreatedt
			, u.user_name
			, h.expflag
			, p.usercom as company  , s.id as sid , h.usercard , p.jfcom , p.id as pid , p.pyear , p.pmon
			from salary s
			left join salary_pay p on (p.userid=s.userid)
			left join hrms h on ( s.userid=h.user_id )
			left join user u on (s.paycreator=u.user_id)
			left join user u1 on (s.userid=u1.user_id)
			left join department d on (p.deptid=d.dept_id)
			where
			s.userid=h.user_id and p.userid=s.userid
			$sqlSch
			";
		if($outflag=='list'){
			$sql=$mainsql."  order by $sidx $sord limit $start , $limit ";
		}elseif($outflag=='xls'){
			$sql=$mainsql."  order by s.id ";
		}
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			$compt=$row['company'];
			if($row['userlevel']=='4'||$func_limit['���²鿴�����']=='1'){
				$amount=$this->salaryClass->decryptDeal($row['baseam']);
			}else{
				$amount='-';
			}
			if($func_limit['������������']=='1'){
				$amount='-';
			}
			$gjjam=$this->salaryClass->decryptDeal($row['gjjam']);
			$shbam=$this->salaryClass->decryptDeal($row['shbam']);
			$coshb=$this->salaryClass->decryptDeal($row['coshbam']);
			$cogjj=$this->salaryClass->decryptDeal($row['cogjjam']);
			$pre=$this->salaryClass->decryptDeal($row['prepaream']);
			$had=$this->salaryClass->decryptDeal($row['handicapam']);
			$man=$this->salaryClass->decryptDeal($row['manageam']);

			if($outflag=='list'){
				$responce->rows[$i]['id'] = $row['userid'];
				$responce->rows[$i]['cell'] = un_iconv(
						array("", $row['rand_key'], $row['usercard'], $row['username'],$this->salaryCom[$compt], $row['olddept']
							, $this->expflag[$row['expflag']]
							,$this->salaryCom[$row['jfcom']]
							, $row['pyear'].'-'.$row['pmon']
							, $amount
							, $gjjam
							, $shbam
							, $cogjj
							, $coshb
							, $pre
							, $had
							, $man
							, $row['paycreatedt']
							, $row['user_name']
							, $row['pid']
							, $compt
						     )
						);
				$i++;
			}elseif($outflag=='xls'){
				$responce[] = un_iconv(
						array( $row['usercard'], $row['pyear'].'-'.$row['pmon'], $row['username'],$this->salaryCom[$compt], $row['olddept']
							, $this->expflag[$row['expflag']]
							,$this->salaryCom[$row['jfcom']]
							, $amount
							, $gjjam
							, $shbam
							, $cogjj
							, $coshb
							, $pre
							, $had
							, $man
						     )
						);
			}
		}
		return $responce;
	}
	/**
	 * ������/�籣�Ѵ���
	 */
	function model_hr_pay_in(){
		$id = $_POST['id'];
		$gjjam = round($_POST['gjjam'],2);
		$shbam = round($_POST['shbam'],2);
		$cogjjam = round($_POST['cogjjam'],2);
		$coshbam = round($_POST['coshbam'],2);
		$prepaream = round($_POST['prepaream'],2);
		$handicapam = round($_POST['handicapam'],2);
		$manageam = round($_POST['manageam'],2);
		$usercom = $_POST['usercom'];
		$jfcom = $_POST['jfcom'];
		$pid = $_POST['pid'];
		//$this->nowm=6;
		try {
			$this->db->query("START TRANSACTION");
			//$comtable=$this->get_com_sql($usercom);
			$sql="select
				p.id , s.userid  , s.rand_key as skey
				from salary s
				left join salary_pay p on ( s.userid=p.userid  )
				where s.rand_key='".$id."' and p.id='".$pid."' and s.userid=p.userid ";
			$res=$this->db->get_one($sql);
			if(!$res['userid']){
				throw new Exception('no data');
			}
			if(!$res['id']){
				throw new Exception('no pid ');
			}
			if($res['id']){
				$this->model_salary_update($id,
						array('paycreatedt'=>'now()','paycreator'=>$_SESSION['USER_ID'],'jfcom'=>$jfcom
							,'gjjam' => $gjjam, 'shbam' => $shbam
							,'prepaream'=>$prepaream,'handicapam'=>$handicapam,'manageam'=>$manageam
							,'cogjjam'=>$cogjjam , 'coshbam'=>$coshbam ),array(0,1,2)
						);
				$this->model_pay_update($res['id'],
						array('jfcom'=>$jfcom,'gjjam' => $gjjam, 'shbam' => $shbam
							,'prepaream'=>$prepaream,'handicapam'=>$handicapam,'manageam'=>$manageam
							,'cogjjam'=>$cogjjam , 'coshbam'=>$coshbam ),array(0)
						);
				$this->model_pay_stat($res['id']);
			}
			$this->db->query("COMMIT");
			$responce->id = $id;
			$this->globalUtil->insertOperateLog('���ʹ���', $id, '�ɷ���Ϣ', '�ɹ�',json_encode($_POST));
		} catch (Exception $e) {
			$this->db->query("ROLLBACK");
			$responce->error = $e->getMessage();
			$this->globalUtil->insertOperateLog('���ʹ���', $id, '�ɷ���Ϣ', 'ʧ��', json_encode($_POST));
		}
		return $responce;
	}
	function model_hr_jf_ini($ckt){
		set_time_limit(600);
		$infoE=array();
		//
		//        $filename = $_FILES ["ctr_file"] ["name"];
		//        $temp_name = $_FILES ["ctr_file"] ["tmp_name"];
		//        $fileType = $_FILES ["ctr_file"] ["type"];
		//        if ($fileType == "application/vnd.ms-excel" || $fileType == "application/octet-stream") {
		//            $excelData = util_excelUtil::upReadExcelDataClear ( $filename, $temp_name );
		//        }
		//
		//        print_r($excelData);
		//        /*

		$excelfilename='attachment/xls_model/temp/'.$ckt.".xls";
		if(empty ($_FILES["ctr_file"]["tmp_name"])){
			$str='<tr><td colspan="16">�뵼�����ݣ�</td></tr>';
		}elseif (!move_uploaded_file( $_FILES["ctr_file"]["tmp_name"], $excelfilename) ){
			$str='<tr><td colspan="16">�ϴ�ʧ�ܣ�</td></tr>';
		}else{
			//��ȡexcel��Ϣ
			include('includes/classes/excel.php');
			$excel = Excel::getInstance();
			$excel->setFile(WEB_TOR.$excelfilename);
			$excel->Open();
			$excel->setSheet();
			$excelFields = $excel->getFields();
			$excelArr=$excel->getAllData();
			$excel->Close();
			foreach($excelArr['Ա����'] as $key=>$val ){
				$infoE[$val]['name']=$excelArr['����'][$key];
				$infoE[$val]['com']=trim($excelArr['��˾'][$key]);
				$infoE[$val]['dept']=trim($excelArr['����'][$key]);
				$infoE[$val]['pym']=trim($excelArr['�·�'][$key]);
				$infoE[$val]['cogjjam']=trim($excelArr['��˾������'][$key]);
				$infoE[$val]['coshbam']=trim($excelArr['��˾�籣��'][$key]);
			}
			if(count($infoE)){
				$i=1;
				foreach($infoE as $key=>$val){
					$cl='green';
					$str.='<tr style="color:'.$cl.'">
						<td>'.$i.'</td>
						<td>'.$key.'</td>
						<td>'.$val['name'].'</td>
						<td>'.$val['com'].'</td>
						<td>'.$val['dept'].'</td>
						<td>'.$val['pym'].'</td>
						<td>'.$val['cogjjam'].'</td>
						<td>'.$val['coshbam'].'</td>
						</tr>';
					$i++;
				}
			}
		}
		return $str;
	}
	function model_hr_jf_ini_in(){
		set_time_limit(600);
		$ckt=$_POST['ckt'];
		try{
			$excelfilename='attachment/xls_model/temp/'.$ckt.".xls";
			if(!file_exists($excelfilename)){
				throw new Exception('File does not exist');
			}else{
				//��ȡexcel��Ϣ
				include('includes/classes/excel.php');
				$excel = Excel::getInstance();
				$excel->setFile(WEB_TOR.$excelfilename);
				$excel->Open();
				$excel->setSheet();
				$excelFields = $excel->getFields();
				$excelArr=$excel->getAllData();
				$excel->Close();
				foreach($excelArr['Ա����'] as $key=>$val ){
					$infoE[$val]['name']=$excelArr['����'][$key];
					$infoE[$val]['com']=trim($excelArr['��˾'][$key]);
					$infoE[$val]['dept']=trim($excelArr['����'][$key]);
					$infoE[$val]['pym']=trim($excelArr['�·�'][$key]);
					$infoE[$val]['cogjjam']=trim($excelArr['��˾������'][$key]);
					$infoE[$val]['coshbam']=trim($excelArr['��˾�籣��'][$key]);
				}
				if(count($infoE)){
					foreach($infoE as $key=>$val){
						$pym=  explode('-', $val['pym']);
						$sql="update  salary_pay p
							left join hrms h on (h.user_id=p.userid)
							set p.cogjjam='".$this->salaryClass->encryptDeal($val['cogjjam'])."'
							, p.coshbam='".$this->salaryClass->encryptDeal($val['coshbam'])."'
							where h.usercard='".$key."'
							and p.pyear=".$pym[0]." and p.pmon=".$pym[1]." ";
						$query=$this->db->query_exc($sql);
					}
				}
			}
		}catch(Exception $e){
			return $e->getMessage();
		}

	}
	/**
	 *�Ա�����
	 * @return string
	 */
	function model_pay_ctr($ckt){
		set_time_limit(600);
		$type=$_POST['ctr_type'];
		$compt=$_POST['ctr_com'];
		$sqlCk=$type=='com'?'0':'1';
		$str='';
		$infoE=array();
		$infoR=array();
		$infoA=array();
		$pyear=$_POST['ctr_py'];
		$pmon=$_POST['ctr_pm'];
		$comtable=$this->get_com_sql($compt);
		$comarr=array_flip($this->salaryCom);
		try{
			$sql="delete from salary_temp where code in ('gjjam','shbam','prepaream' , 'handicapam' , 'manageam' , 'cogjjam' , 'coshbam' ,'jfcom') ";
			$this->db->query_exc($sql);
			$excelfilename='attachment/xls_model/hr_ctr/'.$ckt.".xls";
			if(empty ($_FILES["ctr_file"]["tmp_name"])){
				$str='<tr><td colspan="16">�뵼��Ա����ݣ�</td></tr>';
			}elseif (!move_uploaded_file( $_FILES["ctr_file"]["tmp_name"], $excelfilename) ){
				$str='<tr><td colspan="16">�ϴ�ʧ�ܣ�</td></tr>';
			}else{
				//��ȡexcel��Ϣ
				include('includes/classes/excel.php');
				$excel = Excel::getInstance();
				$excel->setFile(WEB_TOR.$excelfilename);
				$excel->Open();
				$excel->setSheet();
				$excelFields = $excel->getFields();
				$excelArr=$excel->getAllData();
				$excel->Close();
				if(!in_array('Ա��', $excelFields)||!in_array('Ա����', $excelFields)
						||!in_array('������', $excelFields)||!in_array('�籣��', $excelFields)||!in_array('�ɸ���˾', $excelFields)){
					throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
				}
				if(count($excelArr)){
					foreach($excelArr['Ա����'] as $key=>$val ){
						if($type=='com'){
							if(!is_numeric($excelArr['������'][$key])||!is_numeric($excelArr['�籣��'][$key])){
								throw new Exception('����������Ϣ���зǷ����ݣ�'.$val);
							}
							$infoE[$val]['name']=$excelArr['Ա��'][$key];
							$infoE[$val]['gjjam']=trim($excelArr['������'][$key]);
							$infoE[$val]['shbam']=trim($excelArr['�籣��'][$key]);
							$infoE[$val]['cogjjam']=trim($excelArr['��˾������'][$key]);
							$infoE[$val]['coshbam']=trim($excelArr['��˾�籣��'][$key]);
							$infoE[$val]['pre']=trim($excelArr['�����'][$key]);
							$infoE[$val]['had']=trim($excelArr['���Ͻ�'][$key]);
							$infoE[$val]['man']=trim($excelArr['�����'][$key]);
							$infoE[$val]['jfcom']=$comarr[trim($excelArr['�ɸ���˾'][$key])];
							$infoE[$val]['jfcomname']=trim($excelArr['�ɸ���˾'][$key]);
						}else{
							if(
									!is_numeric($excelArr['������'][$key])||!is_numeric($excelArr['�籣��'][$key])
									||!is_numeric($excelArr['��˾������'][$key])||!is_numeric($excelArr['��˾�籣��'][$key])
							  ){
								throw new Exception('����������Ϣ���зǷ����ݣ�mz');
							}
							$infoE[$val]['name']=$excelArr['Ա��'][$key];
							$infoE[$val]['gjjam']=trim($excelArr['������'][$key]);
							$infoE[$val]['shbam']=trim($excelArr['�籣��'][$key]);
							$infoE[$val]['cogjjam']=trim($excelArr['��˾������'][$key]);
							$infoE[$val]['coshbam']=trim($excelArr['��˾�籣��'][$key]);
							$infoE[$val]['pre']=trim($excelArr['�����'][$key]);
							$infoE[$val]['had']=trim($excelArr['���Ͻ�'][$key]);
							$infoE[$val]['man']=trim($excelArr['�����'][$key]);
							$infoE[$val]['jfcom']=$comarr[trim($excelArr['�ɸ���˾'][$key])];
							$infoE[$val]['jfcomname']=trim($excelArr['�ɸ���˾'][$key]);
						}
					}
				}
				$sql="select
					s.username , s.userid , p.gjjam , p.shbam
					, p.prepaream , p.handicapam , p.manageam
					, h.expflag , h.usercard as idcard
					, p.cogjjam , p.coshbam , p.jfcom
					from
					salary s
					left join  salary_pay p on (s.userid=p.userid and p.pyear='".$pyear."'  and p.pmon='".$pmon."' )
					left join hrms h on(s.userid=h.user_id)
					where s.usercom='".$compt."' ";
				$query=$this->db->query_exc($sql);
				while($row=$this->db->fetch_array($query)){
					$infoA[]=$row['idcard'];
					$gjj=$this->salaryClass->decryptDeal($row['gjjam']);
					$shb=$this->salaryClass->decryptDeal($row['shbam']);
					$cogjj=$this->salaryClass->decryptDeal($row['cogjjam']);
					$coshb=$this->salaryClass->decryptDeal($row['coshbam']);
					if($sqlCk=='1'){
						$pre=$this->salaryClass->decryptDeal($row['prepaream']);
						$had=$this->salaryClass->decryptDeal($row['handicapam']);
						$man=$this->salaryClass->decryptDeal($row['manageam']);
					}else{
						$pre=$this->salaryClass->decryptDeal($row['prepaream']);
						$had=$this->salaryClass->decryptDeal($row['handicapam']);
						$man=$this->salaryClass->decryptDeal($row['manageam']);
					}
					$jfcom=$row['jfcom'];
					if(array_key_exists($row['idcard'],$infoE)){//���б���
						if(($gjj==''||$gjj==0)
								&&($shb==''||$shb==0)
								&&($pre==''||$pre==0)
								&&($had==''||$had==0)
								&&($man==''||$man==0)
								&&($cogjj==''||$cogjj==0)
								&&($coshb==''||$coshb==0)
								&&($infoE[$row['idcard']]['cogjjam']==''||$infoE[$row['idcard']]['cogjjam']==0)
								&&($infoE[$row['idcard']]['coshbam']==''||$infoE[$row['idcard']]['coshbam']==0)
								&&($infoE[$row['idcard']]['gjjam']==''||$infoE[$row['idcard']]['gjjam']==0)
								&&($infoE[$row['idcard']]['shbam']==''||$infoE[$row['idcard']]['shbam']==0)
								&&($infoE[$row['idcard']]['pre']==''||$infoE[$row['idcard']]['pre']==0)
								&&($infoE[$row['idcard']]['had']==''||$infoE[$row['idcard']]['had']==0)
								&&($infoE[$row['idcard']]['man']==''||$infoE[$row['idcard']]['man']==0) ){
							continue;
						}
						if(floatval($gjj)!=floatval($infoE[$row['idcard']]['gjjam'])
								||floatval($shb)!=floatval($infoE[$row['idcard']]['shbam'])
								||floatval($cogjj)!=floatval($infoE[$row['idcard']]['cogjjam'])
								||floatval($coshb)!=floatval($infoE[$row['idcard']]['coshbam'])
								||floatval($pre)!=floatval($infoE[$row['idcard']]['pre'])
								||floatval($had)!=floatval($infoE[$row['idcard']]['had'])
								||floatval($man)!=floatval($infoE[$row['idcard']]['man'])
								||($jfcom)!=($infoE[$row['idcard']]['jfcom'])){
							$infoR[$row['idcard']]['name']=$row['username'];
							$infoR[$row['idcard']]['gjj']=$gjj;
							$infoR[$row['idcard']]['shb']=$shb;
							$infoR[$row['idcard']]['pre']=$pre;
							$infoR[$row['idcard']]['had']=$had;
							$infoR[$row['idcard']]['man']=$man;
							$infoR[$row['idcard']]['gjjex']=$infoE[$row['idcard']]['gjjam'];
							$infoR[$row['idcard']]['shbex']=$infoE[$row['idcard']]['shbam'];
							$infoR[$row['idcard']]['preex']=$infoE[$row['idcard']]['pre'];
							$infoR[$row['idcard']]['hadex']=$infoE[$row['idcard']]['had'];
							$infoR[$row['idcard']]['manex']=$infoE[$row['idcard']]['man'];
							$infoR[$row['idcard']]['type']=0;
							$infoR[$row['idcard']]['cogjj']=$cogjj;
							$infoR[$row['idcard']]['coshb']=$coshb;
							$infoR[$row['idcard']]['cogjjex']=$infoE[$row['idcard']]['cogjjam'];
							$infoR[$row['idcard']]['coshbex']=$infoE[$row['idcard']]['coshbam'];
							$infoR[$row['idcard']]['jfcom']=$jfcom;
							$infoR[$row['idcard']]['jfcomx']=$infoE[$row['idcard']]['jfcom'];
						}
					}else{
						if(($gjj==''||$gjj==0)&&($shb==''||$shb==0)&&($pre==''||$pre==0)
								&&($had==''||$had==0)
								&&($man==''||$man==0)&&($cogjj==''||$cogjj==0)&&($coshb==''||$coshb==0)){
							continue;
						}
						$infoR[$row['idcard']]['name']=$row['username'];
						$infoR[$row['idcard']]['gjj']=$gjj;
						$infoR[$row['idcard']]['shb']=$shb;
						$infoR[$row['idcard']]['pre']=$pre;
						$infoR[$row['idcard']]['had']=$had;
						$infoR[$row['idcard']]['man']=$man;
						$infoR[$row['idcard']]['gjjex']='0';
						$infoR[$row['idcard']]['shbex']='0';
						$infoR[$row['idcard']]['preex']='0';
						$infoR[$row['idcard']]['hadex']='0';
						$infoR[$row['idcard']]['manex']='0';
						$infoR[$row['idcard']]['type']=1;
						$infoR[$row['idcard']]['cogjj']=$cogjj;
						$infoR[$row['idcard']]['coshb']=$coshb;
						$infoR[$row['idcard']]['cogjjex']='0';
						$infoR[$row['idcard']]['coshbex']='0';
						$infoR[$row['idcard']]['jfcom']=$jfcom;
						$infoR[$row['idcard']]['jfcomx']=$jfcom;
					}
				}
				if(count($infoE)){
					foreach($infoE as $key=>$val){
						if(!in_array($key,$infoA)){
							$infoR[$key]['name']=$val['name'];
							$infoR[$key]['gjj']=0;
							$infoR[$key]['shb']=0;
							$infoR[$key]['pre']=0;
							$infoR[$key]['had']=0;
							$infoR[$key]['man']=0;
							$infoR[$key]['gjjex']=$val['gjjam'];
							$infoR[$key]['shbex']=$val['shbam'];
							$infoR[$key]['preex']=$val['pre'];
							$infoR[$key]['hadex']=$val['had'];
							$infoR[$key]['manex']=$val['man'];
							$infoR[$key]['type']=2;
							$infoR[$key]['cogjj']=0;
							$infoR[$key]['coshb']=0;
							$infoR[$key]['cogjjex']=$val['cogjjam'];
							$infoR[$key]['coshbex']=$val['coshbam'];
							$infoR[$key]['jfcom']=$val['jfcom'];
							$infoR[$key]['jfcomx']=$val['jfcom'];
						}
					}
				}

				$this->db->query("START TRANSACTION");
				if(count($infoR)){
					foreach($infoR as $key=>$val){
						if($val['type']=='0'){
							$cl='blue';
						}elseif($val['type']=='1'){
							$cl='green';
						}elseif($val['type']=='2'){
							$cl='#000000';
						}
						$str.='<tr style="color:'.$cl.'">
							<td>'.$val['name'].'</td>
							<td>'.$key.'</td>
							<td style="background-color: #FFE573">'.$this->salaryCom[$val['jfcomx']].'</td>
							<td>'.$this->salaryCom[$val['jfcom']].'</td>
							<td style="background-color: #FFE573">'.$val['gjjex'].'</td>
							<td>'.$val['gjj'].'</td>
							<td style="background-color: #FFE573">'.$val['shbex'].'</td>
							<td>'.$val['shb'].'</td>
							<td style="background-color: #FFE573">'.$val['cogjjex'].'</td>
							<td>'.$val['cogjj'].'</td>
							<td style="background-color: #FFE573">'.$val['coshbex'].'</td>
							<td>'.$val['coshb'].'</td>
							<td style="background-color: #FFE573">'.$val['preex'].'</td>
							<td>'.$val['pre'].'</td>
							<td style="background-color: #FFE573">'.$val['hadex'].'</td>
							<td>'.$val['had'].'</td>
							<td style="background-color: #FFE573">'.$val['manex'].'</td>
							<td>'.$val['man'].'</td>
							</tr>';
						if(($val['type']=='0'||$val['type']=='1')&&$key){
							if($val['gjj']!=$val['gjjex']){
								$sql="insert into salary_temp ( idcard , code , amount , type , creator , tmpexp   )
									values ( '".$key."' , 'gjjam' , '".$val['gjjex']."' , 'salary' ,'".$_SESSION['USER_ID']."' , '".$sqlCk."'
									       )";
								$this->db->query_exc($sql);
							}
							if($val['shb']!=$val['shbex']){
								$sql="insert into salary_temp ( idcard , code , amount , type , creator , tmpexp )
									values ( '".$key."' , 'shbam' , '".$val['shbex']."' , 'salary' ,'".$_SESSION['USER_ID']."' , '".$sqlCk."'
									       )";
								$this->db->query_exc($sql);
							}
							if($val['pre']!=$val['preex']){
								$sql="insert into salary_temp ( idcard , code , amount , type , creator , tmpexp )
									values ( '".$key."' , 'prepaream' , '".$val['preex']."' , 'salary' ,'".$_SESSION['USER_ID']."', '".$sqlCk."'
									       )";
								$this->db->query_exc($sql);
							}
							if($val['had']!=$val['hadex']){
								$sql="insert into salary_temp ( idcard , code , amount , type , creator , tmpexp )
									values ( '".$key."' , 'handicapam' , '".$val['hadex']."' , 'salary' ,'".$_SESSION['USER_ID']."', '".$sqlCk."'
									       )";
								$this->db->query_exc($sql);
							}
							if($val['man']!=$val['manex']){
								$sql="insert into salary_temp ( idcard , code , amount , type , creator , tmpexp )
									values ( '".$key."' , 'manageam' , '".$val['manex']."' , 'salary' ,'".$_SESSION['USER_ID']."', '".$sqlCk."'
									       )";
								$this->db->query_exc($sql);
							}
							if($val['cogjj']!=$val['cogjjex']){
								$sql="insert into salary_temp ( idcard , code , amount , type , creator , tmpexp )
									values ( '".$key."' , 'cogjjam' , '".$val['cogjjex']."' , 'salary' ,'".$_SESSION['USER_ID']."' , '".$sqlCk."'
									       )";
								$this->db->query_exc($sql);
							}
							if($val['coshb']!=$val['coshbex']){
								$sql="insert into salary_temp ( idcard , code , amount , type , creator , tmpexp )
									values ( '".$key."' , 'coshbam' , '".$val['coshbex']."' , 'salary' ,'".$_SESSION['USER_ID']."' , '".$sqlCk."'
									       )";
								$this->db->query_exc($sql);
							}
							if($val['jfcom']!=$val['jfcomx']){
								$sql="insert into salary_temp ( idcard , code , jfcom , type , creator , tmpexp )
									values ( '".$key."' , 'jfcom' , '".$val['jfcomx']."' , 'salary' ,'".$_SESSION['USER_ID']."' , '".$sqlCk."'
									       )";
								$this->db->query_exc($sql);
							}
						}
					}
				}
				$this->db->query("COMMIT");

			}
			if(empty($str)){
				$str='<tr><td colspan="16">�������ݺ�OA���ݺ˶���ȷ�������޸ģ�</td></tr>';
			}
		}catch(Exception $e){
			$this->db->query("ROLLBACK");
			$str='<tr><td colspan="16">�������ݴ���'.$e->getMessage().'</td></tr>';
		}
		return $str;
	}
	/**
	 *�ɷѸ��¶Ա�����
	 * @return <type>
	 */
	function model_hr_pay_ctr_in(){
		try {
			//print_r($_POST);
			$ckyear=$_POST['cky'];
			$ckmon=$_POST['ckm'];
			$ckcom=$_POST['ckc'];
			if(empty($ckyear)||empty($ckmon)||empty($ckcom)){
				throw new Exception('data error');
			}
			$info=array();
			$comtable=$this->get_com_sql($ckcom);
			$this->db->query("START TRANSACTION");
			$sql="select
				p.id , s.rand_key , t.code , t.amount , s.userid
				, t.id as tmpid , t.jfcom
				from salary_temp t
				left join hrms h on (t.idcard=h.usercard)
				left join salary s on ( s.userid=h.user_id )
				left join user u on (u.user_id=s.userid)
				left join salary_pay p on (s.userid=p.userid and p.pyear='".$ckyear."' and p.pmon='".$ckmon."' )
				where s.userid=p.userid and  t.code in ('gjjam','shbam','prepaream','handicapam','manageam','cogjjam','coshbam','jfcom') ";
			$query=$this->db->query_exc($sql);
			if(!$this->db->affected_rows()){
				throw new Exception('No updated data');
			}
			while($row=$this->db->fetch_array($query)){
				$info[$row['tmpid']][$row['code']]=($row['code']=='jfcom'?$row['jfcom']:$row['amount']);
				$info[$row['tmpid']]['pid']=$row['id'];
				$info[$row['tmpid']]['skey']=$row['rand_key'];
			}
			if(count($info)&&!empty($info)){
				foreach($info as $key=>$val){

					if(!empty($val['pid'])){
						if(!empty($val['jfcom'])){
							$arrtemp=array('paycreatedt'=>'now()','paycreator'=>$_SESSION['USER_ID'],'jfcom'=>$val['jfcom']);
							$sp=array(0,1,2);
							$arrtempp=array('jfcom'=>$val['jfcom']);
							$spp=array(0);
						}else{
							$arrtemp=array('paycreatedt'=>'now()','paycreator'=>$_SESSION['USER_ID']);
							$sp=array(0,1);
							$arrtempp=array();
							$spp=array();
							foreach($val as $vkey=>$vval){
								if($vkey!='pid'&&$vkey!='skey'){
									$arrtemp[$vkey]=$vval;
									$arrtempp[$vkey]=$vval;
								}
							}
						}

						if($val['pid']){
							$this->model_salary_update($val['skey'],
									$arrtemp,$sp
									);
							$this->model_pay_update($val['pid'],
									$arrtempp,$spp
									);
							$this->model_pay_stat($val['pid']);
						}
					}
				}
			}
			$this->db->query("COMMIT");
			$responce->id = $id;
			$this->globalUtil->insertOperateLog('���ʹ���', $id, '�ɷ���Ϣ', '�ɹ�');
		} catch (Exception $e) {
			$this->db->query("ROLLBACK");
			$responce->error = $e->getMessage();
			$this->globalUtil->insertOperateLog('���ʹ���', $id, '�ɷ���Ϣ', 'ʧ��', $e->getMessage());
		}
		return $responce;
	}
	/**
	 *
	 */
	function model_hr_exp_ini($ckt){
		set_time_limit(600);
		$type=$_POST['ctr_type'];
		$sqlCk=$type=='com'?'0':'1';
		$str='';
		$infoE=array();
		try{
			$sql="delete from salary_temp where code = 'amount' and creator='".$_SESSION['USER_ID']."' ";
			$this->db->query_exc($sql);
			$excelfilename='attachment/xls_model/exp_ini/'.$ckt.".xls";
			if(empty ($_FILES["ctr_file"]["tmp_name"])){
				$str='<tr><td colspan="10">�뵼�����ɳ�ʼ�����ݱ�</td></tr>';
			}elseif (!move_uploaded_file( $_FILES["ctr_file"]["tmp_name"], $excelfilename) ){
				$str='<tr><td colspan="10">�ϴ�ʧ�ܣ�</td></tr>';
			}else{
				//��ȡexcel��Ϣ
				include('includes/classes/excel.php');
				$excel = Excel::getInstance();
				$excel->setFile(WEB_TOR.$excelfilename);
				$excel->Open();
				$excel->setSheet();
				$excelFields = $excel->getFields();
				$excelArr=$excel->getAllData();
				$excel->Close();
				if(!in_array('Ա��', $excelFields)||!in_array('Ա����', $excelFields)
						||!in_array('��������', $excelFields)||!in_array('���˹�����', $excelFields)
						||!in_array('�����籣��', $excelFields)||!in_array('��˾������', $excelFields)
						||!in_array('��˾�籣��', $excelFields)||!in_array('�����', $excelFields)
						||!in_array('���Ͻ�', $excelFields)||!in_array('�����', $excelFields))
				{
					throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
				}
				if(count($excelArr)&&!empty($excelArr)){
					foreach($excelArr['Ա����'] as $key=>$val ){
						$infoE[$val]['name']=$excelArr['Ա��'][$key];
						$infoE[$val]['amount']=$excelArr['��������'][$key];
						$infoE[$val]['gjjam']=$excelArr['���˹�����'][$key];
						$infoE[$val]['shbam']=$excelArr['�����籣��'][$key];
						$infoE[$val]['cogjjam']=$excelArr['��˾������'][$key];
						$infoE[$val]['coshbam']=$excelArr['��˾�籣��'][$key];
						$infoE[$val]['prepaream']=$excelArr['�����'][$key];
						$infoE[$val]['handicapam']=$excelArr['���Ͻ�'][$key];
						$infoE[$val]['manageam']=$excelArr['�����'][$key];
					}
				}
				$sql="select
					s.username , s.userid , h.usercard as idcard
					, year(s.leavedt) as ly , month(s.leavedt) as lm
					from
					salary s
					left join hrms h on(s.userid=h.user_id)
					where h.expflag='1'  ";
				$query=$this->db->query_exc($sql);
				while($row=$this->db->fetch_array($query)){
					$infoA[]=$row['idcard'];
					if(array_key_exists($row['idcard'],$infoE)){
						$infoE[$row['idcard']]['type']=0;
						if(!empty($row['ly'])&&!empty($row['lm'])){
							if($row['ly'] < $this->nowy){
								$infoE[$row['idcard']]['type']=1;
							}
							if($row['ly'] == $this->nowy && $row['lm'] < $this->nowm ){
								$infoE[$row['idcard']]['type']=1;
							}
						}
					}
				}
				if(count($infoE)){
					foreach($infoE as $key=>$val){
						if(!in_array($key,$infoA)){
							$infoE[$row['idcard']]['type']=1;
						}
					}
				}
				if(count($infoE)){
					$totalA=array('amount'=>0,'gjjam'=>0,'shbam'=>0,'cogjjam'=>0,'coshbam'=>0,'prepaream'=>0
							,'handicapam'=>0,'manageam'=>0);
					foreach($infoE as $key=>$val){
						if($val['type']=='0'){
							$cl='green';
						}elseif($val['type']=='1'){
							$cl='red';
						}
						$totalA['amount']=$totalA['amount']+$val['amount'];
						$totalA['gjjam']=$totalA['gjjam']+$val['gjjam'];
						$totalA['shbam']=$totalA['shbam']+$val['shbam'];
						$totalA['cogjjam']=$totalA['cogjjam']+$val['cogjjam'];
						$totalA['coshbam']=$totalA['coshbam']+$val['coshbam'];
						$totalA['prepaream']=$totalA['prepaream']+$val['prepaream'];
						$totalA['handicapam']=$totalA['handicapam']+$val['handicapam'];
						$totalA['manageam']=$totalA['manageam']+$val['manageam'];
						$str.='<tr style="color:'.$cl.'">
							<td>'.$key.'</td>
							<td>'.$val['name'].'</td>
							<td>'.$val['amount'].'</td>
							<td>'.$val['gjjam'].'</td>
							<td>'.$val['shbam'].'</td>
							<td>'.$val['cogjjam'].'</td>
							<td>'.$val['coshbam'].'</td>
							<td>'.$val['prepaream'].'</td>
							<td>'.$val['handicapam'].'</td>
							<td>'.$val['manageam'].'</td>
							</tr>';
					}
				}
				$str.='<tr style="color:red">
					<td></td>
					<td>�ϼƣ�</td>
					<td>'.$totalA['amount'].'</td>
					<td>'.$totalA['gjjam'].'</td>
					<td>'.$totalA['shbam'].'</td>
					<td>'.$totalA['cogjjam'].'</td>
					<td>'.$totalA['coshbam'].'</td>
					<td>'.$totalA['prepaream'].'</td>
					<td>'.$totalA['handicapam'].'</td>
					<td>'.$totalA['manageam'].'</td>
					</tr>';
			}
		}catch(Exception $e){
			$str='<tr><td colspan="10">�������ݴ���'.$e->getMessage().'</td></tr>';
		}
		return $str;
	}
	/**
	 *
	 */
	function model_hr_sub_ini($ckt){
		set_time_limit(600);
		$type=$_POST['ctr_type'];
		$sqlCk=$type=='com'?'0':'1';
		$str='';
		$infoE=array();
		$infoA=array();
		try{
			$sql="delete from salary_temp where code = 'amount' and creator='".$_SESSION['USER_ID']."' ";
			$this->db->query_exc($sql);
			$excelfilename='attachment/xls_model/exp_ini/'.$ckt.".xls";
			if(empty ($_FILES["ctr_file"]["tmp_name"])){
				$str='<tr><td colspan="10">�뵼�����ݱ�</td></tr>';
			}elseif (!move_uploaded_file( $_FILES["ctr_file"]["tmp_name"], $excelfilename) ){
				$str='<tr><td colspan="10">�ϴ�ʧ�ܣ�</td></tr>';
			}else{
				//��ȡexcel��Ϣ
				include('includes/classes/excel.php');
				$excel = Excel::getInstance();
				$excel->setFile(WEB_TOR.$excelfilename);
				$excel->Open();
				$excel->setSheet();
				$excelFields = $excel->getFields();
				$excelArr=$excel->getAllData();
				$excel->Close();
				if(!in_array('Ա��', $excelFields)||!in_array('Ա����', $excelFields)
						||!in_array('��������', $excelFields))
				{
					throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
				}
				if(count($excelArr)&&!empty($excelArr)){
					foreach($excelArr['Ա����'] as $key=>$val ){
						$infoE[$val]['name']=$excelArr['Ա��'][$key];
						$infoE[$val]['amount']=$excelArr['��������'][$key];
					}
				}
				$sql="select
					s.username , s.userid , h.usercard as idcard
					, year(s.leavedt) as ly , month(s.leavedt) as lm
					, u.company , u.salarycom
					from
					salary s
					left join hrms h on (s.userid=h.user_id)
					left join user u on (s.userid=u.user_id)
					where ( u.company in ('sy','br') or u.salarycom in ('sy','br')) and s.userid=h.user_id ";
				$query=$this->db->query_exc($sql);
				while($row=$this->db->fetch_array($query)){
					$infoA[]=$row['idcard'];
					if(array_key_exists($row['idcard'],$infoE)){

						$infoE[$row['idcard']]['type']=0;
						if(empty($row['salarycom'])){
							$infoE[$row['idcard']]['com']=$this->salaryCom[$row['company']];
						}else{
							$infoE[$row['idcard']]['com']=$this->salaryCom[$row['salarycom']];
						}
						if(!empty($row['salarycom'])){
							$row['company']=$row['salarycom'];
						}
						$gjj=$this->salaryClass->salaryGjj($infoE[$row['idcard']]['amount'], $row['company']);
						$infoE[$row['idcard']]['gjjp']=$gjj['p'];
						$infoE[$row['idcard']]['gjjc']=$gjj['c'];
						$shb=$this->salaryClass->salaryShb($infoE[$row['idcard']]['amount'], $row['company'], $row['idcard']);
						$infoE[$row['idcard']]['shbp']=$shb['p'];
						$infoE[$row['idcard']]['shbc']=$shb['c'];
					}
				}
				if(count($infoE)){
					foreach($infoE as $key=>$val){
						if(!in_array($key,$infoA)){
							$infoE[$key]['type']=1;
						}
					}
				}
				if(count($infoE)){
					$totalA=array('amount'=>0);
					foreach($infoE as $key=>$val){
						if($val['type']=='0'){
							$cl='green';
						}elseif($val['type']=='1'){
							$cl='red';
						}
						$totalA['amount']=$totalA['amount']+$val['amount'];
						$str.='<tr style="color:'.$cl.'">
							<td>'.$key.'</td>
							<td>'.$val['name'].'</td>
							<td>'.$val['com'].'</td>
							<td>'.$val['amount'].'</td>
							<td>'.$val['shbp'].'</td>
							<td>'.$val['shbc'].'</td>
							<td>'.$val['gjjp'].'</td>
							<td>'.$val['gjjc'].'</td>
							</tr>';
					}
				}
			}
		}catch(Exception $e){
			$str='<tr><td colspan="10">�������ݴ���'.$e->getMessage().'</td></tr>';
		}
		return $str;
	}
	/**
	 * �����ʼ������
	 */
	function model_hr_exp_in(){
		set_time_limit(600);
		$ckt=$_POST['ckt'];
		$excelfilename=WEB_TOR.'attachment/xls_model/exp_ini/'.$ckt.".xls";
		try{
			if(!file_exists($excelfilename)){
				throw new Exception('File does not exist');
			}
			include('includes/classes/excel.php');
			$excel = Excel::getInstance();
			$excel->setFile($excelfilename);
			$excel->Open();
			$excel->setSheet();
			$excelFields = $excel->getFields();
			$excelArr=$excel->getAllData();
			$excel->Close();
			if(!in_array('Ա��', $excelFields)||!in_array('Ա����', $excelFields)
					||!in_array('��������', $excelFields)||!in_array('���˹�����', $excelFields)
					||!in_array('�����籣��', $excelFields)||!in_array('��˾������', $excelFields)
					||!in_array('��˾�籣��', $excelFields)||!in_array('�����', $excelFields)
					||!in_array('���Ͻ�', $excelFields)||!in_array('�����', $excelFields))
			{
				throw new Exception('Update failed');
			}
			if(count($excelArr)&&!empty($excelArr)){
				foreach($excelArr['Ա����'] as $key=>$val ){
					$infoE[$val]['name']=$excelArr['Ա��'][$key];
					$infoE[$val]['amount']=$excelArr['��������'][$key];
					$infoE[$val]['gjjam']=$excelArr['���˹�����'][$key];
					$infoE[$val]['shbam']=$excelArr['�����籣��'][$key];
					$infoE[$val]['cogjjam']=$excelArr['��˾������'][$key];
					$infoE[$val]['coshbam']=$excelArr['��˾�籣��'][$key];
					$infoE[$val]['prepaream']=$excelArr['�����'][$key];
					$infoE[$val]['handicapam']=$excelArr['���Ͻ�'][$key];
					$infoE[$val]['manageam']=$excelArr['�����'][$key];
				}
			}
			if(count($infoE)){
				foreach($infoE as $key=>$val){
					$sql="select s.rand_key , p.id as pid  from salary s
						left join salary_pay p on (s.userid=p.userid and p.pyear='".$this->nowy."' and pmon='".$this->nowm."')
						left join hrms h on (s.userid=h.user_id)
						where  h.usercard='".$key."' and  h.expflag='1' ";
					$res=$this->db->get_one($sql);
					if(!empty($res)){
						$tmps=array('amount'=>$val['amount'],'gjjam'=>$val['gjjam'],'shbam'=>$val['shbam']
								,'cogjjam'=>$val['cogjjam'],'coshbam'=>$val['coshbam'],'prepaream'=>$val['prepaream']
								,'handicapam'=>$val['handicapam'],'manageam'=>$val['manageam']);
						$temp=array('baseam'=>$val['amount'],'gjjam'=>$val['gjjam'],'shbam'=>$val['shbam']
								,'cogjjam'=>$val['cogjjam'],'coshbam'=>$val['coshbam'],'prepaream'=>$val['prepaream']
								,'handicapam'=>$val['handicapam'],'manageam'=>$val['manageam']);
						if($res['rand_key']){
							$this->model_salary_update($res['rand_key'],$tmps);
						}
						if($res['pid']){
							$this->model_pay_update($res['pid'],$temp);
							$this->model_pay_stat($res['pid']);
						}
					}
				}
			}
		}catch(Exception $e){
			$responce->error = un_iconv($e->getMessage());
		}
		return $responce;
	}
	/**
	 * �����ʼ���ӹ�˾
	 */
	function model_hr_sub_ini_in(){
		set_time_limit(600);
		$ckt=$_POST['ckt'];
		$excelfilename=WEB_TOR.'attachment/xls_model/exp_ini/'.$ckt.".xls";
		try{
			if(!file_exists($excelfilename)){
				throw new Exception('File does not exist');
			}
			include('includes/classes/excel.php');
			$excel = Excel::getInstance();
			$excel->setFile($excelfilename);
			$excel->Open();
			$excel->setSheet();
			$excelFields = $excel->getFields();
			$excelArr=$excel->getAllData();
			$excel->Close();
			if(!in_array('Ա��', $excelFields)||!in_array('Ա����', $excelFields)
					||!in_array('��������', $excelFields))
			{
				throw new Exception('Update failed');
			}
			if(count($excelArr)&&!empty($excelArr)){
				foreach($excelArr['Ա����'] as $key=>$val ){
					$infoE[$val]['name']=$excelArr['Ա��'][$key];
					$infoE[$val]['amount']=$excelArr['��������'][$key];
					$infoE[$val]['gjjam']=0;
					$infoE[$val]['shbam']=0;
					$infoE[$val]['cogjjam']=0;
					$infoE[$val]['coshbam']=0;
					$infoE[$val]['type']=1;
				}
			}
			$sql="select
				s.username , s.userid , h.usercard as idcard
				, year(s.leavedt) as ly , month(s.leavedt) as lm
				, u.company , u.salarycom
				from
				salary s
				left join hrms h on (s.userid=h.user_id)
				left join user u on (s.userid=u.user_id)
				where ( u.company in ('sy','br') or u.salarycom in ('sy','br')) and s.userid=h.user_id ";
			$query=$this->db->query_exc($sql);
			while($row=$this->db->fetch_array($query)){
				if(array_key_exists($row['idcard'],$infoE)){
					$infoE[$row['idcard']]['type']=0;
					$infoE[$row['idcard']]['com']=$row['company'];
					$infoE[$row['idcard']]['scom']=$row['salarycom'];
					if(!empty($row['salarycom'])){
						$row['company']=$row['salarycom'];
					}
					$gjj=$this->salaryClass->salaryGjj($infoE[$row['idcard']]['amount'], $row['company']);
					$infoE[$row['idcard']]['gjjam']=$gjj['p'];
					$infoE[$row['idcard']]['cogjjam']=$gjj['c'];
					$shb=$this->salaryClass->salaryShb($infoE[$row['idcard']]['amount'], $row['company'], $row['idcard']);
					$infoE[$row['idcard']]['shbam']=$shb['p'];
					$infoE[$row['idcard']]['coshbam']=$shb['c'];
				}
			}
			if(count($infoE)){
				foreach($infoE as $key=>$val){
					if($val['type']=='0'){
						//��˾Ա��������ݿ���
						$comtable=$this->get_com_sql($val['com'], $val['scom']);
						//echo "\n\t";
						$sql="select s.rand_key , p.id as pid  from salary s
							left join ".$comtable."salary_pay p on (s.userid=p.userid and p.pyear='".$this->nowy."' and pmon='".$this->nowm."')
							left join hrms h on (s.userid=h.user_id)
							where  h.usercard='".$key."' ";
						$res=$this->db->get_one($sql);
						if(!empty($res)){
							$tmps=array('amount'=>$val['amount'],'gjjam'=>$val['gjjam'],'shbam'=>$val['shbam']
									,'cogjjam'=>$val['cogjjam'],'coshbam'=>$val['coshbam'],'prepaream'=>$val['prepaream']
									,'handicapam'=>$val['handicapam'],'manageam'=>$val['manageam']);
							$temp=array('baseam'=>$val['amount'],'gjjam'=>$val['gjjam'],'shbam'=>$val['shbam']
									,'cogjjam'=>$val['cogjjam'],'coshbam'=>$val['coshbam'],'prepaream'=>$val['prepaream']
									,'handicapam'=>$val['handicapam'],'manageam'=>$val['manageam']);
							if($res['rand_key']){
								$this->model_salary_update($res['rand_key'],$tmps);
							}
							if($res['pid']){
								$this->model_pay_update($res['pid'],$temp,'',$comtable);
								$this->model_pay_stat($res['pid'],$comtable);
							}
						}
					}
				}
			}
		}catch(Exception $e){
			$responce->error = un_iconv($e->getMessage());
		}
		return $responce;
	}
	/**
	 *��ȡ��˾��
	 * @param type $com
	 * @param type $scom
	 * @return string
	 */
	function get_com_sql($com,$scom=''){
		$res='';
		if(!empty($scom)){
			$res=" `".$this->salarySql[$scom]."`.";
		}elseif(!empty($com)){
			$res=" `".$this->salarySql[$com]."`.";
		}
		return $res;
	}
	/**
	 * �ɷѵ���
	 */
	function model_hr_pay_xls() {
		$scom=$_GET['scom'];
		$comtable=$this->get_com_sql($scom);
		include( WEB_TOR . 'includes/classes/excel_out_class.php');
		$xls = new ExcelXML('gb2312', false, 'My Test Sheet');
		$data = array(1=> array ('����','Ա����', '����', '����'
					,'��������', '������', '�籣��', '��˾������', '��˾�籣��'
					, '�����', '���Ͻ�', '�����', '�ʺ�', '����'
					,'������','���֤��','״̬')
			     );
		$xls->setStyle(array(4,5,6,7,8,9,10,11));
		$sqlstr='';
		if($_GET['type']=='com'){
			$sqlstr=" and h.expflag='0'";
		}elseif($_GET['type']=='exp'){
			$sqlstr=" and h.expflag='1'";
		}
		$sql="select
			s.rand_key , s.username , s.userid , s.olddept , h.userlevel
			, p.baseam as amount , p.gjjam , p.shbam
			, p.cogjjam , p.coshbam
			, p.prepaream , p.handicapam
			, p.manageam
			, s.amount , s.gjjam , s.shbam
			, s.cogjjam , s.coshbam
			, s.prepaream , s.handicapam
			, s.manageam
			, s.acc
			, s.email
			, s.accbank , s.idcard , s.usersta , h.userlevel , h.usercard
			from salary_pay p
			left join salary s on (s.userid=p.userid)
			left join hrms h on ( s.userid=h.user_id )
			where
			s.userid=h.user_id
			and s.userid=p.userid
			and p.pyear='".$_GET['sy']."'
			and p.pmon='".$_GET['sm']."'
			$sqlstr ";
		$query=$this->db->query($sql);
		while($row=$this->db->fetch_array($query)){
			$tus=$row['usersta']=='3'?'��ְ':'��ְ';
			if($row['userlevel']=='4'){
				$amount=$this->salaryClass->decryptDeal($row['amount']);
			}else{
				$amount='-';
			}
			$data[]=array($_GET['sy'].'-'.$_GET['sm'],$row['usercard'],$row['username'],$row['olddept']
					,$amount
					,$this->salaryClass->decryptDeal($row['gjjam']),$this->salaryClass->decryptDeal($row['shbam'])
					,$this->salaryClass->decryptDeal($row['cogjjam']),$this->salaryClass->decryptDeal($row['coshbam'])
					,$this->salaryClass->decryptDeal($row['prepaream'])
					,$this->salaryClass->decryptDeal($row['handicapam']),$this->salaryClass->decryptDeal($row['manageam'])
					,$row['acc'],$row['email'],$row['accbank'],$row['idcard'],$tus
				     );
		}
		$xls->addArray($data);
		$xls->generateXML(date('Y:m:d'));
	}
	/**
	 * �ʼ�����
	 */
	function model_hr_email_send(){
		set_time_limit(600);
		$sqlStr="";
		if($_POST['usertype']=='2'){
			$sqlStr.=" and h.expflag='0' ";
		}elseif($_POST['usertype']=='3'){
			$sqlStr.=" and h.expflag='1' ";
		}
		$emailbody=$_POST['emailbd'];
		$sendArr=array();
		$sql="select
			s.email
			from salary s
			left join hrms h on(s.userid=h.user_id)
			where
			s.sta='0'
			$sqlStr  ";
		$query=$this->db->query($sql);
		while ($row=$this->db->fetch_array($query)) {
			$sendArr[]=$row['email'];
		}
		foreach($sendArr as $val){
			if($val){
				$this->model_send_email(($_POST['emailtl']), ($emailbody), $val);
			}
		}
		echo '1';
	}

	function model_hr_info_ck($bdt,$edt){
		$res='';
		$sql="select s.username ,  s.acc , h.account , s.idcard , h.card_no , s.accbank , h.bank
			from salary s
			left join hrms h on (s.userid=h.user_id)
			where s.userid=h.user_id and
			(   s.acc <> h.account or s.acc is null or s.acc=''
			    or s.idcard <> h.card_no or s.idcard is null or s.idcard=''
			    or s.accbank <> h.bank or s.accbank  is null or s.accbank=''
			)
			and to_days(s.comedt)>= to_days('".$bdt."')
			and to_days(s.comedt)<= to_days('".$edt."')
			order by s.id ";
		// year(s.comedt)='".date('Y')."' and month(s.comedt)='".date('m')."'
		$query=$this->db->query($sql);
		$i=1;
		while($row=$this->db->fetch_array($query)){
			$ac='';
			$cc='';
			$bc='';
			if($row['acc']!=$row['account']){
				$ac='color:red;';
			}
			if($row['idcard']!=$row['card_no']){
				$cc='color:red;';
			}
			if($row['accbank']!=$row['bank']){
				$bc='color:red;';
			}
			$res.='<tr>
				<td align="center" >'.$i.'</td>
				<td align="center" >'.$row['username'].'</td>
				<td align="center" style="'.$ac.'">'.$row['acc'].'</td>
				<td align="center" style="'.$ac.'">'.$row['account'].'</td>
				<td align="center" style="'.$cc.'">'.$row['idcard'].'</td>
				<td align="center" style="'.$cc.'">'.$row['card_no'].'</td>
				<td align="center" style="'.$bc.'">'.$row['accbank'].'</td>
				<td align="center" style="'.$bc.'">'.$row['bank'].'</td>
				</tr>';
			$i++;
		}
		if(empty($res)){
			$res='<tr><td colspan="8">��Ϣ�˶���ɣ��޴�����Ϣ��</td></tr>';
		}
		return $res;
	}
	/**
	 *Ա����Ϣ
	 */
	function model_hr_info_list(){
		$page = $_GET['page'];
		$limit = $_GET['rows'];
		$sidx = $_GET['sidx'];
		$sord = $_GET['sord'];
		$schOper = $_GET['searchOper'];
		$schStr = $_GET['searchString'];
		$schField = $_GET['searchField'];
		$sqlSch = '';
		if ($schOper) {
			$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
		}
		$start = $limit * $page - $limit;
		//����
		$sql = "select count(s.id)
			from salary s
			left join user u on (s.userid=u.user_id)
			left join department d on (u.dept_id=d.dept_id)
			where
			s.userid=u.user_id
			$sqlSch ";
		$rs = $this->db->get_one($sql);
		$count = $rs['count(s.id)'];
		if ($count > 0) {
			$total_pages = ceil($count / $limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages){
			$page = $total_pages;
		}
		$i = 0;
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$sql="select
			s.rand_key , s.oldname , s.olddept , s.comedt
			,s.oldarea , s.acc , s.accbank , s.idcard , s.email , s.cessebase
			,s.usersta
			from salary s
			left join user u on (s.userid=u.user_id)
			left join department d on (u.dept_id=d.dept_id)
			where
			s.userid=u.user_id
			$sqlSch
			order by s.usersta , s.leavecreatedt desc , $sidx $sord
			limit $start , $limit ";
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			$responce->rows[$i]['id'] = $row['userid'];
			$responce->rows[$i]['cell'] = un_iconv(
					array("", $row['rand_key']
						, $row['oldname']
						, $row['olddept']
						, $row['comedt']
						, $row['oldarea']
						, $row['cessebase']
						, $row['acc']
						, $row['accbank']
						, $row['idcard']
						, $row['email']
						, $this->userSta[$row['usersta']]
					     )
					);
			$i++;
		}
		return $responce;
	}
	/**
	 * Ա����Ϣ�޸�
	 */
	function model_hr_info_in(){
		$id = $_POST['id'];
		try {
			$this->db->query("START TRANSACTION");
			$sql = "select
				s.userid , s.usersta
				from salary s
				where
				s.rand_key='$id' and s.usersta!='3'  ";
			$res = $this->db->get_one($sql);
			if(!$res['userid']){
				throw new Exception('No data query');
			}
			$this->model_salary_update($id,
					array('oldname'=>$_POST['username']
						,'username'=>$_POST['username']
						,'olddept'=>$_POST['dept'] , 'oldarea'=>$_POST['area']
						,'idcard'=>$_POST['idcard'],'acc'=>$_POST['acc']
						,'accbank'=>$_POST['accbank'],'email'=>$_POST['email']
						,'username'=>$_POST['username']
					     )
					, array(0,1,2,3,4,5,6,7));
			$this->db->query("COMMIT");
			$responce->id = $id;
			$this->globalUtil->insertOperateLog('���ʹ���', $id, 'Ա����Ϣ', '�ɹ�');
		} catch (Exception $e) {
			$this->db->query("ROLLBACK");
			$responce->error = $e->getMessage();
			$this->globalUtil->insertOperateLog('���ʹ���', $id, 'Ա����Ϣ', 'ʧ��', $e->getMessage());
		}
		return $responce;
	}
	/**
	 *���� -2013-04-25
	 */
	function model_xls_out($flag,$filename='ģ��'){
		$repClass= new model_module_report();
		include_once WEB_TOR . "module/phpExcel/classes/PHPExcel.php";
		include_once WEB_TOR. "module/phpExcel/Classes/PHPExcel/Reader/Excel2007.php";
		include_once WEB_TOR . "module/phpExcel/Classes/PHPExcel/IOFactory.php";
		//����һ��Excel������
		$objPhpExcelFile = new PHPExcel();
		$endName="xls";
		if($filename=='����ͳ�Ʊ�'||$filename=='������Ŀͳ�Ʊ�'){
			$endName="xls";
			$objReader = PHPExcel_IOFactory::createReader ( 'Excel5' );//Excel2007
		}else{
			$objReader = PHPExcel_IOFactory::createReader ( 'Excel5' ); //use excel2007 for 2007 format
		}
		$objPhpExcelFile = $objReader->load ( "upfile/".$filename.".".$endName); //��ȡģ��

		//Excel2003����ǰ�ĸ�ʽ
		if($endName=='xls'){
			$objWriter = new PHPExcel_Writer_Excel5 ( $objPhpExcelFile );
		}else{
			$objWriter = new PHPExcel_Writer_Excel2007 ( $objPhpExcelFile );
		}
		//���õ�ǰ�����������
		$objPhpExcelFile->getActiveSheet ()->setTitle ( iconv ( "gb2312", "utf-8", $filename ) );

		$gl=new includes_class_global();
		$is_echo=true;//��ͨ���������
		$bi=0;//�������������
		$setString=array();//�ı����
		if($flag=='dp_tol'){//���Ź���ͳ�Ʊ�

			$ty=$_REQUEST['type'];
			$is_echo=false;//�ر�
			$bi=4;//�������������
			$sy=$_REQUEST['sy'];
			$sm=$_REQUEST['sm'];
			if($sm=='-'){
				$filename.=$sy.'-����'; //�����ļ���
			}else{
				$filename.=$sy.'-'.$sm;
			}

			$objPhpExcelFile->setActiveSheetIndex(0);
			$objPhpExcelFile->getActiveSheet ()->setTitle ( iconv ( "gb2312", "utf-8", '��ְԱ������ͳ��' ) );
			$deptarr=array();//������Ϣ
			$deptarr['����']['����']['����']='����';
			$sql="SELECT d.dept_name , IFNULL(d2.pdeptname ,d.pdeptname) as tdeptname,d.pdeptname , d.dept_id,d.levelflag FROM `department` d left join department d2 on d.parent_id=d2.dept_id
				WHERE d.DelFlag=0 and FIND_IN_SET( '".$sy."' , d.setyear)
				ORDER BY d.PARENT_ID , d.subam , d.DEPT_ID";//��ȡ���Ź̶�����

				$sql="SELECT d.dept_name,  (case d.levelflag when 2 then d.DEPT_NAME when 3 then d2.DEPT_NAME when 4 then d3.DEPT_NAME ELSE d.DEPT_NAME  
				end ) as 'tdeptname',
				    (case d.levelflag 
				     when 2 then d.DEPT_NAME  
				     when 3 then d2.DEPT_NAME 
				     ELSE d.pdeptname end ) as 'pdeptname',d.dept_id,d.levelflag FROM `department` d LEFT JOIN department d2 ON d.parent_id = d2.dept_id 
					    LEFT JOIN department d3 ON d2.PARENT_ID = d3.DEPT_ID
					    WHERE   d.DelFlag = 0 AND FIND_IN_SET('".$sy."', d.setyear) ORDER BY d.PARENT_ID,   d.subam,    d.DEPT_ID";//��ȡ���Ź̶����򣬵�����֯�ܹ���

					    $query=$this->db->query($sql);
			while($row=$this->db->fetch_array($query)){
				if($row['levelflag']==2){//����Ƕ�������
					$deptarr[$row['tdeptname']][$row['dept_name']][$row['dept_name']]=$row['dept_name'];
				}else if($row['levelflag']==3){//�������������
					$deptarr[$row['tdeptname']][$row['dept_name']][$row['dept_name']]=$row['dept_name'];
				}else if($row['levelflag']==4){//������ļ�����
					$deptarr[$row['tdeptname']][$row['pdeptname']][$row['dept_name']]=$row['dept_name'];
				}
			}



			$data=array();
			global $func_limit;
			$dppow=$this->model_dp_pow();
			$sqlpow=$this->getSqlParam($func_limit['�������'],$dppow);
			if(!empty($func_limit['���Ų���ͳ��'])||$ty=='hr'){
				$sqlpow="";
			}
			//��ְ����ͳ��
			$datacells=array(
					'jb'=>0,'xm'=>0,'bt'=>0
					,'fl'=>0,'kc'=>0,'shkc'=>0,'txjt'=>0
					,'yf'=>0,'djgs'=>0
					,'djshb'=>0,'djgjj'=>0
					,'sf'=>0,'gsshb'=>0
					,'gsgjj'=>0,'gl'=>0
					,'czf'=>0,'tpf'=>0
					,'rs'=>0

					,'jbdl'=>0,'xmdl'=>0
					,'btdl'=>0,'fldl'=>0
					,'kcdl'=>0,'shkcdl'=>0,'txjtdl'=>0,'yfdl'=>0,'djgsdl'=>0
					,'djshbbendl'=>0,'djgjjbendl'=>0
					,'djshbfeidl'=>0,'djgjjfeidl'=>0
					,'djshbfbendl'=>0,'djgjjfbendl'=>0
					,'sfdl'=>0,'gsshbdl'=>0
					,'gsgjjdl'=>0,'gldl'=>0
					,'czfdl'=>0,'tpfdl'=>0
					,'rsdl'=>0

					,'jbbr'=>0,'xmbr'=>0,'btbr'=>0
					,'flbr'=>0,'kcbr'=>0,'shkcbr'=>0,'txjtbr'=>0
					,'yfbr'=>0,'djgsbr'=>0
					,'djshbbenbr'=>0,'djgjjbenbr'=>0
					,'djshbfeibr'=>0,'djgjjfeibr'=>0
					,'djshbfbenbr'=>0,'djgjjfbenbr'=>0
					,'sfbr'=>0,'gsshbbr'=>0
					,'gsgjjbr'=>0,'glbr'=>0
					,'czfbr'=>0,'tpfbr'=>0
					,'rsbr'=>0

					,'jbsy'=>0,'xmsy'=>0,'btsy'=>0
					,'flsy'=>0,'kcsy'=>0,'shkcsy'=>0,'txjtsy'=>0
					,'yfsy'=>0,'djgssy'=>0
					,'djshbbensy'=>0,'djgjjbensy'=>0
					,'djshbfeisy'=>0,'djgjjfeisy'=>0
					,'djshbfbensy'=>0,'djgjjfbensy'=>0
					,'sfsy'=>0,'gsshbsy'=>0
					,'gsgjjsy'=>0,'glsy'=>0
					,'czfsy'=>0,'tpfsy'=>0
					,'rssy'=>0

					,'jbep'=>0,'xmep'=>0,'btep'=>0
					,'flep'=>0,'kcep'=>0,'shkcep'=>0,'txjtep'=>0
					,'yfep'=>0,'djgsep'=>0
					,'djshbep'=>0,'djgjjep'=>0
					,'sfep'=>0,'gsshbep'=>0
					,'gsgjjep'=>0,'glep'=>0
					,'czfep'=>0,'tpfep'=>0
					,'rsep'=>0

					,'jbbx'=>0,'xmbx'=>0,'btbx'=>0
					,'flbx'=>0,'kcbx'=>0,'shkcbx'=>0,'txjtbx'=>0
					,'yfbx'=>0,'djgsbx'=>0
					,'djshbbenbx'=>0,'djgjjbenbx'=>0
					,'djshbfeibx'=>0,'djgjjfeibx'=>0
					,'djshbfbenbx'=>0,'djgjjfbenbx'=>0
					,'sfbx'=>0,'gsshbbx'=>0
					,'gsgjjbx'=>0,'glbx'=>0
					,'czfbx'=>0,'tpfbx'=>0
					,'rsbx'=>0
					);
			$sqlSch=" and p.pyear='".$sy."' ";
			if($sm!='-'){
				$sqlSch.="and p.pmon='".$sm."'";
			}
			//������ְ��Ա
			$sqlSch.="  and ( (p.nowamflag!=3 and  p.nowamflag!=4) or p.nowamflag is null )  and ( p.salarydept not in ('����')
				or p.userid='bin.chang' or p.userid='2903' )  ";
			$sql = "select
				s.rand_key , u.user_name as username , d.dept_name as deptname , s.olddept , s.comedt , s.oldarea
				, s.amount ,  p.gjjam , p.shbam
				, s.acc , s.accbank , s.idcard , p.remark , s.email , s.usersta , p.baseam , p.floatam , p.proam , p.otheram
				, p.bonusam , p.othdelam , p.perholsdays , p.sickholsdays , p.paycesse , p.paytotal , p.sperewam ,p.spedelam
				, h.userlevel , p.pyear , p.pmon
				, p.sdyam , p.holsdelam , p.usercom as company , p.expflag , d.pdeptname ,IFNULL(d2.pdeptname ,d.pdeptname) as tdeptname, p.basenowam  ,  p.cogjjam , p.coshbam
				, p.accrewam , p.accdelam , p.nowamflag , p.jfcom , p.manageam
				, p.gwam , p.jxam
				, p.HandicapAm,p.PrepareAm
				, p.txjt
				from
				salary_pay p
				left join salary s on ( p.userid=s.userid )
				left join hrms h on( h.user_id=s.userid )
				left join user u on (u.user_id=p.userid)
				left join department d on (p.deptid=d.dept_id) left join department d2 on (d.parent_id=d2.dept_id)
				where p.userid=s.userid
				and p.leaveflag='0'
				$sqlpow
				$sqlSch
				order by  d.pdeptname , d.dept_name , s.username  ";
			$query=$this->db->getArray($sql);//��ְ����
			$i=1;
			$data=array();
			$temp = 0;
			foreach($query as $row){
				if(empty($data[$row['deptname']])){
					$data[$row['deptname']]=$datacells;
				}
				$jb=$this->salaryClass->decryptDeal($row['basenowam']);
				if(empty($jb)||round($jb)==0||$jb==0){
					//                     $jb=$this->salaryClass->decryptDeal($row['baseam']);
					$jb=round( $this->salaryClass->decryptDeal($row['baseam'])
							+$this->salaryClass->decryptDeal($row['gwam'])
							+$this->salaryClass->decryptDeal($row['jxam'])
							,2);
				}
				//��������=��������+˰ǰ��������+˰�󲹷�����
				$jb=round($jb+$this->salaryClass->decryptDeal($row['sperewam'])+$this->salaryClass->decryptDeal($row['accrewam']),2);
				$xm=round($this->salaryClass->decryptDeal($row['proam'])
						+$this->salaryClass->decryptDeal($row['bonusam'])+$this->salaryClass->decryptDeal($row['floatam']),2);
				//�������ڼ��ղ������ɲͲ���; ����������������������������
				$bt=round($this->salaryClass->decryptDeal($row['sdyam'])  ,2);
				$fl=round($this->salaryClass->decryptDeal($row['otheram']),2);

				//�۳�
				$kc=round($this->salaryClass->decryptDeal($row['holsdelam'])+$this->salaryClass->decryptDeal($row['othdelam'])
						+$this->salaryClass->decryptDeal($row['spedelam']),2);//�۳�������˰��۳�+$this->salaryClass->decryptDeal($row['accdelam'])
				//����˰��۳� add by chengl 2014-10-28
				$shkc=round($this->salaryClass->decryptDeal($row['accdelam']),2);

				//ͨ�Ž���
				$txjt = round($this->salaryClass->decryptDeal($row['txjt']),2);
				$yf=round($jb+$xm+$bt+$fl-$kc+$txjt , 2);
				$djgs=$this->salaryClass->decryptDeal($row['paycesse']);

				$djshb=$this->salaryClass->decryptDeal($row['shbam']);
				$djgjj=$this->salaryClass->decryptDeal($row['gjjam']);
				if( $row['company'] == $row['jfcom'] ){
					$djshbben=$djshb ;
					$djgjjben=$djgjj ;
					$djshbfei=0;
					$djgjjfei=0;
				}else{
					$djshbben=0;
					$djgjjben=0;
					$djshbfei= $djshb ;
					$djgjjfei= $djgjj ;
				}

				$dj=round($djgs+$djshb+$djgjj,2);
				$sf=round($this->salaryClass->decryptDeal($row['paytotal']),2);
				$gsshb=$this->salaryClass->decryptDeal($row['coshbam']);
				$gsgjj=$this->salaryClass->decryptDeal($row['cogjjam']);
				$glam=$this->salaryClass->decryptDeal($row['manageam']);
				$czf=$this->salaryClass->decryptDeal($row['HandicapAm']);
				$tpf=$this->salaryClass->decryptDeal($row['PrepareAm']);

				if($ty=='hr'&&empty($func_limit['���²鿴�����'])){//����Ȩ������
					$jb=$yf=$djgs=$sf=$dj=0;
				}

				if($row['expflag']=='1'){
					$data[$row['deptname']]['jbep']+=$jb;
					$data[$row['deptname']]['xmep']+=$xm;
					$data[$row['deptname']]['btep']+=$bt;
					$data[$row['deptname']]['flep']+=$fl;
					$data[$row['deptname']]['kcep']+=$kc;
					$data[$row['deptname']]['shkcep']+=$shkc;//˰��۳�
					$data[$row['deptname']]['txjtep']+=$txjt;
					$data[$row['deptname']]['yfep']+=$yf;
					$data[$row['deptname']]['djgsep']+=$djgs;
					$data[$row['deptname']]['djshbep']+=$djshb;
					$data[$row['deptname']]['djgjjep']+=$djgjj;
					$data[$row['deptname']]['sfep']+=$sf;
					$data[$row['deptname']]['gsshbep']+=$gsshb;
					$data[$row['deptname']]['gsgjjep']+=$gsgjj;
					$data[$row['deptname']]['glep']+=$glam;
					$data[$row['deptname']]['czfep']+=$czf;
					$data[$row['deptname']]['tpfep']+=$tpf;
					$data[$row['deptname']]['rsep']+=1;
				}else{
					$data[$row['deptname']]['jb'.$row['company']]+=$jb;
					$data[$row['deptname']]['xm'.$row['company']]+=$xm;
					$data[$row['deptname']]['bt'.$row['company']]+=$bt;
					$data[$row['deptname']]['fl'.$row['company']]+=$fl;
					$data[$row['deptname']]['kc'.$row['company']]+=$kc;
					$data[$row['deptname']]['shkc'.$row['company']]+=$shkc;//˰��۳�
					$data[$row['deptname']]['txjt'.$row['company']]+=$txjt;
					$data[$row['deptname']]['yf'.$row['company']]+=$yf;
					$data[$row['deptname']]['djgs'.$row['company']]+=$djgs;
					$data[$row['deptname']]['djshbben'.$row['company']]+=$djshbben;
					$data[$row['deptname']]['djgjjben'.$row['company']]+=$djgjjben;
					$data[$row['deptname']]['djshbfei'.$row['company']]+=$djshbfei;
					$data[$row['deptname']]['djgjjfei'.$row['company']]+=$djgjjfei;
					$data[$row['deptname']]['djshbfben'.$row['jfcom']]+=$djshbfei;
					$data[$row['deptname']]['djgjjfben'.$row['jfcom']]+=$djgjjfei;
					$data[$row['deptname']]['sf'.$row['company']]+=$sf;
					$data[$row['deptname']]['gsshb'.$row['jfcom']]+=$gsshb;
					$data[$row['deptname']]['gsgjj'.$row['jfcom']]+=$gsgjj;
					$data[$row['deptname']]['gl'.$row['company']]+=$glam;
					$data[$row['deptname']]['czf'.$row['company']]+=$czf;
					$data[$row['deptname']]['tpf'.$row['company']]+=$tpf;
					$data[$row['deptname']]['rs'.$row['company']]+=1;
				}
				//��
				$data[$row['deptname']]['jb']+=$jb;
				$data[$row['deptname']]['xm']+=$xm;
				$data[$row['deptname']]['bt']+=$bt;
				$data[$row['deptname']]['fl']+=$fl;
				$data[$row['deptname']]['kc']+=$kc;
				$data[$row['deptname']]['shkc']+=$shkc;//˰��۳�
				$data[$row['deptname']]['txjt']+=$txjt;
				$data[$row['deptname']]['yf']+=$yf;
				$data[$row['deptname']]['djgs']+=$djgs;
				$data[$row['deptname']]['djshb']+=$djshb;
				$data[$row['deptname']]['djgjj']+=$djgjj;
				$data[$row['deptname']]['sf']+=$sf;
				$data[$row['deptname']]['gsshb']+=$gsshb;
				$data[$row['deptname']]['gsgjj']+=$gsgjj;
				$data[$row['deptname']]['gl']+=$glam;
				$data[$row['deptname']]['czf']+=$czf;
				$data[$row['deptname']]['tpf']+=$tpf;
				$data[$row['deptname']]['rs']+=1;
			}
			//���ñ�ͷ����ʽ ����
			$i = 4;
			if(!empty($deptarr)){
				$row = $i;//ǰ4��Ϊ��ͷ
				$n=0;
				$n2=0;
				$p=0;
				$tol=array();
				$tolnbx=array();
				$p2=$row;//�������ſ�ʼ��
				foreach($deptarr as $key2=>$val2){

					$num=count($val2);
					$num2=0;
					foreach($val2 as $key=>$val){
						$showtol=false;
						$p=($n+$row);
						$noSalaryDeptNum=0;
						foreach($val as $vkey=>$vval ){
							if(empty($data[$vval])){//�����޹�����Ϣ����
								$noSalaryDeptNum+=1; // �����޹�����Ϣ���ŵ�����
								continue;
							}
							$showtol=true;
							//��ȡ����
							$tol[]=$row + $n;
							if($key!='��Ѷר��'){//ͳ�Ʋ�����Ѷר��
								$tolnbx[]=$row + $n;
							}
							$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow ( 0, $row + $n, iconv ( "gb2312", "utf-8", $key2 ) );
							$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow ( 1, $row + $n, iconv ( "gb2312", "utf-8", $key ) );
							$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow ( 2, $row + $n, iconv ( "gb2312", "utf-8", $vval ) );
							$m = 3;

							foreach ( $data[$vval] as $field => $value ) {
								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow ( $m, $row + $n, $value  );
								$m ++;
							}
							$n ++;
							$num2++;
						}
						if(count($val)>1&&$showtol){
							//$n ++;//ÿһ��
							//�ϲ��������ţ��ϲ�ʱ��Ҫ�����޹�����Ϣ���ŵ�����
							$objPhpExcelFile->getActiveSheet ()->mergeCells ( 'B' . ($row+$n-count($val)+$noSalaryDeptNum) . ':' . 'B' . ($row+$n-1) );
							// $num2=count($val);//�ļ���������
						}



					}

					if($num>1 && $num2>0){//����������������1�ģ�����С�Ƽ��ϲ�,&& $num2>0 �ǵ������żܹ�����ӵĴ���

						//$n ++;
						//�ϲ���������
						$objPhpExcelFile->getActiveSheet ()->mergeCells ( 'A' . $p2 . ':' . 'A' . ($p2+$num2-1));

					}
					$p2 =$p2+$num2;

				}
				//����Ѷ
				$objPhpExcelFile->getActiveSheet()->getStyle( 'A'.($row + $n).':BT'.($row + $n))->getFont()->setSize(10);
				$objPhpExcelFile->getActiveSheet()->getStyle( 'A'.($row + $n).':BT'.($row + $n))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
					->getStartColor()->setRGB('8FBC8F');
				$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow ( 0, $row + $n, iconv ( "gb2312", "utf-8", '�ϼ�' ) );
				$objPhpExcelFile->getActiveSheet ()->mergeCells ('A' . ($n+$row).':'.'B' . ($n+$row) );
				$m = 3;
				foreach ( $datacells as $field => $value ) {
					$str='';
					foreach($tol as $val){
						$str.=$gl->numToCell($m).$val.',';
					}
					$objPhpExcelFile->getActiveSheet ()
						->setCellValueByColumnAndRow ( $m, $row + $n, '=SUM('.trim($str,',').')' );
								$m ++;
								}

								}


								//�ڶ�������ְͳ�Ʊ�
								$objPhpExcelFile->createSheet();
								$objPhpExcelFile->setActiveSheetIndex(1);
								$objPhpExcelFile->getActiveSheet ()->setTitle ( iconv ( "gb2312", "utf-8", '��ְԱ������ͳ��' ) );
								$datacells=array(
									'jb'=>0,'xm'=>0
									,'bt'=>0,'fl'=>0
									,'kc'=>0,'shkc'=>0,'txjt'=>0,'yf'=>0
									,'djgs'=>0,'djshb'=>0
									,'djgjj'=>0,'sf'=>0
									,'gsshb'=>0,'gsgjj'=>0
									,'gl'=>0,'czf'=>0
									,'tpf'=>0,'rs'=>0
									,'prs'=>0

									,'jbdl'=>0,'xmdl'=>0
									,'btdl'=>0,'fldl'=>0
									,'kcdl'=>0,'shkcdl'=>0,'txjtdl'=>0,'yfdl'=>0
									,'djgsdl'=>0,'djshbdl'=>0
									,'djgjjdl'=>0,'sfdl'=>0
									,'gsshbdl'=>0,'gsgjjdl'=>0
									,'gldl'=>0,'czfdl'=>0
									,'tpfdl'=>0,'rsdl'=>0
									,'prsdl'=>0

									,'jbbr'=>0,'xmbr'=>0
									,'btbr'=>0,'flbr'=>0
									,'kcbr'=>0,'shkcbr'=>0,'txjtbr'=>0,'yfbr'=>0
									,'djgsbr'=>0,'djshbbr'=>0
									,'djgjjbr'=>0,'sfbr'=>0
									,'gsshbbr'=>0,'gsgjjbr'=>0
									,'glbr'=>0,'czfbr'=>0
									,'tpfbr'=>0,'rsbr'=>0
									,'prsbr'=>0

									,'jbsy'=>0,'xmsy'=>0
									,'btsy'=>0,'flsy'=>0
									,'kcsy'=>0,'shkcsy'=>0,'txjtsy'=>0,'yfsy'=>0
									,'djgssy'=>0,'djshbsy'=>0
									,'djgjjsy'=>0,'sfsy'=>0
									,'gsshbsy'=>0,'gsgjjsy'=>0
									,'glsy'=>0,'czfsy'=>0
									,'tpfsy'=>0,'rssy'=>0
									,'prssy'=>0

									,'jbep'=>0,'xmep'=>0
									,'btep'=>0,'flep'=>0
									,'kcep'=>0,'shkcep'=>0,'txjtep'=>0,'yfep'=>0
									,'djgsep'=>0,'djshbep'=>0
									,'djgjjep'=>0,'sfep'=>0
									,'gsshbep'=>0,'gsgjjep'=>0
									,'glep'=>0,'czfep'=>0
									,'tpfep'=>0,'rsep'=>0
									,'prsep'=>0

									,'jbbx'=>0,'xmbx'=>0
									,'btbx'=>0,'flbx'=>0
									,'kcbx'=>0,'shkcbx'=>0,'txjtbx'=>0,'yfbx'=>0
									,'djgsbx'=>0,'djshbbx'=>0
									,'djgjjbx'=>0,'sfbx'=>0
									,'gsshbbx'=>0,'gsgjjbx'=>0
									,'glbx'=>0,'czfbx'=>0
									,'tpfbx'=>0,'rsbx'=>0
									,'prsbx'=>0
									);
								//��ְ���� ������ְ����ְ֧�������ڱ�������
								$sqlSch=" and ( ( p.pyear='".$sy."' and p.pmon='".$sm."' and p.nowamflag=3 )
									or ( s.lpy='".$sy."' and s.lpm='".$sm."' and  year(s.leavedt)=p.pyear and month(s.leavedt)=p.pmon and p.nowamflag=3 ) )
									and ( p.salarydept not in ('����') or p.userid='bin.chang' or p.userid='2903'  )  ";
								$sql = "select
									s.rand_key , u.user_name as username , d.dept_name as deptname , s.olddept , s.comedt , s.oldarea
									, s.amount ,  p.gjjam , p.shbam
									, s.acc , s.accbank , s.idcard , p.remark , s.email , s.usersta , p.baseam , p.floatam , p.proam , p.otheram
									, p.bonusam , p.othdelam , p.perholsdays , p.sickholsdays , p.paycesse , p.paytotal , p.sperewam ,p.spedelam
									, h.userlevel , p.pyear , p.pmon
									, p.sdyam , p.holsdelam  , p.expflag , d.pdeptname , IFNULL(d2.pdeptname ,d.pdeptname) as tdeptname,p.basenowam  ,  p.cogjjam , p.coshbam
									, p.accrewam , p.accdelam , p.nowamflag , s.lpy , s.lpm , year(s.leavedt) as ldy , month(s.leavedt) as ldm
									, p.usercom as company , p.jfcom , p.manageam
									, p.gwam , p.jxam
									, p.HandicapAm,p.PrepareAm
									, p.txjt
									from
									salary_pay  p
									left join salary s on ( p.userid=s.userid )
									left join hrms h on( h.user_id=s.userid )
									left join user u on (u.user_id=p.userid)
									left join department d on (p.deptid=d.dept_id) left join department d2 on (d.parent_id=d2.dept_id)
									where p.userid=s.userid
									and
									p.leaveflag='0'
									$sqlpow
									$sqlSch
									order by  d.pdeptname , d.dept_name , s.username ";

								$querylz=$this->db->getArray($sql);//��ְ����
								$data=array();
								foreach($querylz as $row){
									if(empty($data[$row['deptname']])){
										$data[$row['deptname']]=$datacells;
									}
									//����ͳ��
									$jb=$xm=$fl=$kc=$yf=$djgs=$djshb=$djgjj=$sf=$gsshb=$gsgjj=$gsgjj=$rs=$prs=$dj=$bt=$glam=$txjt=0;
									$czf=$tpf=0;
									if($row['lpy']==$sy && $row['lpm']==$sm ){//֧��������ѡ���·ݼ���ɱ�
										$jb=$this->salaryClass->decryptDeal($row['basenowam']);
										if(empty($jb)||round($jb)==0||$jb==0){
											$jb=round( $this->salaryClass->decryptDeal($row['baseam'])
													+$this->salaryClass->decryptDeal($row['gwam'])
													+$this->salaryClass->decryptDeal($row['jxam'])
													,2);
										}
										//��������=��������+�����+��ְ����
										$jb=round($jb+$this->salaryClass->decryptDeal($row['sperewam'])+$this->salaryClass->decryptDeal($row['accrewam']),2);
										if($row['lpy']==2013 && $row['lpm']==12 && ( $row['username']=='Ѧ��' || $row['username']=='����'  ) ){
											$jb=round($this->salaryClass->decryptDeal($row['accrewam']),2);
										}
										$xm=round($this->salaryClass->decryptDeal($row['proam'])
												+$this->salaryClass->decryptDeal($row['bonusam'])+$this->salaryClass->decryptDeal($row['floatam']),2);
										//�������ڼ��ղ������ɲͲ���+ͨ�Ž��� �� ����������������������������
										$bt=round($this->salaryClass->decryptDeal($row['sdyam'])  ,2);
										$fl=round($this->salaryClass->decryptDeal($row['otheram']),2);

										$kc=round($this->salaryClass->decryptDeal($row['holsdelam'])+$this->salaryClass->decryptDeal($row['othdelam'])
												+$this->salaryClass->decryptDeal($row['spedelam'])+$this->salaryClass->decryptDeal($row['accdelam']),2);
										//˰��۳�
										$shkc=round($this->salaryClass->decryptDeal($row['accdelam']),2);
										$txjt=round($this->salaryClass->decryptDeal($row['txjt']),2);
										$yf=round($jb+$xm+$bt+$fl-$kc+$txjt ,2);
										$djgs=$this->salaryClass->decryptDeal($row['paycesse']);
										$sf=round($this->salaryClass->decryptDeal($row['paytotal']),2);
										$prs=1;
									}
									if($row['ldy']==$sy && $row['ldm']==$sm ){//������ְ
										$djshb=$this->salaryClass->decryptDeal($row['shbam']);
										$djgjj=$this->salaryClass->decryptDeal($row['gjjam']);

										$gsshb=$this->salaryClass->decryptDeal($row['coshbam']);
										$gsgjj=$this->salaryClass->decryptDeal($row['cogjjam']);
										$glam=$this->salaryClass->decryptDeal($row['manageam']);

										$czf=$this->salaryClass->decryptDeal($row['HandicapAm']);
										$tpf=$this->salaryClass->decryptDeal($row['PrepareAm']);

										$rs=1;
									}
									$dj=round($djgs+$djshb+$djgjj,2);
									if($ty=='hr'&&empty($func_limit['���²鿴�����'])){//����Ȩ��
										$jb=$xm=$yf=$djgs=$sf=$dj=$bt=0;
									}
									if($row['expflag']=='1'){
										$data[$row['deptname']]['jbep']+=$jb;
										$data[$row['deptname']]['xmep']+=$xm;
										$data[$row['deptname']]['btep']+=$bt;
										$data[$row['deptname']]['flep']+=$fl;
										$data[$row['deptname']]['kcep']+=$kc;
										$data[$row['deptname']]['shkcep']+=$shkc;
										$data[$row['deptname']]['txjtep']+=$txjt;
										$data[$row['deptname']]['yfep']+=$yf;
										$data[$row['deptname']]['djgsep']+=$djgs;
										$data[$row['deptname']]['djshbep']+=$djshb;
										$data[$row['deptname']]['djgjjep']+=$djgjj;
										$data[$row['deptname']]['sfep']+=$sf;
										$data[$row['deptname']]['gsshbep']+=$gsshb;
										$data[$row['deptname']]['gsgjjep']+=$gsgjj;
										$data[$row['deptname']]['glep']+=$glam;
										$data[$row['deptname']]['czfep']+=$czf;
										$data[$row['deptname']]['tpfep']+=$tpf;
										$data[$row['deptname']]['rsep']+=$rs;
										$data[$row['deptname']]['prsep']+=$prs;
									}else{
										$data[$row['deptname']]['jb'.$row['company']]+=$jb;
										$data[$row['deptname']]['xm'.$row['company']]+=$xm;
										$data[$row['deptname']]['bt'.$row['company']]+=$bt;
										$data[$row['deptname']]['fl'.$row['company']]+=$fl;
										$data[$row['deptname']]['kc'.$row['company']]+=$kc;
										$data[$row['deptname']]['shkc'.$row['company']]+=$shkc;
										$data[$row['deptname']]['txjt'.$row['company']]+=$txjt;
										$data[$row['deptname']]['yf'.$row['company']]+=$yf;
										$data[$row['deptname']]['djgs'.$row['company']]+=$djgs;
										$data[$row['deptname']]['djshb'.$row['jfcom']]+=$djshb;
										$data[$row['deptname']]['djgjj'.$row['jfcom']]+=$djgjj;
										$data[$row['deptname']]['sf'.$row['company']]+=$sf;
										$data[$row['deptname']]['gsshb'.$row['jfcom']]+=$gsshb;
										$data[$row['deptname']]['gsgjj'.$row['jfcom']]+=$gsgjj;
										$data[$row['deptname']]['gl'.$row['company']]+=$glam;
										$data[$row['deptname']]['czf'.$row['company']]+=$czf;
										$data[$row['deptname']]['tpf'.$row['company']]+=$tpf;
										$data[$row['deptname']]['rs'.$row['company']]+=$rs;
										$data[$row['deptname']]['prs'.$row['company']]+=$prs;
									}
									//��
									$data[$row['deptname']]['jb']+=$jb;
									$data[$row['deptname']]['xm']+=$xm;
									$data[$row['deptname']]['bt']+=$bt;
									$data[$row['deptname']]['fl']+=$fl;
									$data[$row['deptname']]['kc']+=$kc;
									$data[$row['deptname']]['shkc']+=$shkc;
									$data[$row['deptname']]['txjt']+=$txjt;
									$data[$row['deptname']]['yf']+=$yf;
									$data[$row['deptname']]['djgs']+=$djgs;
									$data[$row['deptname']]['djshb']+=$djshb;
									$data[$row['deptname']]['djgjj']+=$djgjj;
									$data[$row['deptname']]['sf']+=$sf;
									$data[$row['deptname']]['gsshb']+=$gsshb;
									$data[$row['deptname']]['gsgjj']+=$gsgjj;
									$data[$row['deptname']]['gl']+=$glam;
									$data[$row['deptname']]['czf']+=$czf;
									$data[$row['deptname']]['tpf']+=$tpf;
									$data[$row['deptname']]['rs']+=$rs;
									$data[$row['deptname']]['prs']+=$prs;
								}


								//���ñ�ͷ����ʽ ����
								$i = 4;
								if(!empty($deptarr)&&!empty($data)){
									$row = $i;//ǰ4��Ϊ��ͷ
									$n=0;
									$n2=0;
									$p=0;
									$tol=array();
									$tolnbx=array();
									$p2=$row;//�������ſ�ʼ��
									foreach($deptarr as $key2=>$val2){
										$num2=0;
										$num=count($val2);
										$showtol=false;
										foreach($val2 as $key=>$val){
											$showtol=true;
											$p=($n+$row);
											$valNum=0;
											foreach($val as $vkey=>$vval ){
												if(empty($data[$vval])){
													//$num2--;
													continue;
												}

												//��ȡ����
												$tol[]=$row + $n;
												if($key!='��Ѷר��'){//ͳ�Ʋ�����Ѷר��
													$tolnbx[]=$row + $n;
												}
												$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow ( 0, $row + $n, iconv ( "gb2312", "utf-8", $key2 ) );
												$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow ( 1, $row + $n, iconv ( "gb2312", "utf-8", $key ) );
												$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow ( 2, $row + $n, iconv ( "gb2312", "utf-8", $vval ) );
												$m = 3;

												foreach ( $data[$vval] as $field => $value ) {
													$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow ( $m, $row + $n, $value  );
													$m ++;
												}
												$n ++;
												$num2++;
											}
											if(count($val)>1&&$showtol){
												//$n ++;//ÿһ��
												//�ϲ���������
												// $objPhpExcelFile->getActiveSheet ()->mergeCells ( 'B' . ($row+$n-count($val)-1) . ':' . 'B' . ($row+$n-1) );
												//$num2+=count($val);//������������
												//                          }
										}

										if($num>1){
											//�ϲ���������
											//$objPhpExcelFile->getActiveSheet ()->mergeCells ( 'A' . $p2 . ':' . 'A' . ($p2+$num2-1));
										}
									}
									$p2 =$p2+$num2;
								}

								//����Ѷ
								$objPhpExcelFile->getActiveSheet()->getStyle( 'A'.($row + $n).':BU'.($row + $n))->getFont()->setSize(10);
								$objPhpExcelFile->getActiveSheet()->getStyle( 'A'.($row + $n).':BU'.($row + $n))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setRGB('8FBC8F');
								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow ( 0, $row + $n, iconv ( "gb2312", "utf-8", '�ϼ�' ) );
								// $objPhpExcelFile->getActiveSheet ()->mergeCells ('A' . ($n+$row).':'.'B' . ($n+$row) );
								$m = 3;
								foreach ( $datacells as $field => $value ) {
									$str='';
									foreach($tol as $val){
										$str.=$gl->numToCell($m).$val.',';
									}
									if(!empty($str)){
										$objPhpExcelFile->getActiveSheet ()
											->setCellValueByColumnAndRow ( $m, $row + $n, '=SUM('.trim($str,',').')' );
													}
													$m ++;
													}

													}
													$objPhpExcelFile->setActiveSheetIndex(0);
													//            print_r($deptarr);
													}elseif($flag=='lin'){//������ְ��Ϣ
													$bi=3;
													$dataarr=array();
													$dataarr=$this->model_hr_leave_manager_list('xls');
													$setString=array(0//Ա����
														,'AD'//�˺�
														,'AF'
														);
													//print_r($dataarr);
													}elseif($flag=='ext'){//��������Ϣ
													$bi=2;
													$dataarr=array();
													$dataarr=$this->model_hr_user_ext('xls');
													$setString=array('U','S','T');
													//print_r($dataarr);
													}elseif($flag=='dp_lin'){//������ְ��Ϣ
														global $func_limit;
														$sqlflag='';
														$dppow=$this->model_dp_pow();
														$sqlflag=$this->getSqlParam($func_limit['�������'],$dppow);
														$bi=3;
														$dataarr=array();
														$dataarr=$this->model_hr_leave_manager_list('xls',$sqlflag);
														$setString=array(0//Ա����
																,26//�˺�
																);
														//print_r($dataarr);
													}elseif($flag=='hr_sdy'){//���²�����Ϣ
														global $func_limit;
														$bi=2;
														$dataarr=array();
														$sy=$_REQUEST['sy'];
														$sm=$_REQUEST['sm'];
														if(!empty($sy)){
															$sqlstr.=" and s.pyear='".$sy."' ";
														}
														if($sm!='-'){
															$sqlstr.=" and s.pmon='".$sm."' ";
														}
														$tflag=array('0'=>'�ܼ�¼��','1'=>'����¼��','2'=>'����¼��');
														$sql="select
															s.pyear , s.pmon , h.usercard , u.user_name as username , u.company
															, d.dept_name as dn , dt.dept_name as dtn
															, s.sdymeal , s.sdyother
															, s.remark
															, s.flaflag
															, f.sta as fsta , s.userid
															from salary_sdy s
															left join user u on (s.userid=u.user_id)
															left join department d on (u.dept_id=d.dept_id)
															left join department dt on (dt.depart_x=left(d.depart_x,2))
															left join hrms h on (u.user_id=h.user_id)
															left join salary_flow f on ( s.rand_key=f.salarykey )
															where
															s.userid=u.user_id
															$sqlstr
															order by s.pyear , s.pmon
															";
														$query = $this->db->query($sql);
														while ($row = $this->db->fetch_array($query)) {
															$dataarr[]=un_iconv(array(
																		'sy'=>$row['pyear']
																		,'sm'=>$row['pmon']
																		,'uc'=>$row['usercard']
																		,'un'=>$row['username']
																		,'com'=>$this->salaryCom[$row['company']]
																		,'dtn'=>$row['dtn']
																		,'dn'=>$row['dn']
																		,'odtn'=>$row['userid']//��ʱ����
																		,'odn'=>$row['company']//��ʱ����
																		,'sdymeal'=>$this->salaryClass->decryptDeal($row['sdymeal'])
																		,'sdyother'=>$this->salaryClass->decryptDeal($row['sdyother'])
																		,'remark'=>$row['remark']
																		,'flag'=>$tflag[$row['flaflag']]
																		,'sta'=>($row['flaflag']=='0'?'���':$this->flowSta[$row['fsta']])
																		));
														}
														if(!empty($dataarr)){
															foreach($dataarr as $key=>$val){
																//$comtable=$this->get_com_sql($val['odn']);
																$sql="select  d.dept_name as odn , dt.dept_name as odtn
																	from salary_pay p
																	left join department d on (p.deptid=d.dept_id)
																	left join department dt on (dt.depart_x=left(d.depart_x,2))
																	where p.userid='".$val['odtn']."'
																	and p.pyear='".$val['sy']."' and p.pmon='".$val['sm']."'
																	";
																$res=un_iconv($this->db->get_one($sql));
																$dataarr[$key]['odtn']=$res['odtn'];
																$dataarr[$key]['odn']=$res['odn'];
															}
														}

														$setString=array(2//Ա����
																);
														//print_r($dataarr);
													}elseif($flag=='hr_div'){//����ר�����ݵ���
														global $func_limit;
														$bi=2;
														$dataarr=array();
														$dataarr=$this->model_hr_user_div('xls');
														$setString=array(0//Ա����
																);
														//print_r($dataarr);
													}elseif($flag=='dp_detail'){
														$bi=2;
														$dataarr=array();
														$dataarr=$this->model_dp_user('xls');
														$setString=array(0//Ա����
																);
													}elseif($flag=='hr_detail'){
														$bi=2;
														$dataarr=array();
														$dataarr=$this->model_hr_user(true,'',false,false,'xls',$flag);
														$setString=array(0//Ա����
																,'A','AN','AL'
																);
													}elseif($flag=='hr_jf'){
														$bi=2;
														$dataarr=array();
														$dataarr=$this->model_hr_pay_list('xls');
														$setString=array('A','B');
													}elseif($flag=='fn_pro'){//��Ŀ����ͳ�Ʊ�

														$is_echo=false;//�ر�
														$bi=4;
														$syear=$_REQUEST['sy'];
														$smon=$_REQUEST['sm'];
														$sdtb=date('Y-m-d',  strtotime($syear.'-'.$smon.'-1'));
														$sdte=date('Y-m-t',  strtotime($sdtb));
														$objPhpExcelFile->setActiveSheetIndex(0);
														$objPhpExcelFile->getActiveSheet ()->setTitle ( iconv ( "gb2312", "utf-8", '������Ŀͳ��' ) );
														if(true){//���¸��±������� true
															$sql="delete i  FROM salary_type_info  i
																left join salary_user_type t on (t.id=i.typeid )
																where  pyear='".$syear."' and pmon='".$smon."'  and t.id=i.typeid  ";
															$this->db->query($sql);
															$sql="delete i  FROM salary_user_type_info  i
																left join salary_user_type t on (t.id=i.typeid )
																where  pyear='".$syear."' and pmon='".$smon."'  and t.id=i.typeid  ";
															$this->db->query($sql);
															$sql="delete t  FROM  salary_user_type t where  pyear='".$syear."' and pmon='".$smon."'  ";
															$this->db->query($sql);
														}
														$sql="select count(*) as am
															from salary_user_type where pyear='".$syear."' and pmon='".$smon."'  ";
														$res = $this->db->get_one($sql);
														if( (empty($res['am'])&&( ($syear>2012) || ($syear==$this->nowy && $smon<$this->nowm) || $syear<$this->nowy ) )){
															//������Ч��Ŀ��Ϣ
															$sql="insert into  salary_user_type (name ,type , members , membersn, pyear
																, pmon , rand_key , pid , deptname , zfpro
																, proname , procode   )
																select  r.name ,'pro' , r.developer , '' as membersn , '".$syear."'
																,  '".$smon."'  , rand() , r.id , d.DEPT_NAME as deptname , zf.project_name as zfpro
																,  r.name as proname  , r.number  as procode
																from project_rd r
																left join department d on (r.dept_id = d.dept_id)
																left join project_ipo zf on (r.zf_id=zf.id)
																where r.is_delete=0 and status in (0)  ";
															$this->db->query($sql);
															$esm=array();
															$esmarr=array();
															$esmw=array();
															//ȫ��Ա
															$sql="select
																c.createId,c.createName,c.deptName,c.projectCode,c.projectId,c.projectName,round(sum(c.inWorkRate/100),2) as inWorkRate,sum(c.costMoney) as costMoney,
																sum(c.thisProjectProcess) as thisProjectProcess,round(sum(c.inWorkRate/100),2) as inWorkRateOne,
																sum(c.processCoefficient) as processCoefficient,sum(c.workCoefficient) as workCoefficient
																	, p.productLineName as deptname,p.attribute 
																	from
																	oa_esm_worklog c
																	LEFT JOIN oa_esm_project p on ( p.id = c.projectId )
																	left join department d on (d.dept_id = c.deptid )
																	where 1 and c.executionDate >= '".$sdtb."' and c.executionDate <= '".$sdte."'
																	and c.confirmStatus = '1'
																	group by c.createId,c.projectId ";
															$query=$this->db->query($sql);
															while($row=$this->db->fetch_array($query)){
																$esm[$row['projectCode']]['name']=$row['projectName'];
																$esm[$row['projectCode']]['deptname']=$row['deptname'];
																$esm[$row['projectCode']]['projectId']=$row['projectId'];
																$esmarr[$row['projectCode']][$row['createId']]['work']=$row['inWorkRate'];
																//�ж���Ŀ�����Ƿ�GCXMSS-05�����������Ŀ���з���Ŀ���������Ŀ�ǹ�����Ŀ
																$esm[$row['projectCode']]['type']=$row['attribute']=="GCXMSS-05"?"pro":"esm";
															}
															if(!empty($esm)){
																foreach($esm as $key=>$val){
																	$sql="insert into  salary_user_type (name , deptname  ,type , members , membersn, pyear , pmon , rand_key
																		, pid , proname , procode  )
																		values ( '".$val['name'].'-'.$key."' , '".$val['deptname']."'  , '".$val['type']."' , '', '', '".$syear."' ,  '".$smon."'  , rand()
																				, '".$val['projectId']."'  , '".$val['name']."'  , '".$key."'   )";
																	$this->db->query($sql);
																	$esm[$key]['id']=$this->db->insert_id();
																}
															}
															if(!empty($esmarr)){
																foreach($esmarr as $key=>$val){
																	foreach($val as $vkey=>$vval){
																		$tmp=round($vval['work']/date('t',  strtotime($syear.'-'.$smon.'-01'))*100,4);
																		$sql="insert into  salary_type_info (userid ,typeid , percent , addtime , leavetime , workdts )
																			values ( '".$vkey."' , '".$esm[$key]['id']."' , '".$tmp."' , null , null ,'".$vval['work']."' ) ";
																		$this->db->query($sql);
																		$esmw[$vkey]['esm']=empty($esmw[$vkey]['esm'])?$tmp:$esmw[$vkey]['esm']+$tmp;
																	}
																}
															}
															unset($esm);
															//������Ч������Ϣ
															$sql="insert into  salary_user_type (name ,type , members , membersn, pyear , pmon , rand_key , pid , deptname
																, proname , procode  )
																SELECT d.dept_name , 'dept' , '' as developer  , '' as membersn , '".$syear."' ,  '".$smon."'  , rand() , d.dept_id , d.dept_name as deptname
																, d.dept_name as proname , d.dept_id as procode
																FROM  department d  where  d.delflag=0 order by d.pdeptname ,  d.depart_x ";
															$this->db->query($sql);
															$esmarr=array();
															//������Ŀ��Առ������--ȫ��Ա
															$sql="SELECT a.account , t.id , a.percent , a.addtime , a.leavetime  FROM project_rd_action a
																left join user u on (u.user_id=a.account)
																left join department d on (u.dept_id=d.dept_id)
																left join salary_user_type t on (a.project = t.pid and t.type='pro')
																where t.pyear='".$syear."' and t.pmon='".$smon."'
																and
																(
																 (a.addtime='0000-00-00 00:00:00' and  a.leavetime='0000-00-00 00:00:00' )
																 or ( to_days(a.addtime)<to_days('".$sdte."')  and ( a.leavetime='0000-00-00 00:00:00'  or  to_days(a.leavetime)>to_days('".$sdtb."')  )  )
																 or (  to_days(a.leavetime)>to_days('".$sdtb."') and ( a.addtime='0000-00-00 00:00:00'  or  to_days(a.addtime)<to_days('".$sdte."')  ) )
																)
																and a.percent>0
																order by a.id ";
															$query=$this->db->query($sql);
															while($row=$this->db->fetch_array($query)){
																if(!empty($esmw[$row['account']]['esm'])){
																	$esmarr[$row['account']][$row['id']]['w']=round($row['percent']*(100-$esmw[$row['account']]['esm'])/100,4);
																}else{
																	$esmarr[$row['account']][$row['id']]['w']=$row['percent'];
																}
																$esmarr[$row['account']][$row['id']]['b']=$row['addtime'];
																$esmarr[$row['account']][$row['id']]['e']=$row['leavetime'];
																$esmarr[$row['account']][$row['id']]['percent']=$row['percent'];
															}
															if(!empty($esmarr)){
																foreach($esmarr as $key=>$val){
																	foreach($val as $vkey=>$vval){
																		$sql="insert into  salary_type_info (userid ,typeid , percent , addtime , leavetime , workper )
																			values ( '".$key."' , '".$vkey."' , '".$vval['w']."' , '".$vval['b']."' , '".$vval['e']."', '".$vval['percent']."'  ) ";
																		$this->db->query($sql);
																	}
																}
															}
															//��ȡ���²�����Ա��������
															$sql="insert into  salary_type_info (userid ,typeid , percent , addtime , leavetime )
																select p.userid , t.id , if(i.percent is null , 100 ,  100-i.percent ) as percent  , '".$sdtb."' , '".$sdte."'
																from  (
																		( SELECT p.userid , p.deptid   FROM salary_pay p
																		  left join department d on (p.deptid=d.dept_id )
																		  where
																		  d.delflag=0
																		  and p.leaveflag=0 and ( (p.nowamflag!=3 and p.nowamflag!=4) or p.nowamflag is null )
																		  and p.pyear='".$syear."' and p.pmon='".$smon."'
																		)  ) p
																left join salary_user_type t on (p.deptid = t.pid and t.type='dept' )
																left join (
																		select i.userid , sum(i.percent) as percent   from salary_type_info i
																		left join salary_user_type t on ( t.id=i.typeid  )
																		where t.pyear='".$syear."' and t.pmon='".$smon."' group by i.userid
																	  ) i  on ( i.userid = p.userid  )
																where t.pyear='".$syear."' and t.pmon='".$smon."' and p.deptid = t.pid and t.type='dept' ";
															$this->db->query($sql);
															//������
															$proArr=array();
															$sql="SELECT t.id ,  t.name , t.pyear , t.pmon , p.userid ,i.percent as percent
																, basenowam , baseam,sperewam,accrewam,proam,bonusam,floatam
																,sdyam,holsdelam,othdelam,spedelam,accdelam
																,coshbam,cogjjam
																, p.totalam  , p.shbam , p.gjjam , p.paycesse , p.paytotal  , CONCAT(p.usercom,IF(p.ExpFlag=0,'',p.ExpFlag)) as com
																, p.deptid , p.salarydept
																, p.gwam , p.jxam , p.txjt
																FROM salary_user_type t
																left join salary_type_info i on (t.id=i.typeid)
																left join salary_pay p on ( p.userid=i.userid and p.pyear=t.pyear and p.pmon=t.pmon )
																where p.id is not null and t.pyear = '".$syear."' and t.pmon ='".$smon."'
																and p.leaveflag=0 and ( (p.nowamflag!=3 and p.nowamflag!=4) or p.nowamflag is null )  ";
															$query=$this->db->query($sql);
															while($row=$this->db->fetch_array($query)){
																$jb=$this->salaryClass->decryptDeal($row['basenowam']);
																if(empty($jb)||round($jb)==0||$jb==0){
																	$jb=round( $this->salaryClass->decryptDeal($row['baseam'])
																			+$this->salaryClass->decryptDeal($row['gwam'])//��λ����
																			+$this->salaryClass->decryptDeal($row['jxam'])//��Ч����
																			,2);
																}
																//��������=��������+˰ǰ��������+˰�󲹷�����
																$jb=round($jb+$this->salaryClass->decryptDeal($row['sperewam'])+$this->salaryClass->decryptDeal($row['accrewam']),2);
																$xm=round($this->salaryClass->decryptDeal($row['proam'])
																		+$this->salaryClass->decryptDeal($row['bonusam'])+$this->salaryClass->decryptDeal($row['floatam']),2);
																//�������ڼ��ղ������ɲͲ���+ ͨ�Ž��� �� ����������������������������
																$bt=round($this->salaryClass->decryptDeal($row['sdyam']) +$this->salaryClass->decryptDeal($row['txjt']) ,2);
																//�۳�
																$kc=round($this->salaryClass->decryptDeal($row['holsdelam'])+$this->salaryClass->decryptDeal($row['othdelam'])
																		+$this->salaryClass->decryptDeal($row['spedelam']),2);//�۳��������˰��۳�+$this->salaryClass->decryptDeal($row['accdelam'])
																//˰��۳�
																$shkc=round($this->salaryClass->decryptDeal($row['accdelam']),2);
																$yftotal=round($jb+$xm+$bt-$kc,2);//�з� = ��������+˰ǰ��������+˰�󲹷�����+��Ŀ��+�ڼ��ղ���-�۳� ���������������㣩
																//��˾�籣������ 20130708 ��ʾ��˾�籣������
																$gsshb=$this->salaryClass->decryptDeal($row['coshbam']);
																$gsgjj=$this->salaryClass->decryptDeal($row['cogjjam']);

																$proArr[$row['id']][$row['deptid']]['deptname'] = $row['salarydept'];
																$proArr[$row['id']][$row['deptid']][$row['com'].'totalam']=isset($proArr[$row['id']][$row['deptid']][$row['com'].'totalam'])?round($proArr[$row['id']][$row['deptid']][$row['com'].'totalam']+($yftotal*$row['percent']/100),2):($yftotal*$row['percent']/100);
																$proArr[$row['id']][$row['deptid']][$row['com'].'shbam']=isset($proArr[$row['id']][$row['deptid']][$row['com'].'shbam'])?round($proArr[$row['id']][$row['deptid']][$row['com'].'shbam']+($gsshb*$row['percent']/100),2):($gsshb*$row['percent']/100);
																$proArr[$row['id']][$row['deptid']][$row['com'].'gjjam']=isset($proArr[$row['id']][$row['deptid']][$row['com'].'gjjam'])?round($proArr[$row['id']][$row['deptid']][$row['com'].'gjjam']+($gsgjj*$row['percent']/100),2):($gsgjj*$row['percent']/100);
																$proArr[$row['id']][$row['deptid']][$row['com'].'paycesse']=isset($proArr[$row['id']][$row['deptid']][$row['com'].'paycesse'])?round($proArr[$row['id']][$row['deptid']][$row['com'].'paycesse']+($this->salaryClass->decryptDeal($row['paycesse'])*$row['percent']/100),2):($this->salaryClass->decryptDeal($row['paycesse'])*$row['percent']/100);
																$proArr[$row['id']][$row['deptid']][$row['com'].'paytotal']=isset($proArr[$row['id']][$row['deptid']][$row['com'].'paytotal'])?round($proArr[$row['id']][$row['deptid']][$row['com'].'paytotal']+($this->salaryClass->decryptDeal($row['paytotal'])*$row['percent']/100),2):($this->salaryClass->decryptDeal($row['paytotal'])*$row['percent']/100);

																//˰��۳�
																$proArr[$row['id']][$row['deptid']][$row['com'].'shkc']=isset($proArr[$row['id']][$row['deptid']][$row['com'].'shkc'])?round($proArr[$row['id']][$row['deptid']][$row['com'].'shkc']+($shkc*$row['percent']/100),2):($shkc*$row['percent']/100);
															}
															if(!empty($proArr)){
																foreach ($proArr as $key=>$val) {
																	foreach ($val as $vkey =>$vval ){
																		$sql="insert into  salary_user_type_info
																			(  typeid,deptid,deptname,
																			   dltotalam,dlshbam,dlgjjam,dlpaycesse,dlpaytotal,dlshkc,
																			   sytotalam,syshbam,sygjjam,sypaycesse,sypaytotal,syshkc,
																			   brtotalam,brshbam,brgjjam,brpaycesse,brpaytotal,brshkc,
																			   bxtotalam,bxshbam,bxgjjam,bxpaycesse,bxpaytotal,bxshkc,
																			   bx1totalam,bx1shbam,bx1gjjam,bx1paycesse,bx1paytotal,bx1shkc
																			)
																			values ( '".$key."' , '".$vkey."' , '".$vval['deptname']."'
																					, '".$vval['dltotalam']."' , '".$vval['dlshbam']."', '".$vval['dlgjjam']."'   , '".$vval['dlpaycesse']."', '".$vval['dlpaytotal']."', '".$vval['dlshkc']."'
																					, '".$vval['sytotalam']."' , '".$vval['syshbam']."', '".$vval['sygjjam']."'   , '".$vval['sypaycesse']."', '".$vval['sypaytotal']."', '".$vval['syshkc']."'
																					, '".$vval['brtotalam']."' , '".$vval['brshbam']."', '".$vval['brgjjam']."'   , '".$vval['brpaycesse']."', '".$vval['brpaytotal']."', '".$vval['brshkc']."'
																					, '".$vval['bxtotalam']."' , '".$vval['bxshbam']."', '".$vval['bxgjjam']."'   , '".$vval['bxpaycesse']."', '".$vval['bxpaytotal']."', '".$vval['bxshkc']."'
																					, '".$vval['bx1totalam']."' , '".$vval['bx1shbam']."', '".$vval['bx1gjjam']."'   , '".$vval['bx1paycesse']."', '".$vval['bx1paytotal']."', '".$vval['bx1shkc']."' " .//��Ѷ����
																					"                                   ) ";
																					$this->db->query($sql);
																					}

																					}
																					}
																					}
																					//1.������Ŀ����=����/������Ȼ��*���¹�����Ŀ�˹�Ͷ�롣�����ڹ��̵��˹�Ͷ�����Ե�����Ȼ����������������Ҫ���Ե�����Ȼ�ա���
																					//2.ʣ���˹�Ͷ�빤��=����-������Ŀ���ʡ�
																					//3.�з���Ŀ����=ʣ���˹�Ͷ�빤��*�з���Ŀ����ռ�ȡ�
																					//4.���ʲ��Ź����=ʣ���˹�Ͷ�빤��-�з���Ŀ���ʡ�

																					$sql="select t.id ,  t.name
																					, ti.dltotalam , ti.dlshbam , ti.dlgjjam , ti.dlpaycesse ,ti.dlpaytotal,ti.dlshkc
																					, ti.sytotalam , ti.syshbam , ti.sygjjam , ti.sypaycesse ,ti.sypaytotal,ti.syshkc
																					, ti.brtotalam , ti.brshbam , ti.brgjjam , ti.brpaycesse ,ti.brpaytotal,ti.brshkc
																					, ti.bxtotalam , ti.bxshbam , ti.bxgjjam , ti.bxpaycesse ,ti.bxpaytotal,ti.bxshkc
																					,ti.bx1totalam , ti.bx1shbam , ti.bx1gjjam , ti.bx1paycesse ,ti.bx1paytotal,ti.bx1shkc
																					, ti.deptname as idept
																					, ti.id as iid
																					, t.pmon , t.type  as iponame
																					, t.deptname , t.zfpro as zfname
																					, di.pdeptname
																					, t.proname , t.procode
																					from salary_user_type_info ti
																					left join salary_user_type t on ( ti.typeid = t.id )
																					left join department di on ( di.dept_id = ti.deptid  )
																					where t.pyear='".$syear."' and t.pmon='".$smon."' order by t.type,t.procode ";//�Ȱ���Ŀ���������ٰ���Ŀ������� by chengl 20140722
																					$query=$this->db->query($sql);
															$resData=array();
															$itype= array('pro'=>'�з���Ŀ' , 'esm'=>'������Ŀ', 'dept'=>'���Ź����' );

															while($row=$this->db->fetch_array($query)){
																$resData[$row['id']][$row['iid']]=un_iconv(array(
																			'name'=>$row['proname'],
																			'code'=>$row['procode'],
																			'iponame'=>$itype[$row['iponame']]
																			,'deptname'=>$row['deptname']
																			,'zfname'=>$row['zfname']
																			//,'deptname'=>$row['deptname']//��������
																			,'pdeptname'=>$row['pdeptname']//��������
																			,'idept'=>$row['idept']//�ļ�����

																			,'totalam'=>round($row['dltotalam']+ $row['sytotalam']+ $row['brtotalam'] +$row['bxtotalam']+$row['bx1totalam'],2)
																			,'shbam'=>round($row['dlshbam']+ $row['syshbam']+ $row['brshbam'] +$row['bxshbam'] +$row['bx1shbam'],2)
																			,'gjjam'=>round($row['dlgjjam']+ $row['sygjjam']+ $row['brgjjam'] +$row['bxgjjam'] +$row['bx1gjjam'],2)
																			,'paycesse'=>round($row['dlpaycesse']+ $row['sypaycesse']+ $row['brpaycesse'] +$row['bxpaycesse']+$row['bx1paycesse'],2)
																			,'paytotal'=>round($row['dlpaytotal']+ $row['sypaytotal']+ $row['brpaytotal'] +$row['bxpaytotal']+$row['bx1paytotal'],2)
																			,'shkc'=>round($row['dlshkc']+ $row['syshkc']+ $row['brshkc'] +$row['bxshkc']+$row['bx1shkc'],2)

																			,'dltotalam'=>round($row['dltotalam'],2),'dlshbam'=>round($row['dlshbam'],2)
																			,'dlgjjam'=>round($row['dlgjjam'],2),'dlpaycesse'=>round($row['dlpaycesse'],2),'dlpaytotal'=>round($row['dlpaytotal'],2)
																			,'dlshkc'=>round($row['dlshkc'],2)

																			,'sytotalam'=>round($row['sytotalam'],2),'syshbam'=>round($row['syshbam'],2)
																			,'sygjjam'=>round($row['sygjjam'],2),'sypaycesse'=>round($row['sypaycesse'],2),'sypaytotal'=>round($row['sypaytotal'],2)
																			,'syshkc'=>round($row['syshkc'],2)

																			,'brtotalam'=>round($row['brtotalam'],2),'brshbam'=>round($row['brshbam'],2)
																			,'brgjjam'=>round($row['brgjjam'],2),'brpaycesse'=>round($row['brpaycesse'],2),'brpaytotal'=>round($row['brpaytotal'],2)
																			,'brshkc'=>round($row['brshkc'],2)

																			,'bxtotalam'=>round($row['bxtotalam'],2),'bxshbam'=>round($row['bxshbam'],2)
																			,'bxgjjam'=>round($row['bxgjjam'],2),'bxpaycesse'=>round($row['bxpaycesse'],2),'bxpaytotal'=>round($row['bxpaytotal'],2)
																			,'bxshkc'=>round($row['bxshkc'],2)
																			,'bx1totalam'=>round($row['bx1totalam'],2),'bx1shbam'=>round($row['bx1shbam'],2)
																			,'bx1gjjam'=>round($row['bx1gjjam'],2),'bx1paycesse'=>round($row['bx1paycesse'],2),'bx1paytotal'=>round($row['bx1paytotal'],2)
																			,'bx1shkc'=>round($row['bx1shkc'],2)
																			)
																			);
															}
															if($resData){
																$i=$bi ;

																foreach($resData as $key=>$val){

																	foreach ( $val as $vkey => $row ){//ѭ����
																		$n=0;
																		foreach ( $row as $rval ){//ѭ����
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow ($n , $i, $rval );
																			$n++;
																		}

																		$i++;
																	}

																	$pi = $i -1 ;
																}
																//���ͳ�� add by chengl 20140722
																$countArr=array();
																$countArr[0]="H4:H$pi";
																$countArr[1]="I4:I$pi";
																$countArr[2]="J4:J$pi";
																$countArr[3]="K4:K$pi";
																$countArr[4]="L4:L$pi";
																$countArr[5]="M4:M$pi";
																$countArr[6]="N4:N$pi";
																$countArr[7]="O4:O$pi";
																$countArr[8]="P4:P$pi";
																$countArr[9]="Q4:Q$pi";
																$countArr[10]="R4:R$pi";
																$countArr[11]="S4:S$pi";
																$countArr[12]="T4:T$pi";
																$countArr[13]="U4:U$pi";
																$countArr[14]="V4:V$pi";
																$countArr[15]="W4:W$pi";
																$countArr[16]="X4:X$pi";
																$countArr[17]="Y4:Y$pi";
																$countArr[18]="Z4:Z$pi";
																$countArr[19]="AA4:AA$pi";
																$countArr[20]="AB4:AB$pi";
																$countArr[21]="AC4:AC$pi";
																$countArr[22]="AD4:AD$pi";
																$countArr[23]="AE4:AE$pi";
																$countArr[24]="AF4:AF$pi";
																$countArr[25]="AG4:AG$pi";
																$countArr[26]="AH4:AH$pi";
																$countArr[27]="AI4:AI$pi";
																$countArr[28]="AJ4:AJ$pi";
																$countArr[29]="AK4:AK$pi";
																$countArr[30]="AL4:AL$pi";
																$countArr[31]="AM4:AM$pi";
																$countArr[32]="AN4:AN$pi";
																$countArr[33]="AO4:AO$pi";
																$countArr[34]="AP4:AP$pi";
																$countArr[35]="AQ4:AQ$pi";

																//�ϼƴ��� add by chengl 20140722
																//=SUM('.'B'.$n.','.'C'.$n.','.'D'.$n.','.'E'.$n.','.'F'.$n.','.'G'.$n.')
																foreach($countArr as $key=>$val){
																	$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (7+$key, $i, "=SUM($val)" );//�У���
																}

															}//��Ŀ
															//����ռ����ϸ
															$objPhpExcelFile->setActiveSheetIndex(1);
															$objPhpExcelFile->getActiveSheet ()->setTitle ( iconv ( "gb2312", "utf-8", '��������ϸ��' ) );
															$sql="select t.id ,  t.name , t.type  as iponame
																, u.USER_NAME , h.UserCard ,i.percent , i.workdts , i.workper , p.usercom
																, t.proname , t.procode
																from salary_type_info i
																left join salary_user_type t on ( i.typeid = t.id )
																LEFT JOIN hrms h on (i.userid = h.USER_ID )
																LEFT JOIN user u on (i.userid = u.user_id)
																LEFT JOIN salary_pay p on (i.userid = p.UserId and p.PYear = t.pyear and p.PMon = t.pmon )
																where  p.leaveflag=0 and ( (p.nowamflag!=3 and p.nowamflag!=4) or p.nowamflag is null )
																and t.pyear='".$syear."' and t.pmon='".$smon."'  ";
															$query=$this->db->query($sql);
															$resData=array();
															while($row=$this->db->fetch_array($query)){
																$resData[$row['id']][$row['UserCard']]=un_iconv(array(
																			'name'=>$row['proname'],
																			'code'=>$row['procode'],
																			'iponame'=>$itype[$row['iponame']]
																			,'UserCard'=>$row['UserCard']
																			,'USER_NAME'=>$row['USER_NAME']
																			,'percent'=>$row['percent']
																			,'workdts'=>$row['workdts']
																			,'workper'=>$row['workper']
																			,'usercom'=>$this->salaryCom[$row['usercom']]
																			)
																		);
															}
															if($resData){
																$i=2 ;
																foreach($resData as $key=>$val){

																	foreach ( $val as $vkey => $row ){

																		$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (0 , $i, $row['name'] );
																		$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1 , $i, $row['code'] );
																		$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2 , $i, $row['iponame'] );
																		$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (3 , $i, $row['usercom'] );
																		$objPhpExcelFile->getActiveSheet ()->setCellValueExplicitByColumnAndRow (4 , $i, $row['UserCard'] );
																		$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (5 , $i, $row['USER_NAME'] );
																		$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (6 , $i, $row['percent'] );
																		$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (7 , $i, $row['workper'] );
																		$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (8 , $i, $row['workdts'] );

																		$i++;
																	}

																	$pi = $i -1 ;
																	if( count($val)>1 ){

																		$objPhpExcelFile->getActiveSheet ()->mergeCells ('A' . ($pi-count($val)+1).':'.'A' . ($pi) );//�ϲ�
																		$objPhpExcelFile->getActiveSheet ()->mergeCells ('B' . ($pi-count($val)+1).':'.'B' . ($pi) );//�ϲ�
																		$objPhpExcelFile->getActiveSheet ()->mergeCells ('C' . ($pi-count($val)+1).':'.'C' . ($pi) );//�ϲ�
																	}
																}
															}
															$objPhpExcelFile->setActiveSheetIndex(0);

													}elseif($flag=='gs_tol'){//���ʲ��ŷ�����
														$is_echo=false;//�ر�
														$bi=4;//�������������
														$sy=$_REQUEST['sy'];//���
														$sm=$_REQUEST['sm'];//�·�
														$filename.=$sy.'-'.$sm; //�����ļ���
														$objPhpExcelFile->setActiveSheetIndex(0);
														$data=array();
														$deptarr=array();//������Ϣ
														$deptrep=array();//�Ͳ��ͻ���
														$deptarr['����']['����']='����';
														$sql="SELECT d.dept_name , d.pdeptname , d.dept_id FROM `department` d
															WHERE FIND_IN_SET( '".$sy."' , d.setyear) AND d.DelFlag=0
															ORDER BY d.PARENT_ID , d.subam , d.DEPT_ID";//��ȡ���Ź̶�����
															$sql="SELECT d.dept_name , d.pdeptname , d.dept_id FROM `department_copy` d
															WHERE FIND_IN_SET( '".$sy."' , d.setyear) 
															ORDER BY d.PARENT_ID , d.subam , d.DEPT_ID";//��ȡ���Ź̶�����2,ȥ�� d.DelFlag=0
															$query=$this->db->query($sql);
														while($row=$this->db->fetch_array($query)){
															$deptarr[$row['pdeptname']][$row['dept_id']]=$row['dept_name'];
														}
														//             print_r($deptarr);
														//             die();
														//�ͳ���
														$jfdb = $sy.'-'.$sm.'-01';
														$jfde = $sy.'-'.$sm.'-'.date('t',strtotime($jfdb));
														$wd=$this->salaryClass->getWorkDays($jfdb);
														$zham=330;//�²������
														$ydam=440;
														$zhwdam=$zham/$wd;//�ղ������
														$ydwdam=$ydam/$wd;
														$objPhpExcelFile->setActiveSheetIndex(4);
														if($sy==2014||$sy==2015 || $sy==2016){
															$objPhpExcelFile->setActiveSheetIndex(3);
														}
														$objPhpExcelFile->getActiveSheet ()->setTitle ( iconv ( "gb2312", "utf-8", $sm.'�²ͳ���' ) );
														$dataarr=array();
														$sqlTol=" and ( d.pdeptname not in ('��Ѷר��','����') or  u.user_id ='2903' )  ";
														$sql="select d.dept_name,  sp.area as areaname ,u.company  , d.pdeptname as dtname , 1 as am , u.user_id
															from hrms h
															left join user u on (u.user_id=h.user_id )
															left join  salary_pay  sp on (sp.userid =u.user_id and sp.pyear='".$sy."' and sp.pmon = '".$sm."' )
															left join department_copy d on (sp.deptid=d.dept_id )
															where u.del=0   and ( to_days(h.left_date)>to_days('".$jfde."') or h.left_date is null or h.left_date='0000-00-00'  )
															and  to_days(h.come_date)<=to_days('".$jfde."')
															and u.usertype='1' $sqlTol
															order by d.pdeptid , d.depart_x ";
														$query=$this->db->query($sql);
														while($row=$this->db->fetch_array($query)){
															if($row['dtname']=='����'||$row['dtname']=='�ܾ���'
															  ){
																$row['dept_name']=$row['dtname'];
															}
															if($row['user_id']=='bin.chang'){
																$row['dept_name']='����';
																$row['dtname']='����';
															}
															$dataarr[$row['dept_name']]['pd']=$row['dtname'];
															if($row['areaname']=='�麣'){
																$ckp=$row['company'].'_zh';
															}else{
																$ckp=$row['company'].'_yd';
															}
															$dataarr[$row['dept_name']][$ckp]=empty($dataarr[$row['dept_name']][$ckp])?$row['am']:
																round($dataarr[$row['dept_name']][$ckp]+$row['am']);
														}
														//��ְ��Ա
														$sql="select d.dept_name, sp.area as areaname ,u.company  , d.pdeptname as dtname , h.left_date as ldt , h.come_date as cdt
															from hrms h
															left join user u on (u.user_id=h.user_id )
															left join  salary_pay   sp on (sp.userid =u.user_id and sp.pyear='".$sy."' and sp.pmon = '".$sm."' )
															left join department_copy d on (sp.deptid=d.dept_id )
															where u.del=0  and ( h.left_date is not null and h.left_date<>'0000-00-00')  and to_days(h.left_date)>=to_days('".$jfdb."')
															and to_days(h.left_date)<=to_days('".$jfde."')
															$sqlTol
															order by d.pdeptid , d.depart_x";
														$query=$this->db->query($sql);
														while($row=$this->db->fetch_array($query)){
															if($row['dtname']=='����'||$row['dtname']=='�ܾ���'
															  ){
																$row['dept_name']=$row['dtname'];
															}
															$dataarr[$row['dept_name']]['pd']=$row['dtname'];
															if($row['areaname']=='�麣'){
																$ckp=$row['company'].'_zh_l';
															}else{
																$ckp=$row['company'].'_yd_l';
															}
															$dataarr[$row['dept_name']][$ckp]=empty($dataarr[$row['dept_name']][$ckp])?1:round($dataarr[$row['dept_name']][$ckp]+1);
														}
														//��ȡ�����������Ϣ
														$rep_cb=$repClass->getRepData('gzfuxcb', array('dimY'=>$sy,'dimM'=>$sm),'data');
														if(!empty($rep_cb)){
															if($sy==2016) {
																for($ri=2;$ri<count($rep_cb);$ri++){
																	$dataarr[$rep_cb[$ri][3]['name']]['dl_cb']=$rep_cb[$ri][4]['name'];
																	$dataarr[$rep_cb[$ri][3]['name']]['sy_cb']=$rep_cb[$ri][5]['name'];
																	$dataarr[$rep_cb[$ri][3]['name']]['br_cb']=$rep_cb[$ri][6]['name'];
																	$dataarr[$rep_cb[$ri][3]['name']]['bx_cb']=$rep_cb[$ri][7]['name'];

																	$dataarr[$rep_cb[$ri][3]['name']]['dl_cb_l']=$rep_cb[$ri][8]['name'];
																	$dataarr[$rep_cb[$ri][3]['name']]['sy_cb_l']=$rep_cb[$ri][9]['name'];
																	$dataarr[$rep_cb[$ri][3]['name']]['br_cb_l']=$rep_cb[$ri][10]['name'];
																	$dataarr[$rep_cb[$ri][3]['name']]['bx_cb_l']=$rep_cb[$ri][11]['name'];
																	//��ְ
																	$dataarr[$rep_cb[$ri][3]['name']]['dl_zh']=$rep_cb[$ri][12]['name'];
																	$dataarr[$rep_cb[$ri][3]['name']]['dl_yd']=$rep_cb[$ri][13]['name'];

																	//                     $dataarr[$rep_cb[$ri][1]['name']]['dl_zh']=$rep_cb[$ri][6]['name'];
																	$dataarr[$rep_cb[$ri][3]['name']]['sy_yd']=$rep_cb[$ri][14]['name'];

																	$dataarr[$rep_cb[$ri][3]['name']]['br_zh']=$rep_cb[$ri][15]['name'];
																	$dataarr[$rep_cb[$ri][3]['name']]['br_yd']=$rep_cb[$ri][16]['name'];

																	$dataarr[$rep_cb[$ri][3]['name']]['bx_zh']=$rep_cb[$ri][17]['name'];
																	$dataarr[$rep_cb[$ri][3]['name']]['bx_yd']=$rep_cb[$ri][18]['name'];
																}
															}elseif($sy!=2015){
																for($ri=2;$ri<count($rep_cb);$ri++){

																	$dataarr[$rep_cb[$ri][1]['name']]['dl_cb']=$rep_cb[$ri][2]['name'];
																	$dataarr[$rep_cb[$ri][1]['name']]['sy_cb']=$rep_cb[$ri][3]['name'];
																	$dataarr[$rep_cb[$ri][1]['name']]['br_cb']=$rep_cb[$ri][4]['name'];
																	$dataarr[$rep_cb[$ri][1]['name']]['bx_cb']=$rep_cb[$ri][5]['name'];

																	$dataarr[$rep_cb[$ri][1]['name']]['dl_cb_l']=$rep_cb[$ri][6]['name'];
																	$dataarr[$rep_cb[$ri][1]['name']]['sy_cb_l']=$rep_cb[$ri][7]['name'];
																	$dataarr[$rep_cb[$ri][1]['name']]['br_cb_l']=$rep_cb[$ri][8]['name'];
																	$dataarr[$rep_cb[$ri][1]['name']]['bx_cb_l']=$rep_cb[$ri][9]['name'];
																	//��ְ
																	$dataarr[$rep_cb[$ri][1]['name']]['dl_zh']=$rep_cb[$ri][10]['name'];
																	$dataarr[$rep_cb[$ri][1]['name']]['dl_yd']=$rep_cb[$ri][11]['name'];

																	//                     $dataarr[$rep_cb[$ri][1]['name']]['dl_zh']=$rep_cb[$ri][6]['name'];
																	$dataarr[$rep_cb[$ri][1]['name']]['sy_yd']=$rep_cb[$ri][12]['name'];

																	$dataarr[$rep_cb[$ri][1]['name']]['br_zh']=$rep_cb[$ri][13]['name'];
																	$dataarr[$rep_cb[$ri][1]['name']]['br_yd']=$rep_cb[$ri][14]['name'];

																	$dataarr[$rep_cb[$ri][1]['name']]['bx_zh']=$rep_cb[$ri][15]['name'];
																	$dataarr[$rep_cb[$ri][1]['name']]['bx_yd']=$rep_cb[$ri][16]['name'];

																}
															}else{  //2015��˾���ŷ�����ܹ�
																for($ri=2;$ri<count($rep_cb);$ri++){

																	$dataarr[$rep_cb[$ri][2]['name']]['dl_cb']=$rep_cb[$ri][3]['name'];
																	$dataarr[$rep_cb[$ri][2]['name']]['sy_cb']=$rep_cb[$ri][4]['name'];
																	$dataarr[$rep_cb[$ri][2]['name']]['br_cb']=$rep_cb[$ri][5]['name'];
																	$dataarr[$rep_cb[$ri][2]['name']]['bx_cb']=$rep_cb[$ri][6]['name'];

																	$dataarr[$rep_cb[$ri][2]['name']]['dl_cb_l']=$rep_cb[$ri][7]['name'];
																	$dataarr[$rep_cb[$ri][2]['name']]['sy_cb_l']=$rep_cb[$ri][8]['name'];
																	$dataarr[$rep_cb[$ri][2]['name']]['br_cb_l']=$rep_cb[$ri][9]['name'];
																	$dataarr[$rep_cb[$ri][2]['name']]['bx_cb_l']=$rep_cb[$ri][10]['name'];
																	//��ְ
																	$dataarr[$rep_cb[$ri][2]['name']]['dl_zh']=$rep_cb[$ri][11]['name'];
																	$dataarr[$rep_cb[$ri][2]['name']]['dl_yd']=$rep_cb[$ri][12]['name'];

																	//                     $dataarr[$rep_cb[$ri][1]['name']]['dl_zh']=$rep_cb[$ri][6]['name'];
																	$dataarr[$rep_cb[$ri][2]['name']]['sy_yd']=$rep_cb[$ri][13]['name'];

																	$dataarr[$rep_cb[$ri][2]['name']]['br_zh']=$rep_cb[$ri][14]['name'];
																	$dataarr[$rep_cb[$ri][2]['name']]['br_yd']=$rep_cb[$ri][15]['name'];

																	$dataarr[$rep_cb[$ri][2]['name']]['bx_zh']=$rep_cb[$ri][16]['name'];
																	$dataarr[$rep_cb[$ri][2]['name']]['bx_yd']=$rep_cb[$ri][17]['name'];

																}
															}
														}
														//             print_r($dataarr);
														//             die();
														//���ñ�ͷ����ʽ ����
														$i = 4;
														$sumi=array();
														if(!empty($dataarr)){
															$tempDeptArr = $deptarr;
															$thirdDeptArr = array(); //������������
															foreach($tempDeptArr as $key=>$val){
																$n=0;
																if(in_array($key,$thirdDeptArr)){ //�����$key���������ţ�����Ҫѭ����ֻ��Ҫѭ����������
																	continue;
																}
																foreach($val as $vkey=>$vval){
																	$vval=str_replace("��","-",$vval); //������������������excel���� - ���ݿ����� �� �滻�����ʶ����
																	if(empty($dataarr[$vval])){
																		continue;
																	}

																	$sumi[$i]=$i;
																	$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (0, $i, iconv ( "gb2312", "utf-8", $key ) );
																	$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, $i, iconv ( "gb2312", "utf-8", $vval ) );
																	if(is_array($tempDeptArr[$vval])&&$vval!=$key){
																		$tempArr = $tempDeptArr[$vval];
																		array_push($thirdDeptArr,$vval); //��������ѭ���Ӳ��ź��ŵ���ʱ������,�����ѭ�����õ�
																		$m=0;
																		foreach($tempArr as $wkey=>$wval){

																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, $i, iconv ( "gb2312", "utf-8", $wval ) );
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (3, $i,  '=SUM('.'E'.$i.','.'F'.$i.','.'G'.$i.','.'H'.$i.','.'I'.$i.','.'J'.$i.')');

																					if($sy==2014||$sy==2015||$sy==2016){
																					//��ְ
																					$deptrep[$wval]['�Ͳ�']+=$dataarr[$wval]['dl_cb']
																					+$dataarr[$wval]['sy_cb']
																					+$dataarr[$wval]['br_cb']
																					+$dataarr[$wval]['bx_cb']
																					+$dataarr[$wval]['dl_cb_l']
																					+$dataarr[$wval]['sy_cb_l']
																					+$dataarr[$wval]['br_cb_l']
																					+$dataarr[$wval]['bx_cb_l'];
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (4, $i, $dataarr[$wval]['dl_cb']);
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (5, $i, $dataarr[$wval]['sy_cb']);
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (6, $i, $dataarr[$wval]['br_cb']);
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (7, $i, $dataarr[$wval]['bx_cb']);
																					}
																					//��ְ
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (8, $i, $dataarr[$wval]['dl_cb_l']);
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (9, $i, $dataarr[$wval]['sy_cb_l']);
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (10, $i, $dataarr[$wval]['br_cb_l']);
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (11, $i, $dataarr[$wval]['bx_cb_l']);

																					//��ְ����
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (12, $i, $dataarr[$wval]['dl_zh'] );
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (13, $i, $dataarr[$wval]['dl_yd'] );
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (14, $i, $dataarr[$wval]['sy_yd'] );
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (15, $i, $dataarr[$wval]['br_zh'] );
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (16, $i, $dataarr[$wval]['br_yd'] );
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (17, $i, $dataarr[$wval]['bx_zh'] );
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (18, $i, $dataarr[$wval]['bx_yd'] );
																					//��ְ����
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (19, $i, $dataarr[$wval]['dl_zh_l'] );
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (20, $i, $dataarr[$wval]['dl_yd_l'] );
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (21, $i, $dataarr[$wval]['sy_yd_l'] );
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (22, $i, $dataarr[$wval]['br_zh_l'] );
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (23, $i, $dataarr[$wval]['br_yd_l'] );
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (24, $i, $dataarr[$wval]['bx_zh_l'] );
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (25, $i, $dataarr[$wval]['bx_yd_l'] );
																					$m++;
																					$i++;
																					$n++;
																					$sumi[$i]=$i;
																		}
																		if($m>1){//����
																			$objPhpExcelFile->getActiveSheet ()->mergeCells ('B' . ($i-$m).':'.'B' . ($i) );//�ϲ�
																		}
																	}

																	$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, $i, iconv ( "gb2312", "utf-8", $vval ) );
																	$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (3, $i,  '=SUM('.'E'.$i.','.'F'.$i.','.'G'.$i.','.'H'.$i.','.'I'.$i.','.'J'.$i.')');
																			//������
																			if($key=='������'||$sy==2014||$sy==2015 || $sy==2016){
																			//��ְ
																			$deptrep[$vval]['�Ͳ�']+=$dataarr[$vval]['dl_cb']
																			+$dataarr[$vval]['sy_cb']
																			+$dataarr[$vval]['br_cb']
																			+$dataarr[$vval]['bx_cb']
																			+$dataarr[$vval]['dl_cb_l']
																			+$dataarr[$vval]['sy_cb_l']
																			+$dataarr[$vval]['br_cb_l']
																			+$dataarr[$vval]['bx_cb_l'];
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (4, $i, $dataarr[$vval]['dl_cb']);
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (5, $i, $dataarr[$vval]['sy_cb']);
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (6, $i, $dataarr[$vval]['br_cb']);
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (7, $i, $dataarr[$vval]['bx_cb']);
																			}
																			//��ְ
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (8, $i, $dataarr[$vval]['dl_cb_l']);
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (9, $i, $dataarr[$vval]['sy_cb_l']);
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (10, $i, $dataarr[$vval]['br_cb_l']);
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (11, $i, $dataarr[$vval]['bx_cb_l']);

																			//��ְ����
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (12, $i, $dataarr[$vval]['dl_zh'] );
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (13, $i, $dataarr[$vval]['dl_yd'] );
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (14, $i, $dataarr[$vval]['sy_yd'] );
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (15, $i, $dataarr[$vval]['br_zh'] );
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (16, $i, $dataarr[$vval]['br_yd'] );
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (17, $i, $dataarr[$vval]['bx_zh'] );
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (18, $i, $dataarr[$vval]['bx_yd'] );
																			//��ְ����
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (19, $i, $dataarr[$vval]['dl_zh_l'] );
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (20, $i, $dataarr[$vval]['dl_yd_l'] );
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (21, $i, $dataarr[$vval]['sy_yd_l'] );
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (22, $i, $dataarr[$vval]['br_zh_l'] );
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (23, $i, $dataarr[$vval]['br_yd_l'] );
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (24, $i, $dataarr[$vval]['bx_zh_l'] );
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (25, $i, $dataarr[$vval]['bx_yd_l'] );

																			$i++;//������
																			$n++;
																}

																if($n>1){//����
																	$objPhpExcelFile->getActiveSheet ()->mergeCells ('A' . ($i-$n).':'.'A' . ($i) );//�ϲ�
																	$objPhpExcelFile->getActiveSheet()->getStyle( 'A'.$i.':U'.$i)->getFont()->setSize(10);
																	$objPhpExcelFile->getActiveSheet()->getStyle( 'A'.$i.':U'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
																		->getStartColor()->setRGB('8FBC8F');

																	$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (0, $i, iconv ( "gb2312", "utf-8", $key ) );
																	$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, $i, iconv ( "gb2312", "utf-8", 'С��' ) );
																	$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (3, $i,  '=SUM(D'.($i-$n).':D'.($i-1).')');
																			//��ְ
																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (4, $i,  '=SUM(E'.($i-$n).':E'.($i-1).')');
																				$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (5, $i, '=SUM(F'.($i-$n).':F'.($i-1).')');
																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (6, $i, '=SUM(G'.($i-$n).':G'.($i-1).')' );
																						//��ְ
																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (7, $i,  '=SUM(H'.($i-$n).':H'.($i-1).')');
																							$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (8, $i, '=SUM(I'.($i-$n).':I'.($i-1).')');
																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (9, $i, '=SUM(J'.($i-$n).':J'.($i-1).')' );

																									//��ְ����
																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (10, $i, '=SUM(K'.($i-$n).':K'.($i-1).')' );
																										$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (11, $i, '=SUM(L'.($i-$n).':L'.($i-1).')' );
																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (12, $i, '=SUM(M'.($i-$n).':M'.($i-1).')' );
																												$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (13, $i, '=SUM(N'.($i-$n).':N'.($i-1).')' );
																													$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (14, $i, '=SUM(O'.($i-$n).':O'.($i-1).')' );
																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (15, $i, '=SUM(P'.($i-$n).':P'.($i-1).')' );
																															//��ְ����
																															$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (16, $i, '=SUM(Q'.($i-$n).':Q'.($i-1).')' );
																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (17, $i, '=SUM(R'.($i-$n).':R'.($i-1).')' );
																																	$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (18, $i, '=SUM(S'.($i-$n).':S'.($i-1).')' );
																																		$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (19, $i, '=SUM(T'.($i-$n).':T'.($i-1).')' );
																																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (20, $i, '=SUM(U'.($i-$n).':U'.($i-1).')' );
																																				$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (21, $i, '=SUM(V'.($i-$n).':V'.($i-1).')' );

																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (22, $i, '=SUM(W'.($i-$n).':W'.($i-1).')' );
																																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (23, $i, '=SUM(X'.($i-$n).':X'.($i-1).')' );
																																							$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (24, $i, '=SUM(Y'.($i-$n).':Y'.($i-1).')' );
																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (25, $i, '=SUM(Z'.($i-$n).':Z'.($i-1).')' );

																																									$i++;//������
																																									}
																																									}
																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (0, $i, '' );
																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, $i, 'Total' );
																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (3, $i, '=SUM('.$this->get_cells_str('D',$sumi).')' );
																																										//��ְ
																																										$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (4, $i, '=SUM('.$this->get_cells_str('E',$sumi).')' );
																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (5, $i, '=SUM('.$this->get_cells_str('F',$sumi).')' );
																																												$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (6, $i, '=SUM('.$this->get_cells_str('G',$sumi).')' );
																																													//��ְ
																																													$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (7, $i, '=SUM('.$this->get_cells_str('H',$sumi).')' );
																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (8, $i, '=SUM('.$this->get_cells_str('I',$sumi).')' );
																																															$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (9, $i, '=SUM('.$this->get_cells_str('J',$sumi).')' );
																																																//��ְ����
																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (10, $i, '=SUM('.$this->get_cells_str('K',$sumi).')' );
																																																	$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (11, $i, '=SUM('.$this->get_cells_str('L',$sumi).')' );
																																																		$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (12, $i, '=SUM('.$this->get_cells_str('M',$sumi).')' );
																																																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (13, $i, '=SUM('.$this->get_cells_str('N',$sumi).')' );
																																																				$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (14, $i, '=SUM('.$this->get_cells_str('O',$sumi).')' );
																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (15, $i, '=SUM('.$this->get_cells_str('P',$sumi).')' );
																																																						//��ְ����
																																																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (16, $i, '=SUM('.$this->get_cells_str('Q',$sumi).')' );
																																																							$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (17, $i, '=SUM('.$this->get_cells_str('R',$sumi).')' );
																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (18, $i, '=SUM('.$this->get_cells_str('S',$sumi).')' );
																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (19, $i, '=SUM('.$this->get_cells_str('T',$sumi).')' );
																																																										$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (20, $i, '=SUM('.$this->get_cells_str('U',$sumi).')' );
																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (21, $i, '=SUM('.$this->get_cells_str('V',$sumi).')' );

																																																												$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (22, $i, '=SUM('.$this->get_cells_str('W',$sumi).')' );
																																																													$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (23, $i, '=SUM('.$this->get_cells_str('X',$sumi).')' );
																																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (24, $i, '=SUM('.$this->get_cells_str('Y',$sumi).')' );
																																																															$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (25, $i, '=SUM('.$this->get_cells_str('Z',$sumi).')' );
																																																																}
																																																																//����
																																																																$rep_hf=$repClass->getRepData('gzhf' , array('dimY'=>$sy,'dimM'=>$sm),'data');

																																																																if($sy==2014||$sy==2015||$sy==2016){
																																																																$objPhpExcelFile->setActiveSheetIndex(4);
																																																																}else{
																																																																$objPhpExcelFile->setActiveSheetIndex(5);
																																																																}
																																																																$objPhpExcelFile->getActiveSheet ()->setTitle ( iconv ( "gb2312", "utf-8", $sm.'�»���' ) );
																																																																if(!empty($rep_hf)){
																																																																$rowset = 1;
																																																																foreach($rep_hf as $row=>$val){
																																																																foreach($val as $col=>$vval){
																																																																if(is_array($vval)){//���ø�ʽ
																																																																//�ϲ�
																																																																$colnow=$gl->numToCell($col).($row+$rowset);
																																																																$col_1=$col;
																																																																$col_2=$row+$rowset;
																																																																if(!empty($vval['to_cols'])){
																																																																	$col_1=$col+$vval['to_cols']-1;
																																																																}
																																																																if(!empty($vval['to_rows'])){
																																																																	$col_2=$row+$rowset+$vval['to_rows']-1;
																																																																}
																																																																$colto=$gl->numToCell($col_1).($col_2);
																																																																if ($colnow!=$colto) {
																																																																	$objPhpExcelFile->getActiveSheet ()->mergeCells( $colnow. ':' . $colto );
																																																																}

																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow ($col, $row+$rowset, un_iconv($vval['name']) );
																																																																}else{
																																																																	$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow ($col, $row, $vval );
																																																																}
																																																																}
																																																																if($sy==2014){
																																																																	//���뻰��
																																																																	if(!empty($val['1']['name'])){
																																																																		$deptrep[$val['1']['name']]['����']=$val['2']['name'];
																																																																	}
																																																																}elseif($sy==2015){
																																																																	//���뻰��
																																																																	if(!empty($val['2']['name'])){
																																																																		$deptrep[$val['2']['name']]['����']=$val['3']['name'];
																																																																	}
																																																																}elseif($sy==2016) {
																																																																	//���뻰��
																																																																	if(!empty($val['3']['name'])){
																																																																		$deptrep[$val['3']['name']]['����']=$val['4']['name'];
																																																																	}
																																																																}
																																																																}
																																																																}
																																																																//��Ŀ����
																																																																$rep_jt=$repClass->getRepData('gzxmjt' , array('dimY'=>$sy,'dimM'=>$sm),'data');
																																																																if($sy==2014||$sy==2015||$sy==2016){
																																																																	$objPhpExcelFile->setActiveSheetIndex(5);
																																																																	$objPhpExcelFile->getActiveSheet ()->setTitle ( iconv ( "gb2312", "utf-8", $sm.'����Ŀ����' ) );
																																																																}
																																																																if(!empty($rep_jt)){
																																																																	$rowset = 1;
																																																																	foreach($rep_jt as $row=>$val){
																																																																		foreach($val as $col=>$vval){
																																																																			if(is_array($vval)){//���ø�ʽ
																																																																				//�ϲ�
																																																																				$colnow=$gl->numToCell($col).($row+$rowset);
																																																																				$col_1=$col;
																																																																				$col_2=$row+$rowset;
																																																																				if(!empty($vval['to_cols'])){
																																																																					$col_1=$col+$vval['to_cols']-1;
																																																																				}
																																																																				if(!empty($vval['to_rows'])){
																																																																					$col_2=$row+$rowset+$vval['to_rows']-1;
																																																																				}
																																																																				$colto=$gl->numToCell($col_1).($col_2);
																																																																				if ($colnow!=$colto) {
																																																																					$objPhpExcelFile->getActiveSheet ()->mergeCells( $colnow. ':' . $colto );
																																																																				}

																																																																				$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow ($col, $row+$rowset, un_iconv($vval['name']) );
																																																																			}else{
																																																																				$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow ($col, $row, $vval );
																																																																			}
																																																																		}
																																																																		if($sy==2014){
																																																																			//������Ŀ����
																																																																			if(!empty($val['1']['name'])){
																																																																				$deptrep[$val['1']['name']]['��Ŀ����']=$val['2']['name'];
																																																																			}
																																																																		}elseif($sy==2015){
																																																																			//������Ŀ����
																																																																			if(!empty($val['2']['name'])){
																																																																				$deptrep[$val['2']['name']]['��Ŀ����']=$val['3']['name'];
																																																																			}
																																																																		}elseif($sy==2016) {
																																																																			//������Ŀ����
																																																																			if(!empty($val['3']['name'])){
																																																																				$deptrep[$val['3']['name']]['��Ŀ����']=$val['4']['name'];
																																																																			}
																																																																		}
																																																																	}
																																																																}
																																																																//ͳ�Ʊ�
																																																																$dataarr=array();

																																																																$sqlTol=" and ( d.pdeptname not in ('��Ѷר��','����') or  p.userid ='bin.chang' or p.userid='2903'  )  ";
																																																																$sqlSch=" and ( ( p.pyear='".$sy."' and p.pmon='".$sm."' and p.nowamflag!=3 or p.nowamflag is null )
																																																																	or ( p.pyear='".$sy."' and p.pmon='".$sm."' and p.nowamflag=3 )
																																																																	or ( s.lpy='".$sy."' and s.lpm='".$sm."' and  year(s.leavedt)=p.pyear and month(s.leavedt)=p.pmon and p.nowamflag=3 ) )
																																																																	".$sqlTol;
																																																																$sql = "
																																																																	select
																																																																	p.gjjam , p.shbam
																																																																	, p.remark , p.baseam , p.floatam , p.proam , p.otheram
																																																																	, p.bonusam , p.othdelam , p.perholsdays , p.sickholsdays , p.paycesse , p.paytotal , p.sperewam ,p.spedelam
																																																																	, p.pyear , p.pmon
																																																																	, p.sdyam , p.holsdelam , 'dl' as company , p.expflag , p.basenowam  ,  p.cogjjam , p.coshbam
																																																																	, p.accrewam , p.accdelam , p.nowamflag , p.userid , p.deptid  , p.leaveflag , p.jfcom , p.manageam
																																																																	, d.pdeptname , d.dept_name as deptname , s.lpy , s.lpm , year(s.leavedt) as ldy , month(s.leavedt) as ldm
																																																																	, p.gwam , p.jxam
																																																																	, p.HandicapAm,p.PrepareAm,p.txjt
																																																																	from salary_pay p
																																																																	left join salary s on ( p.userid=s.userid )
																																																																	left join department d on ( d.dept_id=p.deptid )
																																																																	where
																																																																	p.leaveflag='0'
																																																																	$sqlSch
																																																																	";
																																																																$query=$this->db->query($sql);
																																																																while($row=$this->db->fetch_array($query)){
																																																																	if( $row['pdeptname']=='����'||$row['pdeptname']=='�ܾ���'
																																																																	  ){
																																																																		//$row['deptname']=$row['pdeptname'];
																																																																	}
																																																																	if($row['userid']=='bin.chang' || $row['userid']=='2903'){
																																																																		$row['deptname']='����';
																																																																	}
																																																																	$jbgj=$gsshbgjj=$btfl=$xmj=$yfl=$gjze=$btjjr=$txjt=0;
																																																																	if($row['nowamflag']!=3){//��ְ
																																																																		//��˾�籣������ + ���� ���� ����
																																																																		$gsshbgjj=$this->salaryClass->decryptDeal($row['coshbam'])+$this->salaryClass->decryptDeal($row['cogjjam'])
																																																																			+$this->salaryClass->decryptDeal($row['manageam'])
																																																																			+$this->salaryClass->decryptDeal($row['HandicapAm'])
																																																																			+$this->salaryClass->decryptDeal($row['PrepareAm']) ;
																																																																		$dataarr[$row['deptname']]['�籣������']=empty($dataarr[$row['deptname']]['�籣������'])?$gsshbgjj:($dataarr[$row['deptname']]['�籣������']+$gsshbgjj);
																																																																		//��������=��������+˰ǰ��������+˰�󲹷�����
																																																																		$jb=$this->salaryClass->decryptDeal($row['basenowam']);
																																																																		if(empty($jb)||round($jb)==0||$jb==0){
																																																																			$jb=round(  $this->salaryClass->decryptDeal($row['baseam'])
																																																																					+$this->salaryClass->decryptDeal($row['gwam'])
																																																																					+$this->salaryClass->decryptDeal($row['jxam'])  ,2 );
																																																																		}
																																																																		//��������
																																																																		$jbgj=round($jb+$this->salaryClass->decryptDeal($row['sperewam'])+$this->salaryClass->decryptDeal($row['accrewam']),2);
																																																																		$dataarr[$row['deptname']]['��������']=empty($dataarr[$row['deptname']]['��������'])?$jbgj:($dataarr[$row['deptname']]['��������']+$jbgj);
																																																																		//����+������ ����+�ͳ��� �ֶ� ��
																																																																		$btjjr=round($this->salaryClass->decryptDeal($row['sdyam']),2);
																																																																		$dataarr[$row['deptname']]['�ڼ��ղ���']=empty($dataarr[$row['deptname']]['�ڼ��ղ���'])?
																																																																			$btjjr:($dataarr[$row['deptname']]['�ڼ��ղ���']+$btjjr);

																																																																		$btfl=round($this->salaryClass->decryptDeal($row['otheram']),2);
																																																																		$dataarr[$row['deptname']]['��������']=empty($dataarr[$row['deptname']]['��������'])?
																																																																			$btfl:($dataarr[$row['deptname']]['��������']+$btfl);
																																																																		//��Ŀ��
																																																																		$xmj=round($this->salaryClass->decryptDeal($row['proam'])
																																																																				+$this->salaryClass->decryptDeal($row['bonusam'])+$this->salaryClass->decryptDeal($row['floatam']),2);
																																																																		$dataarr[$row['deptname']]['��Ŀ��']=empty($dataarr[$row['deptname']]['��Ŀ��'])?$xmj:($dataarr[$row['deptname']]['��Ŀ��']+$xmj);

																																																																		//ͨ�Ų���
																																																																		$txjt=round($this->salaryClass->decryptDeal($row['txjt']),2);
																																																																		$dataarr[$row['deptname']]['����']=empty($dataarr[$row['deptname']]['����'])?
																																																																			$txjt:($dataarr[$row['deptname']]['����']+$txjt);

																																																																		//������ְ����
																																																																		$dataarr[$row['deptname']]['��������']=empty($dataarr[$row['deptname']]['��������'])?1:($dataarr[$row['deptname']]['��������']+1);

																																																																	}else{//��ְ
																																																																		if($row['ldy']==$sy && $row['ldm']==$sm ){//������ְͳ���籣������
																																																																			$gsshbgjj=$this->salaryClass->decryptDeal($row['coshbam'])+$this->salaryClass->decryptDeal($row['cogjjam'])
																																																																				+$this->salaryClass->decryptDeal($row['manageam'])
																																																																				+$this->salaryClass->decryptDeal($row['HandicapAm'])
																																																																				+$this->salaryClass->decryptDeal($row['PrepareAm']);
																																																																			$dataarr[$row['deptname']]['�籣������']=empty($dataarr[$row['deptname']]['�籣������'])?$gsshbgjj:($dataarr[$row['deptname']]['�籣������']+$gsshbgjj);
																																																																		}
																																																																		if($row['lpy']==$sy && $row['lpm']==$sm ){//֧��������ѡ���·ݼ���ɱ�
																																																																			$jb=$this->salaryClass->decryptDeal($row['basenowam']);
																																																																			if(empty($jb)||round($jb)==0||$jb==0){
																																																																				$jb=$this->salaryClass->decryptDeal($row['baseam']);
																																																																			}
																																																																			//��������=��������+�����+��ְ����
																																																																			$jb=round($jb+$this->salaryClass->decryptDeal($row['sperewam'])+$this->salaryClass->decryptDeal($row['accrewam']),2);
																																																																			if($row['lpy']==2013 && $row['lpm']==12 && ( $row['userid']=='fei.xue' || $row['userid']=='min.ruan'  ) ){
																																																																				$jb=round($this->salaryClass->decryptDeal($row['accrewam']),2);
																																																																			}
																																																																			$xm=round($this->salaryClass->decryptDeal($row['proam'])
																																																																					+$this->salaryClass->decryptDeal($row['bonusam'])+$this->salaryClass->decryptDeal($row['floatam']),2);
																																																																			//�������ڼ��ղ������ɲͲ��� ����������������������������
																																																																			$bt=round($this->salaryClass->decryptDeal($row['sdyam']),2);
																																																																			$fl=round($this->salaryClass->decryptDeal($row['otheram']),2);
																																																																			$txjt=round($this->salaryClass->decryptDeal($row['txjt']),2);
																																																																			//��ְ����
																																																																			$yfl=round($jb+$xm+$bt+$fl+$txjt,2);
																																																																			$dataarr[$row['deptname']]['��ְ����']=empty($dataarr[$row['deptname']]['��ְ����'])?$yfl:($dataarr[$row['deptname']]['��ְ����']+$yfl);
																																																																			$dataarr[$row['deptname']]['��ְ��������']=empty($dataarr[$row['deptname']]['��ְ��������'])?1:($dataarr[$row['deptname']]['��ְ��������']+1);
																																																																		}
																																																																	}
																																																																	$gjze=($jbgj+$gsshbgjj+$btfl+$xmj);
																																																																	$dataarr[$row['deptname']]['�����ܶ�']=empty($dataarr[$row['deptname']]['�����ܶ�'])?($gjze):($dataarr[$row['deptname']]['�����ܶ�']+$gjze);
																																																																	$dataarr[$row['deptname']]['�˹���֧��']=empty($dataarr[$row['deptname']]['�˹���֧��'])?($gjze+$yfl):($dataarr[$row['deptname']]['�˹���֧��']+$gjze+$yfl);
																																																																}
																																																																//          print_r($dataarr);
																																																																//          die();
																																																																//���ػ��ѲͲ�
																																																																if($deptarr){
																																																																	foreach($deptarr as $key=>$val){
																																																																		foreach($val as $vkey=>$vval){
																																																																			$vvalc=$vval;
																																																																			$vval=str_replace("��","-",$vval);
																																																																			if(!empty($deptrep[$vval])&&!empty($dataarr[$vvalc])){
																																																																				$dataarr[$vvalc]['�Ͳ�']+= $deptrep[$vval]['�Ͳ�'];
																																																																				$dataarr[$vvalc]['����']+= $deptrep[$vval]['����'];
																																																																				$dataarr[$vvalc]['��Ŀ����']+= $deptrep[$vval]['��Ŀ����'];
																																																																			}
																																																																		}
																																																																	}
																																																																}

																																																																//ͳ�Ʊ�
																																																																//*���¹�����Ϣ*//
																																																																$dataArrP=array();
																																																																$lastmonth = mktime(0, 0, 0, $sm-1 ,  1  ,  $sy );
																																																																$lsy = date('Y', $lastmonth );
																																																																$lsm = date('n', $lastmonth );

																																																																$sqlTol=" and ( d.pdeptname not in ('��Ѷר��','����') or  p.userid ='bin.chang' or p.userid='2903'  )  ";
																																																																$sqlSch=" and ( ( p.pyear='".$lsy."' and p.pmon='".$lsm."' and p.nowamflag!=3 or p.nowamflag is null )
																																																																	or ( p.pyear='".$lsy."' and p.pmon='".$lsm."' and p.nowamflag=3 )
																																																																	or ( s.lpy='".$lsy."' and s.lpm='".$lsm."' and  year(s.leavedt)=p.pyear and month(s.leavedt)=p.pmon and p.nowamflag=3 ) )
																																																																	".$sqlTol;
																																																																$sql = "
																																																																	select
																																																																	p.gjjam , p.shbam
																																																																	, p.remark , p.baseam , p.floatam , p.proam , p.otheram
																																																																	, p.bonusam , p.othdelam , p.perholsdays , p.sickholsdays , p.paycesse , p.paytotal , p.sperewam ,p.spedelam
																																																																	, p.pyear , p.pmon
																																																																	, p.sdyam , p.holsdelam , 'dl' as company , p.expflag , p.basenowam  ,  p.cogjjam , p.coshbam
																																																																	, p.accrewam , p.accdelam , p.nowamflag , p.userid , p.deptid  , p.leaveflag , p.jfcom , p.manageam
																																																																	, d.pdeptname , d.dept_name as deptname , s.lpy , s.lpm , year(s.leavedt) as ldy , month(s.leavedt) as ldm
																																																																	, p.gwam , p.jxam
																																																																	, p.HandicapAm,p.PrepareAm,p.txjt
																																																																	from salary_pay p
																																																																	left join salary s on ( p.userid=s.userid )
																																																																	left join department d on ( d.dept_id=p.deptid )
																																																																	where
																																																																	p.leaveflag='0'
																																																																	$sqlSch
																																																																	";
																																																																$query=$this->db->query($sql);
																																																																while($row=$this->db->fetch_array($query)){
																																																																	if( $row['pdeptname']=='����'||$row['pdeptname']=='�ܾ���'
																																																																	  ){
																																																																		//$row['deptname']=$row['pdeptname'];
																																																																	}
																																																																	if($row['userid']=='bin.chang' || $row['userid']=='2903'){
																																																																		$row['deptname']='����';
																																																																	}
																																																																	$jbgj=$gsshbgjj=$btfl=$xmj=$yfl=$gjze=$btjjr=$txjt=0;
																																																																	if($row['nowamflag']!=3){//��ְ
																																																																		//��˾�籣������ + ���� ���� ����
																																																																		$gsshbgjj=$this->salaryClass->decryptDeal($row['coshbam'])+$this->salaryClass->decryptDeal($row['cogjjam'])
																																																																			+$this->salaryClass->decryptDeal($row['manageam'])
																																																																			+$this->salaryClass->decryptDeal($row['HandicapAm'])
																																																																			+$this->salaryClass->decryptDeal($row['PrepareAm']) ;
																																																																		$dataArrP[$row['deptname']]['�籣������']=empty($dataArrP[$row['deptname']]['�籣������'])?$gsshbgjj:($dataArrP[$row['deptname']]['�籣������']+$gsshbgjj);
																																																																		//��������=��������+˰ǰ��������+˰�󲹷�����
																																																																		$jb=$this->salaryClass->decryptDeal($row['basenowam']);
																																																																		if(empty($jb)||round($jb)==0||$jb==0){
																																																																			$jb=round(  $this->salaryClass->decryptDeal($row['baseam'])
																																																																					+$this->salaryClass->decryptDeal($row['gwam'])
																																																																					+$this->salaryClass->decryptDeal($row['jxam'])  ,2 );
																																																																		}
																																																																		//��������
																																																																		$jbgj=round($jb+$this->salaryClass->decryptDeal($row['sperewam'])+$this->salaryClass->decryptDeal($row['accrewam']),2);
																																																																		$dataArrP[$row['deptname']]['��������']=empty($dataArrP[$row['deptname']]['��������'])?$jbgj:($dataArrP[$row['deptname']]['��������']+$jbgj);
																																																																		//����+������ ����+�ͳ��� �ֶ� ��
																																																																		$btjjr=round($this->salaryClass->decryptDeal($row['sdyam']),2);
																																																																		$dataArrP[$row['deptname']]['�ڼ��ղ���']=empty($dataArrP[$row['deptname']]['�ڼ��ղ���'])?
																																																																			$btjjr:($dataArrP[$row['deptname']]['�ڼ��ղ���']+$btjjr);

																																																																		$btfl=round($this->salaryClass->decryptDeal($row['otheram']),2);
																																																																		$dataArrP[$row['deptname']]['��������']=empty($dataArrP[$row['deptname']]['��������'])?
																																																																			$btfl:($dataArrP[$row['deptname']]['��������']+$btfl);
																																																																		//��Ŀ��
																																																																		$xmj=round($this->salaryClass->decryptDeal($row['proam'])
																																																																				+$this->salaryClass->decryptDeal($row['bonusam'])+$this->salaryClass->decryptDeal($row['floatam']),2);
																																																																		$dataArrP[$row['deptname']]['��Ŀ��']=empty($dataArrP[$row['deptname']]['��Ŀ��'])?$xmj:($dataArrP[$row['deptname']]['��Ŀ��']+$xmj);
																																																																		//ͨ�Ų���
																																																																		$txjt=round($this->salaryClass->decryptDeal($row['txjt']),2);
																																																																		$dataArrP[$row['deptname']]['����']=empty($dataArrP[$row['deptname']]['����'])?
																																																																			$txjt:($dataArrP[$row['deptname']]['����']+$txjt);
																																																																		//������ְ����
																																																																		$dataArrP[$row['deptname']]['��������']=empty($dataArrP[$row['deptname']]['��������'])?1:($dataArrP[$row['deptname']]['��������']+1);

																																																																	}else{//��ְ
																																																																		if($row['ldy']==$lsy && $row['ldm']==$lsm ){//������ְͳ���籣������
																																																																			$gsshbgjj=$this->salaryClass->decryptDeal($row['coshbam'])+$this->salaryClass->decryptDeal($row['cogjjam'])
																																																																				+$this->salaryClass->decryptDeal($row['manageam'])
																																																																				+$this->salaryClass->decryptDeal($row['HandicapAm'])
																																																																				+$this->salaryClass->decryptDeal($row['PrepareAm']);
																																																																			$dataArrP[$row['deptname']]['�籣������']=empty($dataArrP[$row['deptname']]['�籣������'])?$gsshbgjj:($dataArrP[$row['deptname']]['�籣������']+$gsshbgjj);
																																																																		}
																																																																		if($row['lpy']==$lsy && $row['lpm']==$lsm ){//֧��������ѡ���·ݼ���ɱ�
																																																																			$jb=$this->salaryClass->decryptDeal($row['basenowam']);
																																																																			if(empty($jb)||round($jb)==0||$jb==0){
																																																																				$jb=$this->salaryClass->decryptDeal($row['baseam']);
																																																																			}
																																																																			//��������=��������+�����+��ְ����
																																																																			$jb=round($jb+$this->salaryClass->decryptDeal($row['sperewam'])+$this->salaryClass->decryptDeal($row['accrewam']),2);
																																																																			if($row['lpy']==2013 && $row['lpm']==12 && ( $row['userid']=='fei.xue' || $row['userid']=='min.ruan'  ) ){
																																																																				$jb=round($this->salaryClass->decryptDeal($row['accrewam']),2);
																																																																			}
																																																																			$xm=round($this->salaryClass->decryptDeal($row['proam'])
																																																																					+$this->salaryClass->decryptDeal($row['bonusam'])+$this->salaryClass->decryptDeal($row['floatam']),2);
																																																																			//�������ڼ��ղ������ɲͲ��� ����������������������������
																																																																			$bt=round($this->salaryClass->decryptDeal($row['sdyam']),2);
																																																																			$fl=round($this->salaryClass->decryptDeal($row['otheram']),2);
																																																																			$txjt=round($this->salaryClass->decryptDeal($row['txjt']),2);
																																																																			//��ְ����
																																																																			$yfl=round($jb+$xm+$bt+$fl+$txjt,2);
																																																																			$dataArrP[$row['deptname']]['��ְ����']=empty($dataArrP[$row['deptname']]['��ְ����'])?$yfl:($dataArrP[$row['deptname']]['��ְ����']+$yfl);
																																																																			$dataArrP[$row['deptname']]['��ְ��������']=empty($dataArrP[$row['deptname']]['��ְ��������'])?1:($dataArrP[$row['deptname']]['��ְ��������']+1);
																																																																		}
																																																																	}
																																																																	$gjze=($jbgj+$gsshbgjj+$btfl+$xmj);
																																																																	$dataArrP[$row['deptname']]['�����ܶ�']=empty($dataArrP[$row['deptname']]['�����ܶ�'])?($gjze):($dataArrP[$row['deptname']]['�����ܶ�']+$gjze);
																																																																	$dataArrP[$row['deptname']]['�˹���֧��']=empty($dataArrP[$row['deptname']]['�˹���֧��'])?($gjze+$yfl):($dataArrP[$row['deptname']]['�˹���֧��']+$gjze+$yfl);
																																																																}
																																																																$deptrep = array();
																																																																//��Ŀ
																																																																//��ȡ�����������Ϣ
																																																																$rep_cb=$repClass->getRepData('gzfuxcb', array('dimY'=>$lsy,'dimM'=>$lsm),'data');
																																																																if(!empty($rep_cb)){
																																																																	for($ri=2;$ri<count($rep_cb);$ri++){

																																																																		$deptrep[$rep_cb[$ri][2]['name']]['�Ͳ�']=$rep_cb[$ri][3]['name']
																																																																			+$rep_cb[$ri][4]['name']
																																																																			+$rep_cb[$ri][5]['name']
																																																																			+$rep_cb[$ri][6]['name']
																																																																			+$rep_cb[$ri][7]['name']
																																																																			+$rep_cb[$ri][8]['name']
																																																																			+$rep_cb[$ri][9]['name']
																																																																			+$rep_cb[$ri][10]['name'];

																																																																	}
																																																																}
																																																																//����
																																																																$rep_hf=$repClass->getRepData('gzhf' , array('dimY'=>$lsy,'dimM'=>$lsm),'data');
																																																																if(!empty($rep_hf)){
																																																																	$rowset = 1;
																																																																	//$rep_hf=  un_iconv($rep_hf);
																																																																	foreach($rep_hf as $row=>$val){
																																																																		//���뻰��
																																																																		if(!empty($val['2']['name'])){
																																																																			$deptrep[$val['2']['name']]['����']=$val['3']['name'];
																																																																		}
																																																																	}
																																																																}
																																																																//��Ŀ����
																																																																$rep_jt=$repClass->getRepData('gzxmjt' , array('dimY'=>$lsy,'dimM'=>$lsm),'data');

																																																																if(!empty($rep_jt)){
																																																																	$rowset = 1;
																																																																	//$rep_hf=  un_iconv($rep_hf);
																																																																	foreach($rep_jt as $row=>$val){

																																																																		//������Ŀ����
																																																																		if(!empty($val['2']['name'])){
																																																																			$deptrep[$val['2']['name']]['��Ŀ����']=$val['3']['name'];
																																																																		}
																																																																	}
																																																																}
																																																																//���ػ��ѲͲ�
																																																																if($deptarr){
																																																																	foreach($deptarr as $key=>$val){
																																																																		foreach($val as $vkey=>$vval){
																																																																			$vvalc=$vval;
																																																																			$vval=str_replace("��","-",$vval);
																																																																			if(!empty($deptrep[$vval])&&!empty($dataArrP[$vvalc])){
																																																																				$dataArrP[$vvalc]['�Ͳ�']= $deptrep[$vval]['�Ͳ�'] ;
																																																																				$dataArrP[$vvalc]['����']= $dataArrP[$vvalc]['����']+$deptrep[$vval]['����'] ;
																																																																				$dataArrP[$vvalc]['��Ŀ����']= $deptrep[$vval]['��Ŀ����'] ;
																																																																			}
																																																																		}
																																																																	}
																																																																}

																																																																//*���¹�����Ϣ*//

																																																																//��һ�� �¶��ܼ�
																																																																$totalarr=array(
																																																																		'��������'=>0
																																																																		,'�籣������'=>0
																																																																		,'��������'=>0
																																																																		,'�ڼ��ղ���'=>0
																																																																		,'�Ͳ�'=>0
																																																																		,'����'=>0
																																																																		,'��Ŀ��'=>0
																																																																		,'��Ŀ����'=>0
																																																																		,'�����ܶ�'=>0
																																																																		,'��ְ����'=>0
																																																																		,'��ְ��������'=>0
																																																																		,'�˹���֧��'=>0
																																																																		,'��������'=>0
																																																																		,'ƽ���ɱ�'=>0
																																																																	       );
																																																																$totalArrP = $totalarr;
																																																																foreach($dataarr as $key=>$val){
																																																																	$totalarr['��������']+=$val['��������'];
																																																																	$totalarr['�籣������']+=$val['�籣������'];
																																																																	$totalarr['��������']+=$val['��������'];
																																																																	$totalarr['�ڼ��ղ���']+=$val['�ڼ��ղ���'];
																																																																	$totalarr['�Ͳ�']+=$val['�Ͳ�'];
																																																																	$totalarr['����']+=$val['����'];
																																																																	$totalarr['��Ŀ��']+=$val['��Ŀ��'];
																																																																	$totalarr['��Ŀ����']+=$val['��Ŀ����'];
																																																																	$totalarr['�����ܶ�']+=$val['�����ܶ�'];
																																																																	$totalarr['��ְ����']+=$val['��ְ����'];
																																																																	$totalarr['��ְ��������']+=$val['��ְ��������'];
																																																																	$totalarr['�˹���֧��']+=$val['�˹���֧��'];
																																																																	$totalarr['��������']+=$val['��������'];
																																																																}
																																																																//����
																																																																foreach($dataArrP as $key=>$val){
																																																																	$totalArrP['��������']+=$val['��������'];
																																																																	$totalArrP['�籣������']+=$val['�籣������'];
																																																																	$totalArrP['��������']+=$val['��������'];
																																																																	$totalArrP['�ڼ��ղ���']+=$val['�ڼ��ղ���'];
																																																																	$totalArrP['�Ͳ�']+=$val['�Ͳ�'];
																																																																	$totalArrP['����']+=$val['����'];
																																																																	$totalArrP['��Ŀ��']+=$val['��Ŀ��'];
																																																																	$totalArrP['��Ŀ����']+=$val['��Ŀ����'];
																																																																	$totalArrP['�����ܶ�']+=$val['�����ܶ�'];
																																																																	$totalArrP['��ְ����']+=$val['��ְ����'];
																																																																	$totalArrP['��ְ��������']+=$val['��ְ��������'];
																																																																	$totalArrP['�˹���֧��']+=$val['�˹���֧��'];
																																																																	$totalArrP['��������']+=$val['��������'];
																																																																}

																																																																$objPhpExcelFile->setActiveSheetIndex(0);
																																																																$objPhpExcelFile->getActiveSheet ()->setTitle ( iconv ( "gb2312", "utf-8", $sm.'���ܼ�' ) );

																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 3, $totalarr['��������'] );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 4, $totalarr['�籣������'] );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 5, $totalarr['��������'] );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 6, $totalarr['�ڼ��ղ���'] );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 7, $totalarr['�Ͳ�'] );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 8, $totalarr['����'] );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 9, $totalarr['��Ŀ��'] );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 10, $totalarr['��Ŀ����'] );
																																																																//$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 8, '=SUM(B3:B7)' );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 12, $totalarr['��ְ����'] );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 13, $totalarr['��ְ��������'] );
																																																																//$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 10, '=SUM(B8,B9)' );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 15, $totalarr['��������'] );
																																																																//$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 12, '=B10/B11' );

																																																																//����
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, 3, $totalArrP['��������'] );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, 4, $totalArrP['�籣������'] );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, 5, $totalArrP['��������'] );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, 6, $totalArrP['�ڼ��ղ���'] );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, 7, $totalArrP['�Ͳ�'] );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, 8, $totalArrP['����'] );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, 9, $totalArrP['��Ŀ��'] );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, 10, $totalArrP['��Ŀ����'] );
																																																																//$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 8, '=SUM(B3:B7)' );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, 12, $totalArrP['��ְ����'] );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, 13, $totalArrP['��ְ��������'] );
																																																																//$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 10, '=SUM(B8,B9)' );
																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, 15, $totalArrP['��������'] );
																																																																//$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, 12, '=B10/B11' );


																																																																if($sy ==2014||$sy==2015 || $sy==2016){
																																																																	$objPhpExcelFile->setActiveSheetIndex(2);
																																																																	$objPhpExcelFile->getActiveSheet ()->setTitle ( iconv ( "gb2312", "utf-8", '����'.$sm.'�³ɱ���ϸ' ) );

																																																																	$i = 3;
																																																																	$sumi=array();
																																																																	$twodata= array();
																																																																	$twoDataP= array();
																																																																	if(!empty($dataarr)){
																																																																		$thirdDeptArr = array();
																																																																		foreach($deptarr as $key=>$val){
																																																																			$n=0;
																																																																			if(in_array($key,$thirdDeptArr)){ //�����$key���������ţ�����Ҫѭ����ֻ��Ҫѭ����������
																																																																				continue;
																																																																			}
																																																																			foreach($val as $vkey=>$vval){

																																																																				//                          if(empty($dataarr[$vval])){
																																																																				//                              continue;
																																																																				//                          }
																																																																				$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (0, $i, iconv ( "gb2312", "utf-8", $key ) );
																																																																				$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, $i, iconv ( "gb2312", "utf-8", $vval ) );

																																																																				if($vval!=$key&&!empty($deptarr[$vval])){
																																																																					$temp = $deptarr[$vval];
																																																																					array_push($thirdDeptArr,$vval); //��������ѭ���Ӳ��ź��ŵ���ʱ������,�����ѭ����Ҫ����
																																																																					$m=0;
																																																																					foreach($temp as $wkey=>$wvval){
																																																																						//�����ļ����������ۼ�
																																																																						$twodata[$key]['��������'] =empty($twodata[$key]['��������'])? $dataarr[$wvval]['��������']
																																																																							: ( $twodata[$key]['��������'] + $dataarr[$wvval]['��������'] ) ;
																																																																						$twodata[$key]['�籣������'] =empty($twodata[$key]['�籣������'])? $dataarr[$wvval]['�籣������']
																																																																							: ( $twodata[$key]['�籣������'] + $dataarr[$wvval]['�籣������'] ) ;
																																																																						$twodata[$key]['��������'] =empty($twodata[$key]['��������'])? $dataarr[$wvval]['��������']
																																																																							: ( $twodata[$key]['��������'] + $dataarr[$wvval]['��������'] ) ;
																																																																						$twodata[$key]['�ڼ��ղ���'] =empty($twodata[$key]['�ڼ��ղ���'])? $dataarr[$wvval]['�ڼ��ղ���']
																																																																							: ( $twodata[$key]['�ڼ��ղ���'] + $dataarr[$wvval]['�ڼ��ղ���'] ) ;
																																																																						$twodata[$key]['�Ͳ�'] =empty($twodata[$key]['�Ͳ�'])? $dataarr[$wvval]['�Ͳ�']
																																																																							: ( $twodata[$key]['�Ͳ�'] + $dataarr[$wvval]['�Ͳ�'] ) ;
																																																																						$twodata[$key]['����'] =empty($twodata[$key]['����'])? $dataarr[$wvval]['����']
																																																																							: ( $twodata[$key]['����'] + $dataarr[$wvval]['����'] ) ;
																																																																						$twodata[$key]['��Ŀ��'] =empty($twodata[$key]['��Ŀ��'])? $dataarr[$wvval]['��Ŀ��']
																																																																							: ( $twodata[$key]['��Ŀ��'] + $dataarr[$wvval]['��Ŀ��'] ) ;
																																																																						$twodata[$key]['��Ŀ����'] =empty($twodata[$key]['��Ŀ����'])? $dataarr[$wvval]['��Ŀ����']
																																																																							: ( $twodata[$key]['��Ŀ����'] + $dataarr[$wvval]['��Ŀ����'] ) ;
																																																																						$twodata[$key]['��ְ����'] =empty($twodata[$key]['��ְ����'])? $dataarr[$wvval]['��ְ����']
																																																																							: ( $twodata[$key]['��ְ����'] + $dataarr[$wvval]['��ְ����'] ) ;
																																																																						$twodata[$key]['��ְ��������'] =empty($twodata[$key]['��ְ��������'])? $dataarr[$wvval]['��ְ��������']
																																																																							: ( $twodata[$key]['��ְ��������'] + $dataarr[$wvval]['��ְ��������'] ) ;
																																																																						$twodata[$key]['��������'] =empty($twodata[$key]['��������'])? $dataarr[$wvval]['��������']
																																																																							: ( $twodata[$key]['��������'] + $dataarr[$wvval]['��������'] ) ;
																																																																						//�����ļ����������ۼ�
																																																																						$twoDataP[$key]['��������'] =empty($twoDataP[$key]['��������'])? $dataArrP[$wvval]['��������']
																																																																							: ( $twoDataP[$key]['��������'] + $dataArrP[$wvval]['��������'] ) ;
																																																																						$twoDataP[$key]['�籣������'] =empty($twoDataP[$key]['�籣������'])? $dataArrP[$wvval]['�籣������']
																																																																							: ( $twoDataP[$key]['�籣������'] + $dataArrP[$wvval]['�籣������'] ) ;
																																																																						$twoDataP[$key]['��������'] =empty($twoDataP[$key]['��������'])? $dataArrP[$wvval]['��������']
																																																																							: ( $twoDataP[$key]['��������'] + $dataArrP[$wvval]['��������'] ) ;
																																																																						$twoDataP[$key]['�ڼ��ղ���'] =empty($twoDataP[$key]['�ڼ��ղ���'])? $dataArrP[$wvval]['�ڼ��ղ���']
																																																																							: ( $twoDataP[$key]['�ڼ��ղ���'] + $dataArrP[$wvval]['�ڼ��ղ���'] ) ;
																																																																						$twoDataP[$key]['�Ͳ�'] =empty($twoDataP[$key]['�Ͳ�'])? $dataArrP[$wvval]['�Ͳ�']
																																																																							: ( $twoDataP[$key]['�Ͳ�'] + $dataArrP[$wvval]['�Ͳ�'] ) ;
																																																																						$twoDataP[$key]['����'] =empty($twoDataP[$key]['����'])? $dataArrP[$wvval]['����']
																																																																							: ( $twoDataP[$key]['����'] + $dataArrP[$wvval]['����'] ) ;
																																																																						$twoDataP[$key]['��Ŀ��'] =empty($twoDataP[$key]['��Ŀ��'])? $dataArrP[$wvval]['��Ŀ��']
																																																																							: ( $twoDataP[$key]['��Ŀ��'] + $dataArrP[$wvval]['��Ŀ��'] ) ;
																																																																						$twoDataP[$key]['��Ŀ����'] =empty($twoDataP[$key]['��Ŀ����'])? $dataArrP[$wvval]['��Ŀ����']
																																																																							: ( $twoDataP[$key]['��Ŀ����'] + $dataArrP[$wvval]['��Ŀ����'] ) ;
																																																																						$twoDataP[$key]['��ְ����'] =empty($twoDataP[$key]['��ְ����'])? $dataArrP[$wvval]['��ְ����']
																																																																							: ( $twoDataP[$key]['��ְ����'] + $dataArrP[$wvval]['��ְ����'] ) ;
																																																																						$twoDataP[$key]['��ְ��������'] =empty($twoDataP[$key]['��ְ��������'])? $dataArrP[$wvval]['��ְ��������']
																																																																							: ( $twoDataP[$key]['��ְ��������'] + $dataArrP[$wvval]['��ְ��������'] ) ;
																																																																						$twoDataP[$key]['��������'] =empty($twoDataP[$key]['��������'])? $dataArrP[$wvval]['��������']
																																																																							: ( $twoDataP[$key]['��������'] + $dataArrP[$wvval]['��������'] ) ;

																																																																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, $i,  iconv ( "gb2312", "utf-8", $wvval ) );
																																																																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (3, $i,  $dataarr[$wvval]['��������'] );
																																																																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (4, $i,  $dataarr[$wvval]['�籣������'] );
																																																																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (5, $i,  $dataarr[$wvval]['��������'] );
																																																																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (6, $i,  $dataarr[$wvval]['�ڼ��ղ���'] );
																																																																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (7, $i,  $dataarr[$wvval]['�Ͳ�'] );
																																																																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (8, $i,  $dataarr[$wvval]['����'] );
																																																																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (9, $i,  $dataarr[$wvval]['��Ŀ��'] );
																																																																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (10, $i,  $dataarr[$wvval]['��Ŀ����'] );
																																																																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (11, $i,  '=SUM(D'.$i.':K'.$i.')' );
																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (12, $i,  $dataarr[$wvval]['��ְ����'] );
																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (13, $i,  $dataarr[$wvval]['��ְ��������'] );
																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (14, $i,  '=SUM(L'.$i.',M'.$i.')' );
																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (15, $i,  $dataarr[$wvval]['��������'] );
																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (16, $i,  '=L'.$i.'/'.'P'.$i );

																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (17, $i,  $dataArrP[$wvval]['��������'] );
																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (18, $i,  $dataArrP[$wvval]['�籣������'] );
																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (19, $i,  $dataArrP[$wvval]['��������'] );
																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (20, $i,  $dataArrP[$wvval]['�ڼ��ղ���'] );
																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (21, $i,  $dataArrP[$wvval]['�Ͳ�'] );
																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (22, $i,  $dataArrP[$wvval]['����'] );
																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (23, $i,  $dataArrP[$wvval]['��Ŀ��'] );
																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (24, $i,  $dataArrP[$wvval]['��Ŀ����'] );
																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (25, $i,  '=SUM(R'.$i.':Y'.$i.')' );
																																																																										$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (26, $i,  $dataArrP[$wvval]['��ְ����'] );
																																																																										$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (27, $i,  $dataArrP[$wvval]['��ְ��������'] );
																																																																										$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (28, $i,  '=SUM(Z'.$i.',AA'.$i.')' );
																																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (29, $i,  $dataArrP[$wvval]['��������'] );
																																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (30, $i,  '=Z'.$i.'/'.'AD'.$i );
																																																																											$sumi[$i]=$i;
																																																																											$i++;//������
																																																																											$n++;
																																																																											$m++;
																																																																											}
																																																																											if($m>1){//����
																																																																											$objPhpExcelFile->getActiveSheet ()->mergeCells ('B' . ($i-$m).':'.'B' . ($i) );//�ϲ�
																																																																											}
																																																																											}
																																																																											$twodata[$key]['��������'] =empty($twodata[$key]['��������'])? $dataarr[$vval]['��������']
																																																																											: ( $twodata[$key]['��������'] + $dataarr[$vval]['��������'] ) ;
																																																																											$twodata[$key]['�籣������'] =empty($twodata[$key]['�籣������'])? $dataarr[$vval]['�籣������']
																																																																											: ( $twodata[$key]['�籣������'] + $dataarr[$vval]['�籣������'] ) ;
																																																																											$twodata[$key]['��������'] =empty($twodata[$key]['��������'])? $dataarr[$vval]['��������']
																																																																											: ( $twodata[$key]['��������'] + $dataarr[$vval]['��������'] ) ;
																																																																											$twodata[$key]['�ڼ��ղ���'] =empty($twodata[$key]['�ڼ��ղ���'])? $dataarr[$vval]['�ڼ��ղ���']
																																																																											: ( $twodata[$key]['�ڼ��ղ���'] + $dataarr[$vval]['�ڼ��ղ���'] ) ;
																																																																											$twodata[$key]['�Ͳ�'] =empty($twodata[$key]['�Ͳ�'])? $dataarr[$vval]['�Ͳ�']
																																																																												: ( $twodata[$key]['�Ͳ�'] + $dataarr[$vval]['�Ͳ�'] ) ;
																																																																											$twodata[$key]['����'] =empty($twodata[$key]['����'])? $dataarr[$vval]['����']
																																																																												: ( $twodata[$key]['����'] + $dataarr[$vval]['����'] ) ;
																																																																											$twodata[$key]['��Ŀ��'] =empty($twodata[$key]['��Ŀ��'])? $dataarr[$vval]['��Ŀ��']
																																																																												: ( $twodata[$key]['��Ŀ��'] + $dataarr[$vval]['��Ŀ��'] ) ;
																																																																											$twodata[$key]['��Ŀ����'] =empty($twodata[$key]['��Ŀ����'])? $dataarr[$vval]['��Ŀ����']
																																																																												: ( $twodata[$key]['��Ŀ����'] + $dataarr[$vval]['��Ŀ����'] ) ;
																																																																											$twodata[$key]['��ְ����'] =empty($twodata[$key]['��ְ����'])? $dataarr[$vval]['��ְ����']
																																																																												: ( $twodata[$key]['��ְ����'] + $dataarr[$vval]['��ְ����'] ) ;
																																																																											$twodata[$key]['��ְ��������'] =empty($twodata[$key]['��ְ��������'])? $dataarr[$vval]['��ְ��������']
																																																																												: ( $twodata[$key]['��ְ��������'] + $dataarr[$vval]['��ְ��������'] ) ;
																																																																											$twodata[$key]['��������'] =empty($twodata[$key]['��������'])? $dataarr[$vval]['��������']
																																																																												: ( $twodata[$key]['��������'] + $dataarr[$vval]['��������'] ) ;
																																																																											//����
																																																																											$twoDataP[$key]['��������'] =empty($twoDataP[$key]['��������'])? $dataArrP[$vval]['��������']
																																																																												: ( $twoDataP[$key]['��������'] + $dataArrP[$vval]['��������'] ) ;
																																																																											$twoDataP[$key]['�籣������'] =empty($twoDataP[$key]['�籣������'])? $dataArrP[$vval]['�籣������']
																																																																												: ( $twoDataP[$key]['�籣������'] + $dataArrP[$vval]['�籣������'] ) ;
																																																																											$twoDataP[$key]['��������'] =empty($twoDataP[$key]['��������'])? $dataArrP[$vval]['��������']
																																																																												: ( $twoDataP[$key]['��������'] + $dataArrP[$vval]['��������'] ) ;
																																																																											$twoDataP[$key]['�ڼ��ղ���'] =empty($twoDataP[$key]['�ڼ��ղ���'])? $dataArrP[$vval]['�ڼ��ղ���']
																																																																												: ( $twoDataP[$key]['�ڼ��ղ���'] + $dataArrP[$vval]['�ڼ��ղ���'] ) ;
																																																																											$twoDataP[$key]['�Ͳ�'] =empty($twoDataP[$key]['�Ͳ�'])? $dataArrP[$vval]['�Ͳ�']
																																																																												: ( $twoDataP[$key]['�Ͳ�'] + $dataArrP[$vval]['�Ͳ�'] ) ;
																																																																											$twoDataP[$key]['����'] =empty($twoDataP[$key]['����'])? $dataArrP[$vval]['����']
																																																																												: ( $twoDataP[$key]['����'] + $dataArrP[$vval]['����'] ) ;
																																																																											$twoDataP[$key]['��Ŀ��'] =empty($twoDataP[$key]['��Ŀ��'])? $dataArrP[$vval]['��Ŀ��']
																																																																												: ( $twoDataP[$key]['��Ŀ��'] + $dataArrP[$vval]['��Ŀ��'] ) ;
																																																																											$twoDataP[$key]['��Ŀ����'] =empty($twoDataP[$key]['��Ŀ����'])? $dataArrP[$vval]['��Ŀ����']
																																																																												: ( $twoDataP[$key]['��Ŀ����'] + $dataArrP[$vval]['��Ŀ����'] ) ;
																																																																											$twoDataP[$key]['��ְ����'] =empty($twoDataP[$key]['��ְ����'])? $dataArrP[$vval]['��ְ����']
																																																																												: ( $twoDataP[$key]['��ְ����'] + $dataArrP[$vval]['��ְ����'] ) ;
																																																																											$twoDataP[$key]['��ְ��������'] =empty($twoDataP[$key]['��ְ��������'])? $dataArrP[$vval]['��ְ��������']
																																																																												: ( $twoDataP[$key]['��ְ��������'] + $dataArrP[$vval]['��ְ��������'] ) ;
																																																																											$twoDataP[$key]['��������'] =empty($twoDataP[$key]['��������'])? $dataArrP[$vval]['��������']
																																																																												: ( $twoDataP[$key]['��������'] + $dataArrP[$vval]['��������'] ) ;

																																																																											$sumi[$i]=$i;

																																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, $i,  iconv ( "gb2312", "utf-8", $vval ) );
																																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (3, $i,  $dataarr[$vval]['��������'] );
																																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (4, $i,  $dataarr[$vval]['�籣������'] );
																																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (5, $i,  $dataarr[$vval]['��������'] );
																																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (6, $i,  $dataarr[$vval]['�ڼ��ղ���'] );
																																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (7, $i,  $dataarr[$vval]['�Ͳ�'] );
																																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (8, $i,  $dataarr[$vval]['����'] );
																																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (9, $i,  $dataarr[$vval]['��Ŀ��'] );
																																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (10, $i,  $dataarr[$vval]['��Ŀ����'] );
																																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (11, $i,  '=SUM(D'.$i.':K'.$i.')' );
																																																																													$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (12, $i,  $dataarr[$vval]['��ְ����'] );
																																																																													$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (13, $i,  $dataarr[$vval]['��ְ��������'] );
																																																																													$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (14, $i,  '=SUM(L'.$i.',M'.$i.')' );
																																																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (15, $i,  $dataarr[$vval]['��������'] );
																																																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (16, $i,  '=L'.$i.'/'.'P'.$i );

																																																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (17, $i,  $dataArrP[$vval]['��������'] );
																																																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (18, $i,  $dataArrP[$vval]['�籣������'] );
																																																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (19, $i,  $dataArrP[$vval]['��������'] );
																																																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (20, $i,  $dataArrP[$vval]['�ڼ��ղ���'] );
																																																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (21, $i,  $dataArrP[$vval]['�Ͳ�'] );
																																																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (22, $i,  $dataArrP[$vval]['����'] );
																																																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (23, $i,  $dataArrP[$vval]['��Ŀ��'] );
																																																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (24, $i,  $dataArrP[$vval]['��Ŀ����'] );
																																																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (25, $i,  '=SUM(R'.$i.':Y'.$i.')' );
																																																																															$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (26, $i,  $dataArrP[$vval]['��ְ����'] );
																																																																															$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (27, $i,  $dataArrP[$vval]['��ְ��������'] );
																																																																															$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (28, $i,  '=SUM(Z'.$i.',AA'.$i.')' );
																																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (29, $i,  $dataArrP[$vval]['��������'] );
																																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (30, $i,  '=Z'.$i.'/'.'AD'.$i );

																																																																																$i++;//������
																																																																																$n++;

																																																																																}//����
																																																																																if($n>1){//����
																																																																																$objPhpExcelFile->getActiveSheet ()->mergeCells ('A' . ($i-$n).':'.'A' . ($i) );//�ϲ�
																																																																																$objPhpExcelFile->getActiveSheet()->getStyle( 'A'.$i.':U'.$i)->getFont()->setSize(10);
																																																																																$objPhpExcelFile->getActiveSheet()->getStyle( 'A'.$i.':U'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
																																																																																->getStartColor()->setRGB('8FBC8F');

																																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (0, $i, iconv ( "gb2312", "utf-8", $key ) );
																																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, $i, iconv ( "gb2312", "utf-8", 'С��' ) );

																																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (3, $i,  '=SUM(D'.($i-$n).':D'.($i-1).')');
																																																																																	$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (4, $i,  '=SUM(E'.($i-$n).':E'.($i-1).')');
																																																																																		$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (5, $i, '=SUM(F'.($i-$n).':F'.($i-1).')');
																																																																																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (6, $i, '=SUM(G'.($i-$n).':G'.($i-1).')' );
																																																																																				$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (7, $i,  '=SUM(H'.($i-$n).':H'.($i-1).')');
																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (8, $i, '=SUM(I'.($i-$n).':I'.($i-1).')');
																																																																																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (9, $i, '=SUM(J'.($i-$n).':J'.($i-1).')' );
																																																																																							$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (10, $i, '=SUM(K'.($i-$n).':K'.($i-1).')' );
																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (11, $i, '=SUM(L'.($i-$n).':L'.($i-1).')' );
																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (12, $i, '=SUM(M'.($i-$n).':M'.($i-1).')' );
																																																																																										$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (13, $i, '=SUM(N'.($i-$n).':N'.($i-1).')' );
																																																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (14, $i, '=SUM(O'.($i-$n).':O'.($i-1).')' );
																																																																																												$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (15, $i, '=SUM(P'.($i-$n).':P'.($i-1).')' );
																																																																																													$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (16, $i, '=L'.$i.'/'.'P'.$i );
																																																																																													//����
																																																																																													$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (17, $i,  '=SUM(R'.($i-$n).':R'.($i-1).')');
																																																																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (18, $i,  '=SUM(S'.($i-$n).':S'.($i-1).')');
																																																																																															$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (19, $i, '=SUM(T'.($i-$n).':T'.($i-1).')');
																																																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (20, $i, '=SUM(U'.($i-$n).':U'.($i-1).')' );
																																																																																																	$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (21, $i,  '=SUM(V'.($i-$n).':V'.($i-1).')');
																																																																																																		$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (22, $i, '=SUM(W'.($i-$n).':W'.($i-1).')');
																																																																																																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (23, $i, '=SUM(X'.($i-$n).':X'.($i-1).')' );
																																																																																																				$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (24, $i, '=SUM(Y'.($i-$n).':Y'.($i-1).')' );
																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (25, $i, '=SUM(Z'.($i-$n).':Z'.($i-1).')' );
																																																																																																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (26, $i, '=SUM(AA'.($i-$n).':AA'.($i-1).')' );
																																																																																																							$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (27, $i, '=SUM(AB'.($i-$n).':AB'.($i-1).')' );
																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (28, $i, '=SUM(AC'.($i-$n).':AC'.($i-1).')' );
																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (29, $i, '=SUM(AD'.($i-$n).':AD'.($i-1).')' );
																																																																																																										$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (30, $i, '=Z'.$i.'/'.'AD'.$i );

																																																																																																										$i++;//������
																																																																																																										}
																																																																																																										}
																																																																																																										$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (0, $i, '' );
																																																																																																										$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, $i, 'Total' );

																																																																																																										$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (3, $i, '=SUM('.$this->get_cells_str('D',$sumi).')' );
																																																																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (4, $i, '=SUM('.$this->get_cells_str('E',$sumi).')' );
																																																																																																												$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (5, $i, '=SUM('.$this->get_cells_str('F',$sumi).')' );
																																																																																																													$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (6, $i, '=SUM('.$this->get_cells_str('G',$sumi).')' );
																																																																																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (7, $i, '=SUM('.$this->get_cells_str('H',$sumi).')' );
																																																																																																															$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (8, $i, '=SUM('.$this->get_cells_str('I',$sumi).')' );
																																																																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (9, $i, '=SUM('.$this->get_cells_str('J',$sumi).')' );
																																																																																																																	$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (10, $i, '=SUM('.$this->get_cells_str('K',$sumi).')' );
																																																																																																																		$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (11, $i, '=SUM('.$this->get_cells_str('L',$sumi).')' );
																																																																																																																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (12, $i, '=SUM('.$this->get_cells_str('M',$sumi).')' );
																																																																																																																				$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (13, $i, '=SUM('.$this->get_cells_str('N',$sumi).')' );
																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (14, $i, '=SUM('.$this->get_cells_str('P',$sumi).')' );
																																																																																																																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (15, $i, '=SUM('.$this->get_cells_str('Q',$sumi).')' );
																																																																																																																							$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (16, $i, '=L'.$i.'/'.'P'.$i );

																																																																																																																							$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (17, $i, '=SUM('.$this->get_cells_str('R',$sumi).')' );
																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (18, $i, '=SUM('.$this->get_cells_str('S',$sumi).')' );
																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (19, $i, '=SUM('.$this->get_cells_str('T',$sumi).')' );
																																																																																																																										$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (20, $i, '=SUM('.$this->get_cells_str('U',$sumi).')' );
																																																																																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (21, $i, '=SUM('.$this->get_cells_str('V',$sumi).')' );
																																																																																																																												$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (22, $i, '=SUM('.$this->get_cells_str('W',$sumi).')' );
																																																																																																																													$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (23, $i, '=SUM('.$this->get_cells_str('X',$sumi).')' );
																																																																																																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (24, $i, '=SUM('.$this->get_cells_str('Y',$sumi).')' );
																																																																																																																															$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (25, $i, '=SUM('.$this->get_cells_str('Z',$sumi).')' );
																																																																																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (26, $i, '=SUM('.$this->get_cells_str('AA',$sumi).')' );
																																																																																																																																	$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (27, $i, '=SUM('.$this->get_cells_str('AB',$sumi).')' );
																																																																																																																																		$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (28, $i, '=SUM('.$this->get_cells_str('AC',$sumi).')' );
																																																																																																																																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (29, $i, '=SUM('.$this->get_cells_str('AD',$sumi).')' );
																																																																																																																																				$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (30, $i, '=Z'.$i.'/'.'AD'.$i );


																																																																																																																																				}

																																																																																																																																				$objPhpExcelFile->setActiveSheetIndex(1);
																																																																																																																																				$objPhpExcelFile->getActiveSheet ()->setTitle ( iconv ( "gb2312", "utf-8", '��������'.$sm.'�³ɱ�' ) );
																																																																																																																																				if($sy==2014){
																																																																																																																																				$yfarray=array('����ר��','������Դ��','����','���»�칫��','����ҵ��','��Ʋ�','��Ӫ�Ŷ�'
																																																																																																																																					,'ͳһ��Ӫ֧�Ų�','�з��ۺϲ�','�����о���','�����Ǳ��Ʒ��','�Ե�ר��','������'
																																																																																																																																					,'�ۺϲ�','Ӫ����','����ִ������','���������','�����Ż���Ʒ��','����');
																																																																																																																																				}elseif($sy==2015){
																																																																																																																																				$yfarray=array('����','���»�칫��','����ר��','���ſͻ���'
																																																																																																																																					,'��Ӫ�Ŷ�','������Դ��','��Ʋ�','ͨ�ŷ�����ҵ��','ͳһ��Ӫ֧�Ų�','����ר��'
																																																																																																																																					,'�з��ۺϲ�','�����Ǳ���ҵ��','Ӫ����','�ۺϲ�','�����Ŷ�','������Ӫ����','ս�Է�չ��','��������ҵ��','����');
																																																																																																																																				}elseif($sy==2016){
																																																																																																																																				$yfarray=array('��������','����ҵ��������','��ҵ��������','����ҵ��������','�ۺϹ�������','�ۺϹ���','ս�Է�չ��',
																																																																																																																																					'��Ӫ����','������ҵ��','�����Ǳ�','����֧�Ų�','���ܲ�Ʒ��','�����ݲ�','��������','��������','��������','��������',
																																																																																																																																					'��������','��������','��������',
																																																																																																																																					'ϵͳ������','����֧�Ų�','��ҵ����ҵ��','���ݼ���Ӫ��','��Ʒ��','ƽ̨������','�·�����չ��','�������','֤ȯ��','��Ʋ�','��Ӫ�Ŷ�','����');
																																																																																																																																				}
																																																																																																																																				$n=3;
																																																																																																																																				//print_r($twodata);
																																																																																																																																				//die();
																																																																																																																																				foreach($yfarray as $key=>$val){
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1,$n, $twodata[$val]['��������'] );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2,$n, $twodata[$val]['�籣������'] );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (3,$n, $twodata[$val]['��������'] );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (4,$n, $twodata[$val]['�ڼ��ղ���'] );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (5,$n, $twodata[$val]['�Ͳ�'] );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (6,$n, $twodata[$val]['����'] );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (7,$n, $twodata[$val]['��Ŀ��'] );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (8,$n, $twodata[$val]['��Ŀ����'] );
																																																																																																																																					//$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (4,$n, '=SUM(B'.$n.':D'.$n.')' );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (10,$n, $twodata[$val]['��ְ����'] );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (11,$n, $twodata[$val]['��ְ��������'] );
																																																																																																																																					//$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (6,$n, '=SUM(E'.$n.',F'.$n.')' );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (13,$n, $twodata[$val]['��������'] );
																																																																																																																																					//$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (8,$n, '=G'.$n.'/H'.$n.'' );

																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (15,$n, $twoDataP[$val]['��������'] );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (16,$n, $twoDataP[$val]['�籣������'] );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (17,$n, $twoDataP[$val]['��������'] );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (18,$n, $twoDataP[$val]['�ڼ��ղ���'] );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (19,$n, $twoDataP[$val]['�Ͳ�'] );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (20,$n, $twoDataP[$val]['����'] );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (21,$n, $twoDataP[$val]['��Ŀ��'] );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (22,$n, $twoDataP[$val]['��Ŀ����'] );
																																																																																																																																					//$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (22,$n, '=SUM(B'.$n.':D'.$n.')' );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (24,$n, $twoDataP[$val]['��ְ����'] );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (25,$n, $twoDataP[$val]['��ְ��������'] );
																																																																																																																																					//$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (24,$n, '=SUM(E'.$n.',F'.$n.')' );
																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (27,$n, $twoDataP[$val]['��������'] );
																																																																																																																																					//$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (26,$n, '=G'.$n.'/H'.$n.'' );

																																																																																																																																					$n++;
																																																																																																																																				}
																																																																																																																																				$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1,$n, '=SUM(B3:B'.($n-1).')' );
																																																																																																																																						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2,$n, '=SUM(C3:C'.($n-1).')' );
																																																																																																																																							$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (3,$n, '=SUM(D3:D'.($n-1).')' );
																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (4,$n, '=SUM(E3:E'.($n-1).')' );
																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (5,$n, '=SUM(F3:F'.($n-1).')' );
																																																																																																																																										$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (6,$n, '=SUM(G3:G'.($n-1).')' );
																																																																																																																																											$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (7,$n, '=SUM(H3:H'.($n-1).')' );
																																																																																																																																												$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (8,$n, '=SUM(I3:I'.($n-1).')' );
																																																																																																																																													//$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (5,$n, '=SUM(F3:F'.($n-1).')' );
																																																																																																																																												$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (10,$n, '=SUM(K3:K'.($n-1).')' );
																																																																																																																																														//$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (7,$n, '=SUM(H3:H'.($n-1).')' );
																																																																																																																																												$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (12,$n, '=SUM(M3:M'.($n-1).')' );

																																																																																																																																														$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (14,$n, '=SUM(O3:O'.($n-1).')' );
																																																																																																																																															$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (15,$n, '=SUM(P3:P'.($n-1).')' );
																																																																																																																																																$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (16,$n, '=SUM(Q3:Q'.($n-1).')' );
																																																																																																																																																	$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (17,$n, '=SUM(R3:R'.($n-1).')' );
																																																																																																																																																		$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (18,$n, '=SUM(S3:S'.($n-1).')' );
																																																																																																																																																			$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (19,$n, '=SUM(T3:T'.($n-1).')' );
																																																																																																																																																				$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (20,$n, '=SUM(U3:U'.($n-1).')' );
																																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (21,$n, '=SUM(V3:V'.($n-1).')' );
																																																																																																																																																						//$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (5,$n, '=SUM(W3:F'.($n-1).')' );
																																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (23,$n, '=SUM(X3:X'.($n-1).')' );
																																																																																																																																																							//$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (7,$n, '=SUM(Y3:H'.($n-1).')' );
																																																																																																																																																					$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (25,$n, '=SUM(Z3:Z'.($n-1).')' );

																																																																																																																																																							}

																																																																																																																																																							$objPhpExcelFile->setActiveSheetIndex(0);
																																																																																																																																																							}elseif($flag=='gs_cp'){//����ͳ�ƶԱ�
																																																																																																																																																							$is_echo=true;//�ر�
																																																																																																																																																							$bi=4;//�������������
																																																																																																																																																							$sy=$_REQUEST['sy'];
																																																																																																																																																							$sm=$_REQUEST['sm'];
																																																																																																																																																							$filename.=$sy.'-'.$sm; //�����ļ���
																																																																																																																																																							$setString=array(0//Ա����
																																																																																																																																																								,'A'
																																																																																																																																																								);
																																																																																																																																																							$objPhpExcelFile->setActiveSheetIndex(0);
																																																																																																																																																							$dataarr = un_iconv($this->model_user_total());
																																																																																																																																																							}elseif($flag=='wy_salary') {
																																																																																																																																																							$sy=$_REQUEST['seapy'];//���
																																																																																																																																																							$sm=$_REQUEST['seapm'];//�·�
																																																																																																																																																							$filename =$sy.'-'.$sm.$filename; //�����ļ���
																																																																																																																																																							$objPhpExcelFile->setActiveSheetIndex(0);
																																																																																																																																																							$objPhpExcelFile->getActiveSheet ()->setTitle ( iconv ( "gb2312", "utf-8", $sy.'-'.$sm.'Ӧ������+����' ) );
																																																																																																																																																							$sql="select p.userCard,p.userName,d.DEPT_NAME,h.COME_DATE,p.jjAm,p.gljtAm,p.lszsAm,p.txjt,p.qtjtam,p.expenCeiling from salary_pro p left join department d on (p.pyear = '$sy' and p.pmon = '$sm' and p.DeptId = d.DEPT_ID) left join hrms h on h.USER_ID = p.userId order by p.DeptId , h.UserCard";
																																																																																																																																																							$query=$this->db->query($sql);
																																																																																																																																																							$rowIndex = 2;
																																																																																																																																																							while($row=$this->db->fetch_array($query)){
																																																																																																																																																								//��Ŀ��Ч����
																																																																																																																																																								$jjam = round($this->salaryClass->decryptDeal($row['jjAm']),2);
																																																																																																																																																								//��Ŀ������
																																																																																																																																																								$gljtam = round($this->salaryClass->decryptDeal($row['gljtAm']),2);
																																																																																																																																																								//��Ŀס�޲���
																																																																																																																																																								$lszsam = round($this->salaryClass->decryptDeal($row['lszsAm']),2);
																																																																																																																																																								//��Ŀͨ�Ų���
																																																																																																																																																								$txjt = round($this->salaryClass->decryptDeal($row['txjt']),2);
																																																																																																																																																								//��Ŀ���Բ���
																																																																																																																																																								$qtjtam = round($this->salaryClass->decryptDeal($row['qtjtam']),2);
																																																																																																																																																								//�����
																																																																																																																																																								$expenCeiling = round($this->salaryClass->decryptDeal($row['expenCeiling']),2);

																																																																																																																																																								//����Ӧ������
																																																																																																																																																								$yffd = round($jjam+$gljtam+$lszsam+$txjt+$qtjtam,2);

																																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueExplicitByColumnAndRow (0, $rowIndex, iconv ( "gb2312", "utf-8", $row['userCard']));
																																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, $rowIndex, iconv ( "gb2312", "utf-8", $row['userName']));
																																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, $rowIndex, iconv ( "gb2312", "utf-8", $row['DEPT_NAME']));
																																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (3, $rowIndex, iconv ( "gb2312", "utf-8", $row['COME_DATE']));
																																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (4, $rowIndex, iconv ( "gb2312", "utf-8", $jjam));
																																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (5, $rowIndex, iconv ( "gb2312", "utf-8", $gljtam));
																																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (6, $rowIndex, iconv ( "gb2312", "utf-8", $lszsam));
																																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (7, $rowIndex, iconv ( "gb2312", "utf-8", $txjt));
																																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (8, $rowIndex, iconv ( "gb2312", "utf-8", $qtjtam));
																																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (9, $rowIndex, iconv ( "gb2312", "utf-8", '') );//��������
																																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (10, $rowIndex, iconv ( "gb2312", "utf-8", $yffd) );
																																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (11, $rowIndex, iconv ( "gb2312", "utf-8", '')); //������ע
																																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (12, $rowIndex, iconv ( "gb2312", "utf-8", $expenCeiling));
																																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (13, $rowIndex, iconv ( "gb2312", "utf-8", '') );//���������
																																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (14, $rowIndex, iconv ( "gb2312", "utf-8", $expenCeiling));//������ܶ�
																																																																																																																																																								$rowIndex++;
																																																																																																																																																							}
																																																																																																																																																							}elseif($flag=='salary_base') {
																																																																																																																																																								$objPhpExcelFile->setActiveSheetIndex(0);
																																																																																																																																																								$objPhpExcelFile->getActiveSheet ()->setTitle ( iconv ( "gb2312", "utf-8", 'н�ʽṹ' ) );
																																																																																																																																																								$sql="select p.userCard,p.userName,d.DEPT_NAME,h.COME_DATE,p.jjAm,p.gljtAm,p.lszsAm,p.txjt,p.qtjtam,p.expenCeiling from salary_pro p left join department d on (p.pyear = '$sy' and p.pmon = '$sm' and p.DeptId = d.DEPT_ID) left join hrms h on h.USER_ID = p.userId order by p.DeptId , h.UserCard";
																																																																																																																																																								$query=$this->db->query($sql);
																																																																																																																																																								$rowIndex = 2;
																																																																																																																																																								$salaryData = $this->model_hr_salary_user(true,'',false,false,'xls','');

																																																																																																																																																								foreach($salaryData as $key=>$val){
																																																																																																																																																									$row=$salaryData[$key];
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueExplicitByColumnAndRow (0, $rowIndex, iconv ( "gb2312", "utf-8", $row['usercard']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (1, $rowIndex, iconv ( "gb2312", "utf-8", $row['username']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (2, $rowIndex, iconv ( "gb2312", "utf-8", $row['usercom']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (3, $rowIndex, iconv ( "gb2312", "utf-8", $row['deptname']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (4, $rowIndex, iconv ( "gb2312", "utf-8", $row['amount']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (5, $rowIndex, iconv ( "gb2312", "utf-8", $row['gwam']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (6, $rowIndex, iconv ( "gb2312", "utf-8", $row['jxam']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (7, $rowIndex, iconv ( "gb2312", "utf-8", $row['jjam']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (8, $rowIndex, iconv ( "gb2312", "utf-8", $row['gljtam']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (9, $rowIndex, iconv ( "gb2312", "utf-8", $row['lszsam']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (10, $rowIndex, iconv ( "gb2312", "utf-8", $row['txjt'] ));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (11, $rowIndex, iconv ( "gb2312", "utf-8", $row['qtjtam']) );
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (12, $rowIndex, iconv ( "gb2312", "utf-8", $row['bdbfzxc'])); 
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (13, $rowIndex, iconv ( "gb2312", "utf-8", $row['zxc']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (14, $rowIndex, iconv ( "gb2312", "utf-8", $row['expenCeiling']) );
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (15, $rowIndex, iconv ( "gb2312", "utf-8", $row['gjjam']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (16, $rowIndex, iconv ( "gb2312", "utf-8", $row['shbam']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (17, $rowIndex, iconv ( "gb2312", "utf-8", $row['comedt']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (18, $rowIndex, iconv ( "gb2312", "utf-8", $row['oldarea']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueExplicitByColumnAndRow (19, $rowIndex, iconv ( "gb2312", "utf-8", $row['acc']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (20, $rowIndex, iconv ( "gb2312", "utf-8", $row['accbank']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (21, $rowIndex, iconv ( "gb2312", "utf-8", $row['idcard']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (22, $rowIndex, iconv ( "gb2312", "utf-8", $row['email']));
																																																																																																																																																									$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow (23, $rowIndex, iconv ( "gb2312", "utf-8", $row['usersta']));
																																																																																																																																																									$rowIndex++;
																																																																																																																																																								} 
																																																																																																																																																							}

	if($is_echo){
		//���ñ�ͷ����ʽ ����
		$i = $bi;
		if(!empty($dataarr)){
			foreach($dataarr as $key=>$val){
				$n=0;//�ж���
				foreach($val as $vkey=>$vval ){
					if(in_array($n , $setString,true)||in_array($gl->numToCell($n) , $setString,true)){
						$objPhpExcelFile->getActiveSheet ()->setCellValueExplicitByColumnAndRow ($n, $i, $vval );
					}else{
						$objPhpExcelFile->getActiveSheet ()->setCellValueByColumnAndRow ($n, $i, $vval );
					}
					$n++;//������
				}
				$i++;//������
			}
		}
	}
	//�������
	ob_end_clean (); //��������������������������
	header ( "Content-Type: application/force-download" );
	header ( "Content-Type: application/octet-stream" );
	header ( "Content-Type: application/download" );
	header ( 'Content-Disposition:inline;filename="' . $filename. ".$endName" . '"' );
	header ( "Content-Transfer-Encoding: binary" );
	header ( "Expires: 0" );
	header ( "Last-Modified: " . gmdate ( "D, d M Y H:i:s" ) . " GMT" );
	header ( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
	header ( "Pragma: no-cache" );
	$objWriter->save ( 'php://output' );
}
/**
 * ��Ա����ͳ��
 */
function model_user_total(){
	$res=array();
	$sqlSch = " and p.pyear in (2012,2013) ";
	echo $sql = "
		select
		p.gjjam , p.shbam
		, p.remark , p.baseam , p.floatam , p.proam , p.otheram
		, p.bonusam , p.othdelam , p.perholsdays , p.sickholsdays , p.paycesse , p.paytotal , p.sperewam ,p.spedelam
		, p.pyear , p.pmon
		, p.sdyam , p.holsdelam , 'dl' as company , p.expflag , p.basenowam  ,  p.cogjjam , p.coshbam
		, p.accrewam , p.accdelam , p.nowamflag , p.userid , p.deptid  , p.leaveflag , p.jfcom , p.manageam
		from salary_pay p
		where
		p.leaveflag='0'
		$sqlSch
		";
	$query=$this->db->query($sql);
	while($row=$this->db->fetch_array($query)){
		$res[$row['userid']]['baseam'][$row['pyear']][$row['pmon']]=$this->salaryClass->decryptDeal($row['baseam']);
		$res[$row['userid']]['otheram'][$row['pyear']][$row['pmon']]=round(
				$this->salaryClass->decryptDeal($row['floatam'])
				+$this->salaryClass->decryptDeal($row['proam'])
				+$this->salaryClass->decryptDeal($row['sdyam'])
				+$this->salaryClass->decryptDeal($row['otheram'])
				+$this->salaryClass->decryptDeal($row['bonusam'])
				+$this->salaryClass->decryptDeal($row['sperewam'])
				,2);
	}
	//����
	$sql="SELECT y.UserCard , h.USER_ID as userid , y.SYear , y.YearAm FROM `salary_yeb` y
		LEFT JOIN hrms h on ( y.UserCard = h.UserCard )
		where y.SYear in ( 2012 , 2013 );";
	$query=$this->db->query($sql);
	while($row=$this->db->fetch_array($query)){
		$res[$row['userid']]['yearam'][$row['SYear']]=$this->salaryClass->decryptDeal($row['YearAm']);

	}
	//��Ա
	$user=array();
	$sql="SELECT u.USER_ID , u.USER_NAME , u.Company , d.pdeptname , d.DEPT_NAME , h.UserCard   FROM `user` u
		LEFT JOIN salary s on (u.USER_ID = s.UserId)
		LEFT JOIN department d on (u.DEPT_ID = d.DEPT_ID)
		LEFT JOIN hrms h on (u.USER_ID = h.USER_ID )
		where
		u.HAS_LEFT=0 and s.UserSta<>3 ;";
	$query=$this->db->query($sql);
	while($row=$this->db->fetch_array($query)){
		$user[$row['USER_ID']]=array(
				'uname'=>$row['USER_NAME']
				,'com'=>$this->salaryCom[$row['Company']]
				,'pdept'=>$row['pdeptname']
				,'dept'=>$row['DEPT_NAME']
				,'ucard'=>$row['UserCard']
				);

	}
	//����
	$data = array();
	foreach($user as $key=>$val  ){
		$b12 =round( array_sum($res[$key]['baseam']['2012']),2) ;
		$ba12 =round($b12/count($res[$key]['baseam']['2012']),2);
		$o12 =round( array_sum($res[$key]['otheram']['2012']) ,2);
		$y12 =round( $res[$key]['yearam']['2012'],2);
		$t12 = round($b12+$o12+$y12,2);
		$ta12 =round( $t12/count($res[$key]['baseam']['2012']),2);

		$b13 = round(array_sum($res[$key]['baseam']['2013']),2) ;
		$ba13 =round($b13/count($res[$key]['baseam']['2013']),2);
		$o13 = round(array_sum($res[$key]['otheram']['2013']) ,2);
		$y13 = round($res[$key]['yearam']['2013'],2);
		$t13 =round( $b13+$o13+$y13,2);
		$ta13 = round($t13/count($res[$key]['baseam']['2013']),2);

		$data[$key]=array(
				'ucard'=>$val['ucard']
				,'uname'=>$val['uname']
				,'com'=>$val['com']
				,'pdept'=>$val['pdept']
				,'dept'=>$val['dept']
				,$ta12,$ba12,$b12,$y12,$o12,$t12
				,$ta13,$ba13,$b13,$y13,$o13,$t13
				);
	}
	unset($res);
	unset($user);
	return $data;
}
//
function get_cells_str($cell,$rowarr){
	$res='';
	if(!empty($rowarr)){
		foreach($rowarr as $val){
			$res.=$cell.$val.',';
		}
	}
	return trim($res,',');
}
function model_hr_xls_out(){
	global $func_limit;
	$flag=$_GET['flag'];
	$seay=$_GET['sy'];
	$seam=$_GET['sm'];
	$seacom=$_GET['seacom'];
	$comtable=$this->get_com_sql($seacom);
	$i=1;
	include( WEB_TOR . 'includes/classes/excel_out_class.php');
	$xls = new ExcelXML('gb2312', false, 'My Test Sheet');
	if($flag=='join'){
		$data = array(1=> array('���','Ա����','����','��˾','����','����','��ְ����','��ְ��������'
					,'��ְ��λ����' ,'��ְ��Ч����'
					,'��ְ���¹���','����','���֤','�˺�','������','����','¼������','״̬'));
		$sql="select
			s.rand_key , s.username , s.userid , s.olddept , h.userlevel
			, s.comedt , s.probationam , s.probationnowam , s.probationdt
			, s.usersta , h.expflag
			, s.oldarea , s.idcard , s.acc , s.accbank , s.email , s.oldname
			, s.recoverdt , s.recoveram , s.recovernowam , s.recovercdt , b.NameCN , h.usercard
			, s.gwam , s.jxam
			from salary s
			left join hrms h on ( s.userid=h.user_id )
			left join branch_info b on (b.NamePT = s.usercom )
			where
			s.userid=h.user_id
			and (
					( year(s.probationdt)='".$seay."' and  month(s.probationdt)='".$seam."' )
					or
					( year(s.recovercdt)='".$seay."' and  month(s.recovercdt)='".$seam."' )
			    )
			order by s.usersta asc , h.userlevel desc , s.probationdt desc ";
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			if(substr($row['probationdt'], 0, 4)==$seay&&substr($row['probationdt'], 5, 2)==$seam){
				$dt=$row['comedt'];
				$cdt=$row['probationdt'];
				$st=$this->userSta[$row['usersta']];
				if($row['userlevel']=='4'){
					$pa=$this->salaryClass->decryptDeal($row['probationam']);
					$pan=$this->salaryClass->decryptDeal($row['probationnowam']);
				}else{
					$pa='-';
					$pan='-';
				}
			}else{
				$dt=$row['recoverdt'];
				$cdt=$row['recovercdt'];
				$st='�ѻָ�';
				if($row['userlevel']=='4'){
					$pa=$this->salaryClass->decryptDeal($row['recoveram']);
					$pan=$this->salaryClass->decryptDeal($row['recovernowam']);
				}else{
					$pa='-';
					$pan='-';
				}
			}
			$data[]=array(
					$i,$row['usercard'],$row['username'], $row['NameCN'],$row['olddept'],$this->userLevel[$row['userlevel']]
					,$dt,$pa
					,$this->salaryClass->decryptDeal($row['gwam'])
					,$this->salaryClass->decryptDeal($row['jxam'])
					,$pan
					,$row['oldarea'],$row['idcard'],$row['acc'],$row['accbank'],$row['email'],$cdt
					,$st
				     );
			$i++;
		}
	}elseif($flag=='pass'){
		$data = array(1=> array('���','Ա����','����','��˾','����','����','ת������','ת�����������'
					,'ת�����λ����','ת����Ч����'
					,'ת�����¹���','ת��ǰ����','¼������','״̬'));
		$sql="select
			s.rand_key , s.username , s.userid , s.olddept , h.userlevel , h.join_date
			, s.passdt , s.passam , s.passnowam , s.passuserdt , b.NameCN , h.usercard
			, s.usersta
			, h.userlevel , h.expflag
			, s.passoldam
			,s.gwam ,s.jxam
			from salary s
			left join hrms h on ( s.userid=h.user_id )
			left join branch_info b on (b.NamePT = s.usercom )
			where
			s.userid=h.user_id
			and year(s.passdt)='".$seay."' and month(s.passdt)='".$seam."'
			order by s.usersta asc , h.userlevel desc , s.passuserdt desc ";
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			if($row['userlevel']=='4'){
				$pa=$this->salaryClass->decryptDeal($row['passam']);
				$pan=$this->salaryClass->decryptDeal($row['passnowam']);
				$pao=$this->salaryClass->decryptDeal($row['passoldam']);
			}else{
				$pa='-';
				$pan='-';
				$pao='-';
			}
			$data[]=array(
					$i,$row['usercard'],$row['username'], $row['NameCN'],$row['olddept'],$this->userLevel[$row['userlevel']]
					,$row['passdt'],$pa
					,$this->salaryClass->decryptDeal($row['gwam'])
					,$this->salaryClass->decryptDeal($row['jxam'])
					,$pan,$pao,$row['passuserdt']
					,$this->userSta[$row['usersta']]
				     );
			$i++;
		}
	}elseif($flag=='leave'){
		$data = array(1=> array('���','Ա����','����','��˾','����','����','��ְ����','¼������','��������'));
		$sql="select
			s.rand_key , s.username , s.userid , s.olddept , h.userlevel
			, s.leavedt , s.leavecreatedt
			, s.usersta
			, h.userlevel , h.expflag , s.freezeflag , s.freezedt , s.freezecdt , b.NameCN , h.usercard
			from salary s
			left join hrms h on ( s.userid=h.user_id )
			left join branch_info b on (b.NamePT = s.usercom )
			where
			s.userid=h.user_id
			and ( (year(s.leavedt)='".$seay."' and month(s.leavedt)='".$seam."')
					or (year(s.freezedt)='".$seay."' and month(s.freezedt)='".$seam."')
			    )
			order by s.usersta asc , h.userlevel desc , s.leavecreatedt desc ";
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			if($row['freezeflag']=='1'){
				$dt=$row['freezedt'];
				$cdt=$row['freezecdt'];
				$st='����';
			}else{
				$dt=$row['leavedt'];
				$cdt=$row['leavecreatedt'];
				$st='��ְ';
			}
			$data[]=array(
					$i,$row['usercard'],$row['username'], $row['NameCN'],$row['olddept'],$this->userLevel[$row['userlevel']]
					,$dt,$cdt,$st
				     );
			$i++;
		}
	}elseif($flag=='sdy'){
		$tflag=array('0'=>'�ܼ�¼��','1'=>'����¼��','2'=>'����¼��');
		$data = array(1=> array('���','�·�','����','��˾','Ŀǰֱ������','Ŀǰ����','����ֱ������','���²���','�Ͳ�','��������','¼������','��ע'));
		$sql="select
			s.pyear , s.pmon , u.user_name as username , tdt.dept_name as tdtname
			, td.dept_name as deptname , s.sdymeal , s.sdyother , s.flaflag
			, s.remark
			, u.company  , d.dept_name as dn , dt.dept_name as tdn
			from salary_sdy s
			left join user u on (s.userid=u.user_id)
			left join department d on (u.dept_id=d.dept_id)
			left join department dt on (dt.depart_x=left(d.depart_x,2))
			left join hrms h on (u.user_id=h.user_id)
			left join salary_pay p on (p.userid=s.userid and p.pyear=s.pyear and p.pmon=s.pmon)
			left join department td on (p.deptid=td.dept_id)
			left join department tdt on (tdt.depart_x=left(td.depart_x,2))
			left join salary_flow f on ( s.rand_key=f.salarykey )
			where
			s.pyear='2012'
			and (s.flaflag='0' or f.sta='2')
			and p.userid=s.userid and p.pyear=s.pyear and p.pmon=s.pmon
			order by s.flaflag , td.dept_id
			";
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			$data[]=array(
					$i,$row['pyear'].'-'.$row['pmon'],$this->salaryCom[$row['company']],$row['username']
					,$row['tdn'],$row['dn'],$row['tdtname'],$row['deptname']
					,$this->salaryClass->decryptDeal($row['sdymeal']),$this->salaryClass->decryptDeal($row['sdyother'])
					,$tflag[$row['flaflag']], $row['remark']
				     );
			$i++;
		}
		//
		$sql="select
			s.pyear , s.pmon , u.user_name as username , tdt.dept_name as tdtname
			, td.dept_name as deptname , s.sdymeal , s.sdyother , s.flaflag , s.remark
			, u.company , d.dept_name as dn , dt.dept_name as tdn
			from salary_sdy s
			left join user u on (s.userid=u.user_id)
			left join department d on (u.dept_id=d.dept_id)
			left join department dt on (dt.depart_x=left(d.depart_x,2))
			left join hrms h on (u.user_id=h.user_id)
			left join `shiyuanoa`.salary_pay p on (p.userid=s.userid and p.pyear=s.pyear and p.pmon=s.pmon)
			left join department td on (p.deptid=td.dept_id)
			left join department tdt on (tdt.depart_x=left(td.depart_x,2))
			left join salary_flow f on ( s.rand_key=f.salarykey )
			where
			s.pyear='2012'
			and (s.flaflag='0' or f.sta='2')
			and p.userid=s.userid and p.pyear=s.pyear and p.pmon=s.pmon
			order by s.flaflag , td.dept_id
			";
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			$data[]=array(
					$i,$row['pyear'].'-'.$row['pmon'],$this->salaryCom[$row['company']],$row['username']
					,$row['tdn'],$row['dn'],$row['tdtname'],$row['deptname']
					,$this->salaryClass->decryptDeal($row['sdymeal']),$this->salaryClass->decryptDeal($row['sdyother'])
					,$tflag[$row['flaflag']], $row['remark']
				     );
			$i++;
		}
		//
		$sql="select
			s.pyear , s.pmon , u.user_name as username , tdt.dept_name as tdtname
			, td.dept_name as deptname , s.sdymeal , s.sdyother , s.flaflag , s.remark
			, u.company , d.dept_name as dn , dt.dept_name as tdn
			from salary_sdy s
			left join user u on (s.userid=u.user_id)
			left join department d on (u.dept_id=d.dept_id)
			left join department dt on (dt.depart_x=left(d.depart_x,2))
			left join hrms h on (u.user_id=h.user_id)
			left join `beiruanoa`.salary_pay p on (p.userid=s.userid and p.pyear=s.pyear and p.pmon=s.pmon)
			left join department td on (p.deptid=td.dept_id)
			left join department tdt on (tdt.depart_x=left(td.depart_x,2))
			left join salary_flow f on ( s.rand_key=f.salarykey )
			where
			s.pyear='2012'
			and (s.flaflag='0' or f.sta='2')
			and p.userid=s.userid and p.pyear=s.pyear and p.pmon=s.pmon
			order by s.flaflag , td.dept_id
			";
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			$data[]=array(
					$i,$row['pyear'].'-'.$row['pmon'],$this->salaryCom[$row['company']],$row['username']
					,$row['tdn'],$row['dn'],$row['tdtname'],$row['deptname']
					,$this->salaryClass->decryptDeal($row['sdymeal']),$this->salaryClass->decryptDeal($row['sdyother'])
					,$tflag[$row['flaflag']], $row['remark']
				     );
			$i++;
		}
	}elseif($flag=='dp_user'){
		$sead=faddslashes($_REQUEST['sdx']);
		$seau=faddslashes($_REQUEST['sux']);
		if($seay!=='-'){
			$sqlSch.=" and p.pyear='".$seay."' ";
		}
		if($seam!=='-'){
			$sqlSch.=" and p.pmon='".$seam."' ";
		}
		if($sead){
			$sqlSch.=" and d.dept_name like '%".$sead."%' ";
		}
		if($seau){
			$sqlSch.=" and u.user_name like '%".$seau."%' ";
		}
		//������ְ��Ա
		$sqlSch.="  and ( p.nowamflag!=3 or p.nowamflag is null )  ";
		/*
		   $sqlL=" select userlevel from hrms where user_id = '".$_SESSION['USER_ID']."' ";
		   $resL=$this->db->get_one($sqlL);
		   if(!empty($resL['userlevel'])){
		   $sqlL=" and ( h.userlevel>".$resL['userlevel']." or u.user_id = '".$_SESSION['USER_ID']."')";
		   }else{
		   $sqlL="";
		   }
		 */
		global $func_limit;
		$data = array(1=> array('���','����','��˾','����','��н�·�','��������','������','�籣��'
					,'���Ƚ�','����','�۳�','��Ŀ��','�Ͳ�','��������','����','�����۳�'
					,'�¼�','����','��ٿ۳���','˰��','ʵ������','�˺�','������','���֤','��ע'));
		$xls->setStyle(array(4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20));
		$dppow=$this->model_dp_pow();
		$sqlpow=$this->getSqlParam($func_limit['�������'],$dppow);
		$sql = "(select
			s.rand_key , u.user_name as username , d.dept_name as deptname , s.olddept , s.comedt , s.oldarea
			, s.amount ,  p.gjjam , p.shbam
			, s.acc , s.accbank , s.idcard , p.remark , s.email , s.usersta , p.baseam , p.floatam , p.proam , p.otheram
			, p.bonusam , p.othdelam , p.perholsdays , p.sickholsdays , p.paycesse , p.paytotal , p.sperewam ,p.spedelam
			, h.userlevel , p.pyear , p.pmon
			, p.sdyam , p.holsdelam , u.company
			from salary_pay p
			left join salary s on ( p.userid=s.userid )
			left join hrms h on( h.user_id=s.userid )
			left join user u on (u.user_id=p.userid)
			left join department d on (p.deptid=d.dept_id)
			where p.leaveflag='0'
			$sqlpow
			$sqlSch
			order by p.id )
			union
			(
			 select
			 s.rand_key , u.user_name as username , d.dept_name as deptname , s.olddept , s.comedt , s.oldarea
			 , s.amount ,  p.gjjam , p.shbam
			 , s.acc , s.accbank , s.idcard , p.remark , s.email , s.usersta , p.baseam , p.floatam , p.proam , p.otheram
			 , p.bonusam , p.othdelam , p.perholsdays , p.sickholsdays , p.paycesse , p.paytotal , p.sperewam ,p.spedelam
			 , h.userlevel , p.pyear , p.pmon
			 , p.sdyam , p.holsdelam , u.company
			 from `beiruanoa`.salary_pay p
			 left join salary s on ( p.userid=s.userid )
			 left join hrms h on( h.user_id=s.userid )
			 left join user u on (u.user_id=p.userid)
			 left join department d on (p.deptid=d.dept_id)
			 where p.leaveflag='0'
			 $sqlpow
			 $sqlSch
			 order by p.id
			)
			union
			(
			 select
			 s.rand_key , u.user_name as username , d.dept_name as deptname , s.olddept , s.comedt , s.oldarea
			 , s.amount ,  p.gjjam , p.shbam
			 , s.acc , s.accbank , s.idcard , p.remark , s.email , s.usersta , p.baseam , p.floatam , p.proam , p.otheram
			 , p.bonusam , p.othdelam , p.perholsdays , p.sickholsdays , p.paycesse , p.paytotal , p.sperewam ,p.spedelam
			 , h.userlevel , p.pyear , p.pmon
			 , p.sdyam , p.holsdelam , u.company
			 from `shiyuanoa`.salary_pay p
			 left join salary s on ( p.userid=s.userid )
			 left join hrms h on( h.user_id=s.userid )
			 left join user u on (u.user_id=p.userid)
			 left join department d on (p.deptid=d.dept_id)
			 where p.leaveflag='0'
			 $sqlpow
			 $sqlSch
			 order by p.id
			)";
		$query=$this->db->query($sql);
		$i=1;
		while($row=$this->db->fetch_array($query)){
			$data[]=array(
					$i,$row['username'],$this->salaryCom[$row['company']],$row['deptname'],$row['pyear'].'-'.$row['pmon'],$this->salaryClass->decryptDeal($row['baseam'])
					,$this->salaryClass->decryptDeal($row['gjjam']),$this->salaryClass->decryptDeal($row['shbam'])
					,$this->salaryClass->decryptDeal($row['floatam']),$this->salaryClass->decryptDeal($row['sperewam'])
					,$this->salaryClass->decryptDeal($row['spedelam']),$this->salaryClass->decryptDeal($row['proam'])
					,$this->salaryClass->decryptDeal($row['sdyam']),$this->salaryClass->decryptDeal($row['otheram'])
					,$this->salaryClass->decryptDeal($row['bonusam']),$this->salaryClass->decryptDeal($row['othdelam'])
					,($row['perholsdays']),($row['sickholsdays']), $this->salaryClass->decryptDeal($row['holsdelam'])
					,$this->salaryClass->decryptDeal($row['paycesse']),$this->salaryClass->decryptDeal($row['paytotal'])
					,$row['acc'],$row['accbank'],$row['idcard'],$row['remark']
				     );
			$i++;
		}
	}elseif($flag=='hr_user'){
		$sead=faddslashes($_REQUEST['sdx']);
		$seau=faddslashes($_REQUEST['sux']);
		if($seay!=='-'){
			$sqlSch.=" and p.pyear='".$seay."' ";
		}
		if($seam!=='-'){
			$sqlSch.=" and p.pmon='".$seam."' ";
		}
		//����
		$sqlSch.="  and ( p.nowamflag!=3 or p.nowamflag is null )  ";

		$data = array(1=> array('���','��˾','Ա����','����','ֱ������','����','��н�·�','��������','������','�籣��'
					,'���Ƚ�','����','�۳�','��Ŀ��','�Ͳ�','��������','����','�����۳�'
					,'�¼�','����','��ٿ۳�','Ӧ������','˰��','˰��۳�','˰����','ʵ������','��˾������','��˾�籣��','�˺�','������','���֤','��ע'));
		$xls->setStyle(array(4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27));
		$dppow=$this->model_dp_pow();
		if($comtable){
			$sql = "select
				s.rand_key , u.user_name as username , d.dept_name as deptname , s.olddept , s.comedt , s.oldarea
				, s.amount ,  p.gjjam , p.shbam
				, s.acc , s.accbank , s.idcard , p.remark , s.email , s.usersta , p.baseam , p.floatam , p.proam , p.otheram
				, p.bonusam , p.othdelam , p.perholsdays , p.sickholsdays , p.paycesse , p.paytotal , p.sperewam ,p.spedelam
				, h.userlevel , p.pyear , p.pmon , h.usercard
				, p.sdyam , p.totalam , p.accdelam , p.accrewam  , dp.dept_name as dpname , u.company,p.cogjjam , p.coshbam
				from salary_pay p
				left join salary s on ( p.userid=s.userid )
				left join hrms h on( h.user_id=s.userid )
				left join user u on (u.user_id=p.userid)
				left join department d on (p.deptid=d.dept_id)
				left join department dp on (left(d.depart_x,2)=dp.depart_x)
				where p.leaveflag='0'
				$sqlSch
				order by p.id ";
		}else{
			$sql = "(select
				s.rand_key , u.user_name as username , d.dept_name as deptname , s.olddept , s.comedt , s.oldarea
				, s.amount ,  p.gjjam , p.shbam
				, s.acc , s.accbank , s.idcard , p.remark , s.email , s.usersta , p.baseam , p.floatam , p.proam , p.otheram
				, p.bonusam , p.othdelam , p.perholsdays , p.sickholsdays , p.paycesse , p.paytotal , p.sperewam ,p.spedelam
				, h.userlevel , p.pyear , p.pmon , h.usercard
				, p.sdyam , p.totalam , p.accdelam , p.accrewam , dp.dept_name as dpname , u.company
				, p.holsdelam , p.totalam,p.cogjjam , p.coshbam
				from salary_pay p
				left join salary s on ( p.userid=s.userid )
				left join hrms h on( h.user_id=s.userid )
				left join user u on (u.user_id=p.userid)
				left join department d on (p.deptid=d.dept_id)
				left join department dp on (left(d.depart_x,2)=dp.depart_x)
				where p.leaveflag='0'
				$sqlSch
				order by p.id
				)union(
					select
					s.rand_key , u.user_name as username , d.dept_name as deptname , s.olddept , s.comedt , s.oldarea
					, s.amount ,  p.gjjam , p.shbam
					, s.acc , s.accbank , s.idcard , p.remark , s.email , s.usersta , p.baseam , p.floatam , p.proam , p.otheram
					, p.bonusam , p.othdelam , p.perholsdays , p.sickholsdays , p.paycesse , p.paytotal , p.sperewam ,p.spedelam
					, h.userlevel , p.pyear , p.pmon , h.usercard
					, p.sdyam , p.totalam , p.accdelam , p.accrewam , dp.dept_name as dpname , u.company
					, p.holsdelam , p.totalam,p.cogjjam , p.coshbam
					from `shiyuanoa`.salary_pay p
					left join salary s on ( p.userid=s.userid )
					left join hrms h on( h.user_id=s.userid )
					left join user u on (u.user_id=p.userid)
					left join department d on (p.deptid=d.dept_id)
					left join department dp on (left(d.depart_x,2)=dp.depart_x)
					where p.leaveflag='0'
					$sqlSch
					order by p.id
				      )union(
					      select
					      s.rand_key , u.user_name as username , d.dept_name as deptname , s.olddept , s.comedt , s.oldarea
					      , s.amount ,  p.gjjam , p.shbam
					      , s.acc , s.accbank , s.idcard , p.remark , s.email , s.usersta , p.baseam , p.floatam , p.proam , p.otheram
					      , p.bonusam , p.othdelam , p.perholsdays , p.sickholsdays , p.paycesse , p.paytotal , p.sperewam ,p.spedelam
					      , h.userlevel , p.pyear , p.pmon , h.usercard
					      , p.sdyam , p.totalam , p.accdelam , p.accrewam , dp.dept_name as dpname , u.company
					      , p.holsdelam , p.totalam,p.cogjjam , p.coshbam
					      from `beiruanoa`.salary_pay p
					      left join salary s on ( p.userid=s.userid )
					      left join hrms h on( h.user_id=s.userid )
					      left join user u on (u.user_id=p.userid)
					      left join department d on (p.deptid=d.dept_id)
					      left join department dp on (left(d.depart_x,2)=dp.depart_x)
					      where p.leaveflag='0'
					      $sqlSch
					      order by p.id
					    )";
		}

		$query=$this->db->query($sql);
		$i=1;
		while($row=$this->db->fetch_array($query)){
			if($row['userlevel']=='4'||$func_limit['���²鿴�����']=='1'){
				$data[]=array(
						$i,$this->salaryCom[$row['company']],$row['usercard'],$row['username'],$row['dpname'],$row['deptname'],$row['pyear'].'-'.$row['pmon'],$this->salaryClass->decryptDeal($row['baseam'])
						,$this->salaryClass->decryptDeal($row['gjjam']),$this->salaryClass->decryptDeal($row['shbam'])
						,$this->salaryClass->decryptDeal($row['floatam']),$this->salaryClass->decryptDeal($row['sperewam'])
						,$this->salaryClass->decryptDeal($row['spedelam']),$this->salaryClass->decryptDeal($row['proam'])
						,$this->salaryClass->decryptDeal($row['sdyam']),$this->salaryClass->decryptDeal($row['otheram'])
						,$this->salaryClass->decryptDeal($row['bonusam']),$this->salaryClass->decryptDeal($row['othdelam'])
						,($row['perholsdays']),($row['sickholsdays'])
						,$this->salaryClass->decryptDeal($row['holsdelam'])
						,$this->salaryClass->decryptDeal($row['totalam'])
						,$this->salaryClass->decryptDeal($row['paycesse'])
						,$this->salaryClass->decryptDeal($row['accdelam']),$this->salaryClass->decryptDeal($row['accrewam'])
						,$this->salaryClass->decryptDeal($row['paytotal'])
						,$this->salaryClass->decryptDeal($row['cogjjam']),$this->salaryClass->decryptDeal($row['coshbam'])
						,$row['acc'],$row['accbank'],$row['idcard'],$row['remark']
					     );
			}else{
				$data[]=array(
						$i,$this->salaryCom[$row['company']],$row['usercard'],$row['username'],$row['dpname'],$row['deptname'],$row['pyear'].'-'.$row['pmon']
						,''
						,$this->salaryClass->decryptDeal($row['gjjam']),$this->salaryClass->decryptDeal($row['shbam'])
						,'',$this->salaryClass->decryptDeal($row['sperewam'])
						,$this->salaryClass->decryptDeal($row['spedelam']),$this->salaryClass->decryptDeal($row['proam'])
						,$this->salaryClass->decryptDeal($row['sdyam']),$this->salaryClass->decryptDeal($row['otheram'])
						,$this->salaryClass->decryptDeal($row['bonusam']),$this->salaryClass->decryptDeal($row['othdelam'])
						,($row['perholsdays']),($row['sickholsdays'])
						,'','','','','',''
						,$this->salaryClass->decryptDeal($row['cogjjam']),$this->salaryClass->decryptDeal($row['coshbam'])
						,$row['acc'],$row['accbank'],$row['idcard'],$row['remark']
					     );
			}
			$i++;
		}
	}elseif($flag=='manager'){
		$data = array(1=> array('���','Ա����','����','����','��������'));
		$xls->setStyle(array(4));
		$sql="select
			h.usercard , s.oldname , d.dept_name , s.amount
			from salary s
			left join hrms h on (s.userid=h.user_id)
			left join department d on (s.deptid=d.dept_id)
			where
			s.usersta!=3
			and h.userlevel<>4
			order by d.dept_name , s.oldname  ";
		$query=$this->db->query($sql);
		$i=1;
		while($row=$this->db->fetch_array($query)){
			$data[]=array(
					$i
					,$row['usercard']
					,$row['oldname']
					,$row['dept_name']
					,$this->salaryClass->decryptDeal($row['amount'])
				     );
			$i++;
		}
	}elseif($flag=='ymd'){
		$data = array(1=> array('���','Ա����','����','����','������������','������λ����','������Ч����'));
		$xls->setStyle(array(4));
		$sql="select
			s.username  , s.olddept , f.changeam  , f.gwam  , f.jxam
			, h.usercard
			from salary_flow f
			left join salary s on (f.userid=s.userid)
			left join hrms h on (f.userid=h.user_id)
			where
			f.createuser='".$_SESSION['USER_ID']."' and f.flowname in ( '��ȵ�н'  )";
		$query=$this->db->query($sql);
		$i=1;
		while($row=$this->db->fetch_array($query)){
			$data[]=array(
					$i
					,$row['usercard']
					,$row['username']
					,$row['olddept']
					,$this->salaryClass->decryptDeal($row['changeam'])
					,$this->salaryClass->decryptDeal($row['gwam'])
					,$this->salaryClass->decryptDeal($row['jxam'])
				     );
			$i++;
		}
	}elseif($flag=='leavemanager'){
		$seapy = $_REQUEST['sy']?$_REQUEST['sy']:$this->nowy;
		$seapm = $_REQUEST['sm']?$_REQUEST['sm']:$this->nowm;
		if($seapy&&$seapy!='-'){
			$sqlSch.=" and year(s.leavedt) = '".$seapy."' ";
		}
		if($seapm&&$seapm!='-'){
			$sqlSch.=" and month(s.leavedt) = '".$seapm."' ";
		}
		$data = array(1=> array('��˾','Ա����','����','ֱ������','����','ְ��','����' ,'��ְ����','��ְ����'
					,'��������','�¼�'
					,'����','�²��ٿ۳�','ʵ�ʹ���С��','�����','�籣��','������','�����۳�','��������˰'
					,'��ְ����','ʵ����ְ����','�˺�','������','���֤','��ע'));
		$xls->setStyle(array(7,8,9,10,11,12,13,14,15,16,17,18,19,20));
		$sql="select
			s.rand_key , u1.user_name as username , d.dept_name as olddept , s.leavedt
			, s.leavecreatedt , u.user_name , s.usersta
			, h.expflag
			, u1.company , u1.salarycom
			, year(s.leavedt) as py , month(s.leavedt) as pm , s.comedt
			, s.accbank , s.acc , s.userid , j.name as jname , h.usercard ,d.pdeptname ,s.idcard
			from salary s
			left join user u on (s.leavecreator=u.user_id)
			left join user u1 on (u1.user_id=s.userid)
			left join hrms h on (s.userid=h.user_id)
			left join department d on (u1.dept_id=d.dept_id)
			left join user_jobs j on (j.id=u1.jobs_id)
			where
			1
			$sqlSch
			order by s.usersta , s.leavecreatedt desc
			";
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			$res[$row['userid']]=array(
					'username'=>$row['username']
					,'com'=>$this->salaryCom[$row['company']]
					,'jname'=>$row['jname']
					,'expflag'=>$row['expflag']
					,'cdt'=>date('Ymd',strtotime($row['comedt']))
					,'ldt'=>date('Ymd',strtotime($row['leavedt']))
					,'lcdt'=>$row['leavecreatedt']
					,'lcu'=>$row['user_name']
					,'py'=>$row['py']
					,'pm'=> $row['pm']
					,'acc'=>$row['acc']
					,'accbank'=> $row['accbank']
					,'rk'=> $row['rand_key']
					,'comcode'=> $row['company']
					,'usercard'=> $row['usercard']
					,'pdept'=> $row['pdeptname']
					,'idcard'=> $row['idcard']

					);

		}
		if(!empty($res)){
			foreach($res as $key=>$val){
				$comtable = $this->get_com_sql($val['comcode']);
				$sp=$this->model_get_pay(
						array('userid'=>$key
							, 'pyear'=>$val['py']
							, 'pmon'=>$val['pm']
						     ),
						array(
							'BaseAm'
							,'BaseNowAm'
							,'PerHolsDays'
							,'SickHolsDays'
							,'HolsDelAm'
							,'SpeRewAm'
							,'SpeDelAm'
							,'ShbAm'
							,'GjjAm'
							,'PayCesse'
							,'AccRewAm'
							,'PayTotal'
							,'SalaryDept'
							,'Remark'
							,'ID'
						     )
							,$comtable);
				$data[] =array(
						$val['com'] , $val['usercard'] , $val['username'], $val['pdept'], $sp['SalaryDept'] , $val['jname'] , $this->expflag[$val['expflag']]
						, $val['cdt'], $val['ldt'], $this->salaryClass->decryptDeal($sp['BaseAm']), $sp['PerHolsDays'] , $sp['SickHolsDays'], $this->salaryClass->decryptDeal($sp['HolsDelAm'])
						, round($this->salaryClass->decryptDeal($sp['BaseNowAm'])-$this->salaryClass->decryptDeal($sp['HolsDelAm']),2)
						, $this->salaryClass->decryptDeal($sp['SpeRewAm'])
						, $this->salaryClass->decryptDeal($sp['ShbAm'])
						, $this->salaryClass->decryptDeal($sp['GjjAm'])
						, $this->salaryClass->decryptDeal($sp['SpeDelAm'])
						, $this->salaryClass->decryptDeal($sp['PayCesse'])
						, $this->salaryClass->decryptDeal($sp['AccRewAm'])
						, $this->salaryClass->decryptDeal($sp['PayTotal'])
						,$val['acc']
						,$val['accbank']
						,$val['idcard']
						,$sp['Remark']

					      );
				$i++;
			}
		}
	}
	$xls->addArray($data);
	$xls->generateXML(time());
}
/**
 * ���ս�����
 */
function model_hr_exp_count($ckt){
	set_time_limit(600);
	$str='';
	$infoE=array();
	try{
		$excelfilename='attachment/xls_model/'.$ckt.".xls";
		if(empty ($_FILES["ctr_file"]["tmp_name"])){
			$str='<tr><td colspan="10">�뵼�����ս�������Ϣ��</td></tr>';
		}elseif (!move_uploaded_file( $_FILES["ctr_file"]["tmp_name"], $excelfilename) ){
			$str='<tr><td colspan="10">�ϴ�ʧ�ܣ�</td></tr>';
		}else{
			//��ȡexcel��Ϣ
			include('includes/classes/excel.php');
			$excel = Excel::getInstance();
			$excel->setFile(WEB_TOR.$excelfilename);
			$excel->Open();
			$excel->setSheet();
			$excelFields = $excel->getFields();
			$excelArr=$excel->getAllData();
			$excel->Close();
			if(!in_array('����', $excelFields)||!in_array('Ա����', $excelFields)
					||!in_array('����', $excelFields)||!in_array('���ս�', $excelFields))
			{
				throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
			}
			if(count($excelArr)&&!empty($excelArr)){
				foreach($excelArr['Ա����'] as $key=>$val ){
					$infoE[$val]['name']=$excelArr['����'][$key];
					$infoE[$val]['bam']=$excelArr['����'][$key];
					$infoE[$val]['yam']=$excelArr['���ս�'][$key];
				}
			}
			if(count($infoE)){
				$totalA=array('pro'=>0);
				$i=1;
				foreach($infoE as $key=>$val){
					if(empty($key)){
						continue;
					}
					$bam=round($val['bam'],2);
					$yam=round($val['yam'],2);
					$kam=$this->salaryClass->cesseDealYeb($yam, $bam, '2000');
					$pam=round($yam-$kam,2);
					$str.='<tr>
						<td>'.$i.'</td>
						<td>'.$key.'</td>
						<td>'.$val['name'].'</td>
						<td>'.$bam.'</td>
						<td>'.$yam.'</td>
						<td>'.$kam.'</td>
						<td>'.$pam.'</td>
						</tr>';
					$i++;
				}
			}
		}
	}catch(Exception $e){
		$str='<tr><td colspan="10">�������ݴ���'.$e->getMessage().'</td></tr>';
	}
	return $str;
}
/**
 * ����
 */
function model_hr_exp_count_out($ckt){
	set_time_limit(600);
	$str='';
	$infoE=array();
	include( WEB_TOR . 'includes/classes/excel_out_class.php');
	$xls = new ExcelXML('gb2312', false, 'My Test Sheet');
	$data = array(1=> array ('���', 'Ա����', '����','����'
				,'���ս�', '��˰', 'ʵ�����')
		     );
	$xls->setStyle(array(3,4,5,6));
	try{
		$excelfilename='attachment/xls_model/'.$ckt.".xls";
		//��ȡexcel��Ϣ
		include('includes/classes/excel.php');
		$excel = Excel::getInstance();
		$excel->setFile(WEB_TOR.$excelfilename);
		$excel->Open();
		$excel->setSheet();
		$excelFields = $excel->getFields();
		$excelArr=$excel->getAllData();
		$excel->Close();
		if(!in_array('����', $excelFields)||!in_array('Ա����', $excelFields)
				||!in_array('����', $excelFields)||!in_array('���ս�', $excelFields))
		{
			throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
		}
		if(count($excelArr)&&!empty($excelArr)){
			foreach($excelArr['Ա����'] as $key=>$val ){
				$infoE[$val]['name']=$excelArr['����'][$key];
				$infoE[$val]['bam']=$excelArr['����'][$key];
				$infoE[$val]['yam']=$excelArr['���ս�'][$key];
			}
		}
		if(count($infoE)){
			$totalA=array('pro'=>0);
			$i=1;
			foreach($infoE as $key=>$val){
				if(empty($key)){
					continue;
				}
				$bam=round($val['bam'],2);
				$yam=round($val['yam'],2);
				$kam=$this->salaryClass->cesseDealYeb($yam, $bam, '2000');
				$pam=round($yam-$kam,2);
				$data[]=array(
						$i
						,$key
						,$val['name']
						,$bam
						,$yam
						,$kam
						,$pam
					     );
				$i++;
			}
		}
	}catch(Exception $e){
		$data[]=array('<tr><td colspan="10">�������ݴ���'.$e->getMessage().'</td></tr>');
	}
	$xls->addArray($data);
	$xls->generateXML(time());
}

/**
 *���ʽṹ����Դ
 * @global type $func_limit
 * @param type $flag �����ڽű����� true
 * @param type $sqlflag �ű�����
 * @param type $fnsta ���� false
 * @param type $dpsta ���� false
 * @param type $outtype �����ʽ list ; xls
 * @param type $outlist �������  hr_div  ����ר��  dp_detail ���Ų鿴
 * @return type
 */
function model_hr_salary_user($flag=true,$sqlflag='',$fnsta=false,$dpsta=false,$outtype='list',$outlist='') {
	global $func_limit;//Ȩ��
	$page = $_GET['page'];
	$limit = $_GET['rows'];
	$sidx = !empty($_GET['sidx'])?$_GET['sidx']:'d.dept_name';
	$sord = $_GET['sord'];
	$schOper = $_GET['searchOper'];
	$schStr = $_GET['searchString'];
	$schField = $_GET['searchField'];
	$seadept = $_REQUEST['seadept'];
	$seaname = $_REQUEST['seaname'];
	$seacom = $_REQUEST['seacom'];
	$seaerrs = $_REQUEST['seaerrs'];
	$isWy = $_GET['iswy'];

	$isEq = $_REQUEST['isEq'];

	$comtable = $this->get_com_sql($seacom);
	$sqlSch = '';
	$fnArr=array();
	if ($schOper) {
		$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
	}
	if($seadept&&$fnsta&&!$dpsta){
		$sqlSch.=" and s.olddept like '%".$seadept."%' ";
	}elseif($seadept){
		if($isEq==1){
			//��ѯ��ȡ�Ӳ���
			$sqlSch.=" and (d.dept_name = '".$seadept."' or d.DEPT_ID in(select d1.DEPT_ID from department d1 left join department d2 on d1.parent_id=d2.DEPT_ID where d2.dept_name = '".$seadept."' ))";
		}else{
			$sqlSch.=" and (d.dept_name like '%".$seadept."%' or d.DEPT_ID in(select d1.DEPT_ID from department d1 left join department d2 on d1.parent_id=d2.DEPT_ID where d2.dept_name like '%".$seadept."%' ))";
		}
	}
	if($seaname){
		$sqlSch.=" and ( s.username like '%".$seaname."%' or s.oldname like '%".$seaname."%' ) ";
	}
	if($seacom){
		$sqlSch.=" and s.usercom = '".$seacom."' ";
	}
	if($flag==false){
		$sqlSch.=$sqlflag;
	}

	if($func_limit['���½��ײ�������']==1){
		$sqlSch.=" and s.usersta=3  ";
	}

	if($isWy == "true") {
		$sqlSch.=" and p.personnelClass in ('RYFLGCFW','YPZW-WY')";
	}

	//��ҳ
	$start = $limit * $page - $limit;
	//����
	//ͳһ�����ݶ�ȡԴ
	$mailSql="select s.id ,
		s.rand_key , s.oldname as username , d.dept_name as deptname , s.olddept , s.comedt , s.oldarea
			, s.amount , s.gjjam,s.shbam,s.jjam,s.gljtam,s.lszsam,s.txjt,s.qtjtam ,s.gwam,s.jxam ,s.expenCeiling
			, s.acc , s.accbank , s.idcard  , s.email , s.usersta   ,s.usercom 
			, h.userlevel,u.salarycom 
			, h.usercard , d.pdeptname  
			from  salary s 
			left join hrms h on( h.user_id=s.userid )
			left join user u on (u.user_id=s.userid)
			left join department d on (s.deptid=d.dept_id)
			left join oa_hr_personnel p on (p.userAccount=u.user_id) 
			where s.sta='0'  $sqlSch";
	if($outtype=='list'){
		$sql = "select count(*)
			from salary s 
			left join hrms h on( h.user_id=s.userid )
			left join user u on (u.user_id=s.userid)
			left join department d on (s.deptid=d.dept_id)
			left join oa_hr_personnel p on (p.userAccount=u.user_id) 
			where s.sta='0' $sqlSch ";
		$rs = $this->db->get_one($sql);

		$count = $rs['count(*)'];
		if ($count > 0) {
			$total_pages = ceil($count / $limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages)
			$page = $total_pages;
		//��ҳ
		$sql = $mailSql."
			order by $sidx $sord
			limit $start , $limit ";
		$query = $this->db->query($sql);
		$i = 0;
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		while ($row = $this->db->fetch_array($query)) {
			$comtab=$this->salaryCom[$row['usercom']];
			//���¹����
			if($seaerrs=='y'){
				$totalerr=round($this->salaryClass->decryptDeal($row['totalam'])-$this->salaryClass->decryptDeal($row['gjjam'])-$this->salaryClass->decryptDeal($row['shbam']));

				if(!empty($totalerr)&&$totalerr>0){
					continue;
				}

			}
			$totalarr['gjj']+=$this->salaryClass->decryptDeal($row['gjjam']);
			$totalarr['shb']+=$this->salaryClass->decryptDeal($row['shbam']);

			//�䶯������н��
			$bdbfzxc = round($this->salaryClass->decryptDeal($row['jjam'])+$this->salaryClass->decryptDeal($row['gljtam'])+$this->salaryClass->decryptDeal($row['lszsam'])+
					$this->salaryClass->decryptDeal($row['txjt'])+$this->salaryClass->decryptDeal($row['qtjtam']),2);

			//��н��
			$zxc = round($bdbfzxc + $this->salaryClass->decryptDeal($row['amount']) + $this->salaryClass->decryptDeal($row['gwam']) + $this->salaryClass->decryptDeal($row['jxam'])
					+$this->salaryClass->decryptDeal($row['expenCeiling']),2);

			$tmp=array($row['id'], $row['usercard'],$row['username'],$comtab, $row['deptname']
					, $this->salaryClass->decryptDeal($row['amount'])
					, $this->salaryClass->decryptDeal($row['gwam'])
					, $this->salaryClass->decryptDeal($row['jxam'])
					, $this->salaryClass->decryptDeal($row['jjam'])
					, $this->salaryClass->decryptDeal($row['gljtam'])
					, $this->salaryClass->decryptDeal($row['lszsam'])
					, $this->salaryClass->decryptDeal($row['txjt'])
					, $this->salaryClass->decryptDeal($row['qtjtam'])
					, $bdbfzxc,$zxc
					, $this->salaryClass->decryptDeal($row['expenCeiling'])
					, $this->salaryClass->decryptDeal($row['gjjam'])
					, $this->salaryClass->decryptDeal($row['shbam'])
					, $row['comedt'], $row['oldarea']
					, $row['userlevel']
					, $row['acc'], $row['accbank'], $row['idcard']
					, $row['email'], $this->userSta[$row['usersta']]
				  );

			$responce->rows[$i]['id'] = $row['userid'];
			$responce->rows[$i]['cell'] = un_iconv($tmp);
			$i++;
		}
		if($fnsta==false&&$dpsta==false){
			$responce->userdata['amount'] = 'total:';
			$responce->userdata['gjjam'] = $this->salaryClass->cfv($totalarr['gjj']);
			$responce->userdata['shbam'] = $this->salaryClass->cfv($totalarr['shb']);
		}
		$this->globalUtil->insertOperateLog('���ʽṹ���¹���', 'salary', '��ʾ���ʽṹ��Ϣ', '�ɹ�', $sql);
		return $responce;
	}elseif($outtype=='xls') {
		$sql = $mailSql;
		$query = $this->db->query($sql);

		$salaryData = array();

		while ($row = $this->db->fetch_array($query)) {
			$comtab=$this->salaryCom[$row['usercom']];
			//���¹����
			if($seaerrs=='y'){
				$totalerr=round($this->salaryClass->decryptDeal($row['totalam'])-$this->salaryClass->decryptDeal($row['gjjam'])-$this->salaryClass->decryptDeal($row['shbam']));

				if(!empty($totalerr)&&$totalerr>0){
					continue;
				}

			}
			$totalarr['gjj']+=$this->salaryClass->decryptDeal($row['gjjam']);
			$totalarr['shb']+=$this->salaryClass->decryptDeal($row['shbam']);

			//�䶯������н��
			$bdbfzxc = round($this->salaryClass->decryptDeal($row['jjam'])+$this->salaryClass->decryptDeal($row['gljtam'])+$this->salaryClass->decryptDeal($row['lszsam'])+
					$this->salaryClass->decryptDeal($row['txjt'])+$this->salaryClass->decryptDeal($row['qtjtam']),2);

			//��н��
			$zxc = round($bdbfzxc + $this->salaryClass->decryptDeal($row['amount']) + $this->salaryClass->decryptDeal($row['gwam']) + $this->salaryClass->decryptDeal($row['jxam'])
					+$this->salaryClass->decryptDeal($row['expenCeiling']),2);

			$tmp=array("id"=>$row['id'], 
					"usercard"=>$row['usercard'],
					"username"=>$row['username'],
					"usercom"=>$comtab, 
					"deptname"=>$row['deptname']
					, "amount"=>$this->salaryClass->decryptDeal($row['amount'])
					, "gwam"=>$this->salaryClass->decryptDeal($row['gwam'])
					, "jxam"=>$this->salaryClass->decryptDeal($row['jxam'])
					,"jjam"=>$this->salaryClass->decryptDeal($row['jjam'])
					,"gljtam"=>$this->salaryClass->decryptDeal($row['gljtam'])
					,"lszsam"=>$this->salaryClass->decryptDeal($row['lszsam'])
					,"txjt"=>$this->salaryClass->decryptDeal($row['txjt'])
					,"qtjtam"=>$this->salaryClass->decryptDeal($row['qtjtam'])
					,"bdbfzxc"=>$bdbfzxc,"zxc"=>$zxc
					,"expenCeiling"=>$this->salaryClass->decryptDeal($row['expenCeiling'])
					,"gjjam"=>$this->salaryClass->decryptDeal($row['gjjam'])
					,"shbam"=>$this->salaryClass->decryptDeal($row['shbam'])
					,"comedt"=>$row['comedt'],"oldarea"=>$row['oldarea']
					,"userlevel"=>$row['userlevel']
					,"acc"=>$row['acc'],"accbank"=>$row['accbank'],"idcard"=>$row['idcard']
					,"email"=>$row['email'],"usersta"=>$this->userSta[$row['usersta']]
					);
			$salaryData[$row['usercard']] = $tmp;
		}
		return $salaryData;
	}
}
/**
 *��������Դ
 * @global type $func_limit
 * @param type $flag �����ڽű����� true
 * @param type $sqlflag �ű�����
 * @param type $fnsta ���� false
 * @param type $dpsta ���� false
 * @param type $outtype �����ʽ list ; xls
 * @param type $outlist �������  hr_div  ����ר��  dp_detail ���Ų鿴
 * @return type
 */
function model_hr_user($flag=true,$sqlflag='',$fnsta=false,$dpsta=false,$outtype='list',$outlist='') {
	global $func_limit;//Ȩ��
	$page = $_GET['page'];
	$limit = $_GET['rows'];
	$sidx = !empty($_GET['sidx'])?$_GET['sidx']:'d.dept_name';
	$sord = $_GET['sord'];
	$schOper = $_GET['searchOper'];
	$schStr = $_GET['searchString'];
	$schField = $_GET['searchField'];
	$seapy = $_GET['seapy']?$_GET['seapy']:$this->nowy;
	$seapm = $_GET['seapm']?$_GET['seapm']:$this->nowm;
	$seadept = $_REQUEST['seadept'];
	$seaname = $_REQUEST['seaname'];
	$seacom = $_REQUEST['seacom'];
	$seaerrs = $_REQUEST['seaerrs'];

	$isEq = $_REQUEST['isEq'];

	$comtable = $this->get_com_sql($seacom);
	$sqlSch = '';
	$fnArr=array();
	if ($schOper) {
		$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
	}
	if($seapy&&$seapy!='-'){
		$sqlSch.=" and p.pyear='".$seapy."' ";
	}
	if($seapm&&$seapm!='-'){
		$sqlSch.=" and p.pmon='".$seapm."' ";
	}
	if($seadept&&$fnsta&&!$dpsta){
		$sqlSch.=" and s.olddept like '%".$seadept."%' ";
	}elseif($seadept){
		if($isEq==1){
			//��ѯ��ȡ�Ӳ���
			$sqlSch.=" and (d.dept_name = '".$seadept."' or d.DEPT_ID in(select d1.DEPT_ID from department d1 left join department d2 on d1.parent_id=d2.DEPT_ID where d2.dept_name = '".$seadept."' ))";
		}else{
			$sqlSch.=" and (d.dept_name like '%".$seadept."%' or d.DEPT_ID in(select d1.DEPT_ID from department d1 left join department d2 on d1.parent_id=d2.DEPT_ID where d2.dept_name like '%".$seadept."%' ))";
		}
	}
	if($seaname){
		$sqlSch.=" and ( s.username like '%".$seaname."%' or s.oldname like '%".$seaname."%' ) ";
	}
	if($seacom){
		$sqlSch.=" and p.usercom = '".$seacom."' ";
	}
	if($flag==false){
		$sqlSch.=$sqlflag;
	}
	//��������ְ��Ա���� + ���˶�����Ա
	$sqlSch.="  and ( (p.nowamflag!=3 and p.nowamflag!=4) or p.nowamflag is null ) ";

	if($fnsta){
		$sqlSch.=" and ( p.comflag=1 or p.baseam not in ('mKyYBwAYs6OhZVIyCcao0A==','rayq0Lssv8erWaEbiLsxCg==') ) ";
	}else{
		$sqlSch.=" and p.comflag=1  ";
	}
	if($dpsta){
		$sqlSch.=" and p.comflag=1  ";
	}
	if($func_limit['���½��ײ�������']==1){
		$sqlSch.=" and s.usersta=3  ";
	}
	//��ҳ
	$start = $limit * $page - $limit;
	//����
	//ͳһ�����ݶ�ȡԴ
	$mailSql="select s.id ,
		s.rand_key , s.oldname as username , d.dept_name as deptname , s.olddept , s.comedt , s.oldarea
			, s.amount ,  p.gjjam , p.shbam
			, s.acc , s.accbank , s.idcard , p.remark , s.email , s.usersta , p.baseam , p.floatam , p.proam , p.otheram
			, p.bonusam , p.othdelam , p.perholsdays , p.sickholsdays , p.paycesse , p.paytotal , p.sperewam ,p.spedelam
			, h.userlevel , p.pyear , p.pmon
			, p.sdyam , p.cessebase , p.id as pid , p.expflag
			, p.cogjjam , p.coshbam , p.prepaream , p.handicapam , p.manageam
			, p.usercom as company , u.salarycom , p.totalam , p.accrewam , p.accdelam , p.holsdelam
			, h.usercard , d.pdeptname  , p.comflag , p.gwam , p.jxam
			, p.txjt
			, p.ccxs , p.khxs , p.jjam , p.gljtam , p.qtjtam , p.jxzcam, p.lszsam
			from  salary_pay p
			left join salary s on ( p.userid=s.userid )
			left join hrms h on( h.user_id=s.userid )
			left join user u on (u.user_id=p.userid)
			left join department d on (p.deptid=d.dept_id)
			where p.leaveflag='0'  $sqlSch ";
	if($outtype=='list'){
		$sql = "select count(*)
			from salary_pay p
			left join salary s on ( p.userid=s.userid  )
			left join hrms h on( h.user_id=s.userid )
			left join user u on (u.user_id=p.userid)
			left join department d on (p.deptid=d.dept_id)
			where p.leaveflag='0' $sqlSch ";
		$rs = $this->db->get_one($sql);

		$count = $rs['count(*)'];
		if ($count > 0) {
			$total_pages = ceil($count / $limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages)
			$page = $total_pages;
		//��ʶ
		if($dpsta){
			$sql="select f.flowname , p.id as pid
				from salary_flow f
				left join salary_pay p on (f.userid=p.userid and p.pyear=f.pyear and p.pmon=f.pmon )
				left join hrms h on (h.user_id=f.userid)
				where f.pyear='".$seapy."' and f.pmon='".$seapm."' and f.sta='2'
				$sqlflag ";
			$query=$this->db->query($sql);
			while($row=$this->db->fetch_array($query)){
				$fnArr[$row['pid']][]=$row['flowname'];
			}
		}
		//��ҳ
		$sql = $mailSql."
			order by $sidx $sord
			limit $start , $limit ";
		$query = $this->db->query($sql);
		$i = 0;
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		while ($row = $this->db->fetch_array($query)) {
			if(!empty($row['salarycom'])){
				$comtab=$this->salaryCom[$row['salarycom']];
			}else{
				$comtab=$this->salaryCom[$row['company']];
			}
			if($dpsta){//���Ų�ѯ
				if(!empty($fnArr[$row['pid']])){
					if(in_array('����ȵ�н-��ͨ',$fnArr[$row['pid']])||in_array('����ȵ�н-����',$fnArr[$row['pid']])
							||in_array('����ȵ�н-�ܼ�',$fnArr[$row['pid']])||in_array('����ȵ�н-����',$fnArr[$row['pid']]))
					{
						$baseam='<font color="red">'.$this->salaryClass->decryptDeal($row['baseam']).'</font>';
					}else{
						$baseam=$this->salaryClass->decryptDeal($row['baseam']);
					}
				}else{
					$baseam=$this->salaryClass->decryptDeal($row['baseam']);
				}
				$sperewam=$this->salaryClass->decryptDeal($row['sperewam']);//���⽱��
				$sperewam=$sperewam?'<font color="red">'.$sperewam.'</font>':$sperewam;
				$spedelam=$this->salaryClass->decryptDeal($row['spedelam']);//����۳�
				$spedelam=$spedelam?'<font color="red">'.$spedelam.'</font>':$spedelam;
				$proam=$this->salaryClass->decryptDeal($row['proam']);//��Ŀ��
				$proam=$proam?'<font color="red">'.$proam.'</font>':$proam;
				$floatam=$this->salaryClass->decryptDeal($row['floatam']);//���Ƚ�
				$floatam=$floatam?'<font color="red">'.$floatam.'</font>':$floatam;
				$sdyam=$this->salaryClass->decryptDeal($row['sdyam']);//�Ͳ�
				$sdyam=$sdyam?'<font color="red">'.$sdyam.'</font>':$sdyam;
				$otheram=$this->salaryClass->decryptDeal($row['otheram']);//��������
				$otheram=$otheram?'<font color="red">'.$otheram.'</font>':$otheram;
				$bosam=$this->salaryClass->decryptDeal($row['bonusam']);//����
				$bosam=$bosam?'<font color="red">'.$bosam.'</font>':$bosam;
				$othdelam=$this->salaryClass->decryptDeal($row['othdelam']);//�����۳�
				$othdelam=$othdelam?'<font color="red">'.$othdelam.'</font>':$othdelam;
				$tmp=array($row['rand_key'], $row['username'],$comtab, $row['deptname'],$row['pyear'].'-'.$row['pmon']
						, $baseam
						, $this->salaryClass->decryptDeal($row['gwam'])
						, $this->salaryClass->decryptDeal($row['jxam'])
						, $this->salaryClass->decryptDeal($row['gjjam'])
						, $this->salaryClass->decryptDeal($row['shbam'])
						, $floatam
						, $sperewam , $spedelam
						, $proam
						, $row['ccxs']
						, $row['khxs']
						, $this->salaryClass->decryptDeal($row['jjam'])
						, $this->salaryClass->decryptDeal($row['gljtam'])
						, $this->salaryClass->decryptDeal($row['qtjtam'])
						, $this->salaryClass->decryptDeal($row['jxzcam']), $this->salaryClass->decryptDeal($row['lszsam'])
						, $sdyam
						, $otheram
						, $bosam
						, $this->salaryClass->decryptDeal($row['txjt'])
						, $othdelam
						, $row['perholsdays'], $row['sickholsdays'], $this->salaryClass->decryptDeal($row['holsdelam'])
						, $this->salaryClass->decryptDeal($row['paycesse']), $this->salaryClass->decryptDeal($row['paytotal'])
						, $this->salaryClass->decryptDeal($row['cogjjam']), $this->salaryClass->decryptDeal($row['coshbam'])
						, $row['comedt'], $row['oldarea']
						, $row['userlevel']
						, $row['acc'], $row['accbank'], $row['idcard'], $row['remark']
						, $row['email'], $this->userSta[$row['usersta']]
						);
			}elseif($fnsta){//����
				$tmp=array($row['pid'],'', $row['username'], $row['olddept'],$row['pyear'].'-'.$row['pmon']
						, $this->salaryClass->decryptDeal($row['baseam'])
						, $this->salaryClass->decryptDeal($row['gjjam'])
						, $this->salaryClass->decryptDeal($row['shbam']), $this->salaryClass->decryptDeal($row['floatam'])
						, $this->salaryClass->decryptDeal($row['sperewam']), $this->salaryClass->decryptDeal($row['spedelam'])
						, $this->salaryClass->decryptDeal($row['proam'])+$this->salaryClass->decryptDeal($row['sdyam'])
						, $this->salaryClass->decryptDeal($row['otheram'])
						, $this->salaryClass->decryptDeal($row['bonusam'])
						, $this->salaryClass->decryptDeal($row['txjt'])
						, $this->salaryClass->decryptDeal($row['othdelam'])
						, $row['perholsdays'], $row['sickholsdays']
						, $this->salaryClass->decryptDeal($row['paycesse']), $this->salaryClass->decryptDeal($row['paytotal'])
						, $row['comedt'], $row['oldarea']
						, $row['userlevel']
						, $row['acc'], $row['accbank'], $row['idcard'], $row['remark']
						, $row['email'], $this->userSta[$row['usersta']],$row['cessebase']
					  );
			}elseif($row['userlevel']=='4'){//������ͨԱ��
				if($seaerrs=='y'){
					$totalerr=round($this->salaryClass->decryptDeal($row['totalam'])-$this->salaryClass->decryptDeal($row['gjjam'])-$this->salaryClass->decryptDeal($row['shbam']));

					if(!empty($totalerr)&&$totalerr>0){
						continue;
					}
				}

				$totalarr['gjj']+=$this->salaryClass->decryptDeal($row['gjjam']);
				$totalarr['shb']+=$this->salaryClass->decryptDeal($row['shbam']);
				$tmp=array($row['pid'], '-',$row['usercard'],$row['username'],$comtab, $row['deptname'],$this->expflag[$row['expflag']],$row['pyear'].'-'.$row['pmon']
						, $this->salaryClass->decryptDeal($row['baseam'])
						, $this->salaryClass->decryptDeal($row['gwam'])
						, $this->salaryClass->decryptDeal($row['jxam'])
						, $this->salaryClass->decryptDeal($row['gjjam'])
						, $this->salaryClass->decryptDeal($row['shbam']), $this->salaryClass->decryptDeal($row['floatam'])
						, $this->salaryClass->decryptDeal($row['sperewam']), $this->salaryClass->decryptDeal($row['spedelam'])
						, $this->salaryClass->decryptDeal($row['proam'])

						, $row['ccxs']
						, $row['khxs']
						, $this->salaryClass->decryptDeal($row['jjam'])
						, $this->salaryClass->decryptDeal($row['gljtam'])
						, $this->salaryClass->decryptDeal($row['qtjtam'])
						, $this->salaryClass->decryptDeal($row['jxzcam']), $this->salaryClass->decryptDeal($row['lszsam'])

						, $this->salaryClass->decryptDeal($row['sdyam'])
						, $this->salaryClass->decryptDeal($row['otheram'])
						, $this->salaryClass->decryptDeal($row['bonusam'])
						, $this->salaryClass->decryptDeal($row['txjt'])
						, $this->salaryClass->decryptDeal($row['othdelam'])
						, $row['perholsdays'], $row['sickholsdays'], $this->salaryClass->decryptDeal($row['holsdelam'])
						, round($this->salaryClass->decryptDeal($row['totalam'])-$this->salaryClass->decryptDeal($row['gjjam'])-$this->salaryClass->decryptDeal($row['shbam']),2)
						, $this->salaryClass->decryptDeal($row['paycesse'])
						, $this->salaryClass->decryptDeal($row['accdelam']), $this->salaryClass->decryptDeal($row['accrewam'])
						, $this->salaryClass->decryptDeal($row['paytotal'])
						, $this->salaryClass->decryptDeal($row['cogjjam']), $this->salaryClass->decryptDeal($row['coshbam'])
						, $this->salaryClass->decryptDeal($row['prepaream']), $this->salaryClass->decryptDeal($row['handicapam'])
						, $this->salaryClass->decryptDeal($row['manageam'])
						, $row['comedt'], $row['oldarea']
						, $row['userlevel']
						, $row['acc'], $row['accbank'], $row['idcard'], $row['remark']
						, $row['email'], $this->userSta[$row['usersta']]
						);
			}else{//���¹����
				if($seaerrs=='y'){
					$totalerr=round($this->salaryClass->decryptDeal($row['totalam'])-$this->salaryClass->decryptDeal($row['gjjam'])-$this->salaryClass->decryptDeal($row['shbam']));

					if(!empty($totalerr)&&$totalerr>0){
						continue;
					}

				}
				$totalarr['gjj']+=$this->salaryClass->decryptDeal($row['gjjam']);
				$totalarr['shb']+=$this->salaryClass->decryptDeal($row['shbam']);
				if($func_limit['���²鿴�����']=='1'){
					$tmp=array($row['pid'], '-',$row['usercard'],$row['username'],$comtab, $row['deptname'],$this->expflag[$row['expflag']],$row['pyear'].'-'.$row['pmon']
							, $this->salaryClass->decryptDeal($row['baseam'])
							, $this->salaryClass->decryptDeal($row['gwam'])
							, $this->salaryClass->decryptDeal($row['jxam'])
							, $this->salaryClass->decryptDeal($row['gjjam'])
							, $this->salaryClass->decryptDeal($row['shbam']), $this->salaryClass->decryptDeal($row['floatam'])
							, $this->salaryClass->decryptDeal($row['sperewam']), $this->salaryClass->decryptDeal($row['spedelam'])
							, $this->salaryClass->decryptDeal($row['proam'])
							, $row['ccxs']
							, $row['khxs']
							, $this->salaryClass->decryptDeal($row['jjam'])
							, $this->salaryClass->decryptDeal($row['gljtam'])
							, $this->salaryClass->decryptDeal($row['qtjtam'])
							, $this->salaryClass->decryptDeal($row['jxzcam']), $this->salaryClass->decryptDeal($row['lszsam'])
							, $this->salaryClass->decryptDeal($row['sdyam'])
							, $this->salaryClass->decryptDeal($row['otheram'])
							, $this->salaryClass->decryptDeal($row['bonusam'])
							, $this->salaryClass->decryptDeal($row['txjt'])
							, $this->salaryClass->decryptDeal($row['othdelam'])
							, $row['perholsdays'], $row['sickholsdays'], $this->salaryClass->decryptDeal($row['holsdelam'])
							, round($this->salaryClass->decryptDeal($row['totalam'])-$this->salaryClass->decryptDeal($row['gjjam'])-$this->salaryClass->decryptDeal($row['shbam']),2)
							, $this->salaryClass->decryptDeal($row['paycesse'])
							, $this->salaryClass->decryptDeal($row['accdelam']), $this->salaryClass->decryptDeal($row['accrewam'])
							, $this->salaryClass->decryptDeal($row['paytotal'])
							, $this->salaryClass->decryptDeal($row['cogjjam']), $this->salaryClass->decryptDeal($row['coshbam'])
							, $this->salaryClass->decryptDeal($row['prepaream']), $this->salaryClass->decryptDeal($row['handicapam'])
							, $this->salaryClass->decryptDeal($row['manageam'])
							, $row['comedt'], $row['oldarea']
							, $row['userlevel']
							, $row['acc'], $row['accbank'], $row['idcard'], $row['remark']
							, $row['email'], $this->userSta[$row['usersta']]
							);
				}else{
					$tmp=array($row['pid'],'-',$row['usercard'], $row['username'],$comtab, $row['deptname'],$this->expflag[$row['expflag']],$row['pyear'].'-'.$row['pmon']
							, '-','-','-'
							, $this->salaryClass->decryptDeal($row['gjjam'])
							, $this->salaryClass->decryptDeal($row['shbam']), $this->salaryClass->decryptDeal($row['floatam'])
							, $this->salaryClass->decryptDeal($row['sperewam']), $this->salaryClass->decryptDeal($row['spedelam'])
							, '-', '-', '-'
							, '-', '-'
							, '-', '-'
							, '-', '-'
							, '-', '-'
							, '-', '-'
							, '-', '-'
							, '-', '-'
							,'-','-'
							, '-', '-'
							, '-', '-'
							,'-','-'
							, $row['comedt'], $row['oldarea']
							, $row['userlevel']
							, $row['acc'], $row['accbank'], $row['idcard'], $row['remark']
							, $row['email'], $this->userSta[$row['usersta']]
							);
				}

			}
			$responce->rows[$i]['id'] = $row['userid'];
			$responce->rows[$i]['cell'] = un_iconv($tmp);
			$i++;
		}
		if($fnsta==false&&$dpsta==false){
			$responce->userdata['amount'] = 'total:';
			$responce->userdata['gjjam'] = $this->salaryClass->cfv($totalarr['gjj']);
			$responce->userdata['shbam'] = $this->salaryClass->cfv($totalarr['shb']);
		}
		$this->globalUtil->insertOperateLog('�������¹���', 'salary', '��ʾ������Ϣ', '�ɹ�', $sql);
		return $responce;
	}elseif($outtype=='xls'){
		$res=array();
		$sql = $mailSql." order by d.dept_name";
		$query = $this->db->query($sql);
		if($outlist=='hr_div'){
			while ($row = $this->db->fetch_array($query)) {
				$total=$this->salaryClass->decryptDeal($row['totalam']);
				$shb=$this->salaryClass->decryptDeal($row['shbam']);
				$gjj=$this->salaryClass->decryptDeal($row['gjjam']);
				$coshb=$this->salaryClass->decryptDeal($row['coshbam']);
				$cogjj=$this->salaryClass->decryptDeal($row['cogjjam']);
				$pre=$this->salaryClass->decryptDeal($row['prepaream']);
				$han=$this->salaryClass->decryptDeal($row['handicapam']);
				$man=$this->salaryClass->decryptDeal($row['manageam']);
				$res[]=un_iconv(array(
							$row['usercard'],$row['pyear'].'-'.$row['pmon'],$row['username'], $row['deptname']
							, $this->salaryClass->decryptDeal($row['baseam'])
							, $this->salaryClass->decryptDeal($row['proam'])
							, $this->salaryClass->decryptDeal($row['sdyam'])
							, $this->salaryClass->decryptDeal($row['otheram'])
							, $this->salaryClass->decryptDeal($row['spedelam'])
							, $this->salaryClass->decryptDeal($row['sperewam'])
							, $row['perholsdays'], $row['sickholsdays']
							, $this->salaryClass->decryptDeal($row['holsdelam'])
							//, $this->salaryClass->decryptDeal($row['othdelam'])û��ר��
							, $total
							, $shb
							, $gjj
							, $this->salaryClass->cfv($total-$shb-$gjj)
							, $this->salaryClass->decryptDeal($row['paycesse'])
							, $this->salaryClass->decryptDeal($row['paytotal'])
							, $coshb
							, $cogjj
							, $pre, $han
							, $man
							, $this->salaryClass->cfv($total+$coshb+$cogjj+$pre+$han+$man)
							, $row['remark']
							, $row['comedt']
							));
			}
			//ר�����Ӷ�����Ա $sqlflag=" and ( p.deptid in ('". implode("','", $this->divDept) ."') ) ";
			$extsql="select
				s.rand_key as sid , s.oldname as username , p.salarydept as deptname , p.deptid
				,  p.gjjam , p.shbam
				, s.acc , s.accbank , s.idcard , p.remark , s.email , s.usersta , p.baseam , p.floatam , p.proam , p.otheram
				, p.bonusam , p.othdelam , p.perholsdays , p.sickholsdays , p.paycesse , p.paytotal , p.sperewam ,p.spedelam
				, p.pyear , p.pmon
				, p.sdyam , p.cessebase , p.id as pid , p.expflag
				, p.cogjjam , p.coshbam , p.prepaream , p.handicapam , p.manageam
				, p.jfcom as company , p.totalam , p.accrewam , p.accdelam , p.holsdelam
				, p.comflag , p.usercom
				from  salary s
				left join salary_pay  p
				on ( s.userid=p.userid  and p.pyear='".$seapy."'  and p.pmon='".$seapm."'  and  p.comflag=0 )
				where s.comflag=0  and p.id is not null and ( p.deptid in ('". implode("','", $this->divDept) ."') )";
			$query=$this->db->query($extsql);
			while ($row = $this->db->fetch_array($query)) {
				$total=$this->salaryClass->decryptDeal($row['totalam']);
				$shb=$this->salaryClass->decryptDeal($row['shbam']);
				$gjj=$this->salaryClass->decryptDeal($row['gjjam']);
				$coshb=$this->salaryClass->decryptDeal($row['coshbam']);
				$cogjj=$this->salaryClass->decryptDeal($row['cogjjam']);
				$pre=$this->salaryClass->decryptDeal($row['prepaream']);
				$han=$this->salaryClass->decryptDeal($row['handicapam']);
				$man=$this->salaryClass->decryptDeal($row['manageam']);
				$res[]=un_iconv(array(
							'������Ա',$row['pyear'].'-'.$row['pmon'],$row['username'], $row['deptname']
							, $this->salaryClass->decryptDeal($row['baseam'])
							, ''
							, ''
							, ''
							, ''
							, ''
							, '', ''
							, ''
							, $total
							, $shb
							, $gjj
							, $this->salaryClass->cfv($total-$shb-$gjj)
							, $this->salaryClass->decryptDeal($row['paycesse'])
							, $this->salaryClass->decryptDeal($row['paytotal'])
							, $coshb
							, $cogjj
							, $pre, $han
							, $man
							, $this->salaryClass->cfv($total+$coshb+$cogjj+$pre+$han+$man)
							, $row['remark']
							, ''
							));
			}

		}elseif($outlist=='dp_detail'){
			while ($row = $this->db->fetch_array($query)) {
				$total=$this->salaryClass->decryptDeal($row['totalam']);
				$shb=$this->salaryClass->decryptDeal($row['shbam']);
				$gjj=$this->salaryClass->decryptDeal($row['gjjam']);
				$coshb=$this->salaryClass->decryptDeal($row['coshbam']);
				$cogjj=$this->salaryClass->decryptDeal($row['cogjjam']);
				$pre=$this->salaryClass->decryptDeal($row['prepaream']);
				$han=$this->salaryClass->decryptDeal($row['handicapam']);
				$man=$this->salaryClass->decryptDeal($row['manageam']);
				$res[]=un_iconv(array(
							$row['usercard'],$row['pyear'],$row['pmon'],$row['username'], $this->salaryCom[$row['company']]
							, $row['pdeptname'], $row['deptname']
							, $this->salaryClass->decryptDeal($row['baseam'])
							, $this->salaryClass->decryptDeal($row['gwam'])
							, $this->salaryClass->decryptDeal($row['jxam'])
							, $this->salaryClass->decryptDeal($row['proam'])
							, $this->salaryClass->decryptDeal($row['floatam'])
							, $this->salaryClass->decryptDeal($row['sperewam'])
							, $this->salaryClass->decryptDeal($row['spedelam'])
							, $this->salaryClass->decryptDeal($row['sdyam'])
							, $this->salaryClass->decryptDeal($row['otheram'])
							, $this->salaryClass->decryptDeal($row['bonusam'])
							, $this->salaryClass->decryptDeal($row['txjt'])
							, $this->salaryClass->decryptDeal($row['othdelam'])
							, $row['perholsdays'], $row['sickholsdays']
							, $this->salaryClass->decryptDeal($row['holsdelam'])
							, $total
							, $shb
							, $gjj
							, $this->salaryClass->cfv($total-$shb-$gjj)
							, $this->salaryClass->decryptDeal($row['paycesse'])
							, $this->salaryClass->decryptDeal($row['paytotal'])
							, $coshb
							, $cogjj
							, $pre, $han
							, $man
							, $row['remark']
							));
			}
		}elseif($outlist=='hr_detail'){
			while ($row = $this->db->fetch_array($query)) {
				$total=$this->salaryClass->decryptDeal($row['totalam']);
				$shb=$this->salaryClass->decryptDeal($row['shbam']);
				$gjj=$this->salaryClass->decryptDeal($row['gjjam']);
				$coshb=$this->salaryClass->decryptDeal($row['coshbam']);
				$cogjj=$this->salaryClass->decryptDeal($row['cogjjam']);
				$pre=$this->salaryClass->decryptDeal($row['prepaream']);
				$han=$this->salaryClass->decryptDeal($row['handicapam']);
				$man=$this->salaryClass->decryptDeal($row['manageam']);
				$res[]=un_iconv(array(
							$row['usercard'],$row['pyear'],$row['pmon'],$row['username'], $this->salaryCom[$row['company']]
							, $row['pdeptname'], $row['deptname']
							,$this->expflag[$row['expflag']]
							, $this->salaryClass->decryptDeal($row['baseam'])
							, $this->salaryClass->decryptDeal($row['gwam'])
							, $this->salaryClass->decryptDeal($row['jxam'])
							, $this->salaryClass->decryptDeal($row['proam'])
							, $this->salaryClass->decryptDeal($row['floatam'])
							, $this->salaryClass->decryptDeal($row['sperewam'])
							, $this->salaryClass->decryptDeal($row['spedelam'])
							, $this->salaryClass->decryptDeal($row['sdyam'])
							, $this->salaryClass->decryptDeal($row['otheram'])
							, $this->salaryClass->decryptDeal($row['bonusam'])
							, $this->salaryClass->decryptDeal($row['txjt'])
							, $this->salaryClass->decryptDeal($row['othdelam'])
							, $row['perholsdays'], $row['sickholsdays']
							, $this->salaryClass->decryptDeal($row['holsdelam'])
							, $total
							, $shb
							, $gjj
							, $this->salaryClass->cfv($total-$shb-$gjj)
							, $this->salaryClass->decryptDeal($row['paycesse'])
							, $this->salaryClass->decryptDeal($row['accrewam']), $this->salaryClass->decryptDeal($row['accdelam'])
							, $this->salaryClass->decryptDeal($row['paytotal'])
							, $coshb
							, $cogjj
							, $pre, $han
							, $man
							, $row['remark']
							, $row['acc'], $row['accbank'], $row['idcard']
							));
			}
		}

	}
	return $res;
}
/**
 * ͳ���ܶ�
 */
function model_hr_yeb_stat($seapy){
	if(empty($seapy)) {
		$seapy=2011;
	}
	$sql="select paycesse , paytotal
		from salary_pay p
		where p.pyear='$seapy'
		and p.leaveflag='0' ";
	$query = $this->db->query($sql);
	$tolam=0;
	while ($row = $this->db->fetch_array($query)) {
		$tolam=round($tolam+$this->salaryClass->decryptDeal($row['paycesse'])+$this->salaryClass->decryptDeal($row['paytotal']) ,2);
	}
	return $tolam;
}
/**
 * ͳ��
 */
function model_hr_user_stat(){
	global $func_limit;
	$page = $_GET['page'];
	$limit = $_GET['rows'];
	$sidx = $_GET['sidx']?$_GET['sidx']:'s.id';
	$sord = $_GET['sord']?$_GET['sord']:'asc';
	$schOper = $_GET['searchOper'];
	$schStr = $_GET['searchString'];
	$schField = $_GET['searchField'];
	$seapy = $_GET['seapy']?$_GET['seapy']:$this->nowy;
	$seadept = $_REQUEST['seadept'];
	$seaname = $_REQUEST['seaname'];
	$sqlSch = '';
	$fnArr=array();
	if ($schOper) {
		$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
	}
	if($seadept){
		$sqlSch.=" and d.dept_name like '%".$seadept."%' ";
	}
	if($seaname){
		$sqlSch.=" and ( s.username like '%".$seaname."%' or s.oldname like '%".$seaname."%' ) ";
	}
	$start = $limit * $page - $limit;
	//����
	$sql = "select count(*)
		from  salary s
		left join hrms h on( h.user_id=s.userid )
		left join user u on (u.user_id=s.userid)
		left join department d on (u.dept_id=d.dept_id)
		where ( s.usersta<>3  or year(s.leavedt)>=".$seapy." ) $sqlSch ";
	$rs = $this->db->get_one($sql);
	$count = $rs['count(*)'];
	if ($count > 0) {
		$total_pages = ceil($count / $limit);
	} else {
		$total_pages = 0;
	}
	if ($page > $total_pages)
		$page = $total_pages;
	//
	$sql = "select
		s.rand_key , s.oldname as username , d.dept_name as deptname , s.olddept , s.comedt
		, h.expflag
		, h.usercard
		, s.userid
		, s.passdt
		, y.yearam
		from salary s
		left join hrms h on( h.user_id=s.userid )
		left join user u on (u.user_id=s.userid)
		left join department d on (u.dept_id=d.dept_id)
		left join salary_yeb y on (y.usercard = h.usercard and y.syear='".$seapy."' )
		where ( s.usersta<>3  or year(s.leavedt)>=".$seapy." )
		$sqlSch
		order by $sidx $sord
		limit $start , $limit ";
	$query = $this->db->query($sql);
	$i = 0;
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
	$userarr=array();
	while ($row = $this->db->fetch_array($query)) {
		$userarr[$row['userid']]=array(
				'key'=>$row['rand_key'],'exp'=>$this->expflag[$row['expflag']]
				,'usercard'=>$row['usercard'], 'username'=>$row['username'], 'deptname'=>$row['deptname']
				,'comedt'=>$row['comedt'] , 'passdt'=>$row['passdt']
				,'yearam'=>$this->salaryClass->decryptDeal($row['yearam'])
				);
	}

	$payarr=array();//��������

	$sql="
		select p.baseam , p.userid , h.userlevel , s.usersta , year(s.passdt) as sy , month(s.passdt) as sm
		, p.pyear as py , p.pmon as pm , p.paycesse , p.paytotal , p.floatam,p.BaseAm,p.gwam,p.jxam,p.txjt,p.gwam,p.sperewam
		from salary_pay p
		left join hrms h on (h.user_id=p.userid)
		left join salary s on (p.userid=s.userid)
		where p.userid in ('".implode("','",array_keys($userarr))."')  and p.pyear='".$seapy."'
		and p.leaveflag<>1
		";
	$query = $this->db->query($sql);
	while ($row = $this->db->fetch_array($query)) {
		if($func_limit['����ͳ��']=='1'){
			//$payarr[$row['userid']]['spay'][$row['pm']]=$this->salaryClass->decryptDeal($row['paycesse'])+$this->salaryClass->decryptDeal($row['paytotal']);//ÿ�¹���
			//��������+��λ����+��Ч����+��Ŀ��+ͨ�Ų���+����
			$payarr[$row['userid']]['spay'][$row['pm']]=$this->salaryClass->decryptDeal($row['BaseAm'])+$this->salaryClass->decryptDeal($row['gwam'])+
				$this->salaryClass->decryptDeal($row['jxam'])+$this->salaryClass->decryptDeal($row['ProAm'])+$this->salaryClass->decryptDeal($row['txjt'])+$this->salaryClass->decryptDeal($row['sperewam']);//ÿ�¹���
			$payarr[$row['userid']]['bpay'][$row['pm']]=$this->salaryClass->decryptDeal($row['baseam']);//��������
			$payarr[$row['userid']]['fpay'][$row['pm']]=$this->salaryClass->decryptDeal($row['floatam']);//���Ƚ�

		}else{
			if($row['userlevel']=='4'){

				//$payarr[$row['userid']]['spay'][$row['pm']]=$this->salaryClass->decryptDeal($row['paycesse'])+$this->salaryClass->decryptDeal($row['paytotal']);//ÿ�¹���
				$payarr[$row['userid']]['spay'][$row['pm']]=$this->salaryClass->decryptDeal($row['BaseAm'])+$this->salaryClass->decryptDeal($row['gwam'])+
					$this->salaryClass->decryptDeal($row['jxam'])+$this->salaryClass->decryptDeal($row['ProAm'])+$this->salaryClass->decryptDeal($row['txjt'])+$this->salaryClass->decryptDeal($row['sperewam']);//ÿ�¹���
				$payarr[$row['userid']]['bpay'][$row['pm']]=$this->salaryClass->decryptDeal($row['baseam']);//��������
				$payarr[$row['userid']]['fpay'][$row['pm']]=$this->salaryClass->decryptDeal($row['floatam']);//���Ƚ�

			}else{
				$payarr[$row['userid']]['spay'][$row['pm']]=0;//ÿ�¹���
				$payarr[$row['userid']]['bpay'][$row['pm']]=0;//��������
				$payarr[$row['userid']]['fpay'][$row['pm']]=0;//���Ƚ�
				//�����ս�
				$userarr[$row['userid']]['yearam']=0;
			}
		}
	}
	if(!empty($userarr)){

		foreach($userarr as $key=>$val){
			$tmpval=array();
			$tmpval[]=$userarr[$key]['key'];
			$tmpval[]=$userarr[$key]['exp'];
			$tmpval[]=$userarr[$key]['usercard'];
			$tmpval[]=$userarr[$key]['username'];
			$tmpval[]=$userarr[$key]['deptname'];
			$tmpval[]=$userarr[$key]['comedt'];
			$tmpval[]=$userarr[$key]['passdt'];
			if(!empty($payarr[$key])){
				//����ܹ���
				$total=$this->salaryClass->finiView(array_sum($payarr[$key]['spay'])+$userarr[$key]['yearam']);
				//���ƽ������
				$tmpval[]=$this->salaryClass->finiView($total/count($payarr[$key]['spay']));
				$tmpval[]=$total;
				//��������
				$tmpval[]=$this->salaryClass->finiView(array_sum($payarr[$key]['bpay'])/count($payarr[$key]['bpay']));//ƽ������
				$tmpval[]=$this->salaryClass->finiView(array_sum($payarr[$key]['bpay']));//�ܻ���
				$tmpval[]=$this->salaryClass->finiView(array_sum($payarr[$key]['fpay']));//���Ƚ�
				$tmpval[]=$userarr[$key]['yearam'];//���ս�
				$tmpval[]=$this->salaryClass->finiView(array_sum($payarr[$key]['spay'])-array_sum($payarr[$key]['bpay'])-array_sum($payarr[$key]['fpay']));
				//�·�
				$tmpval[]=$payarr[$key]['bpay'][1];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][2];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][3];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][4];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][5];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][6];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][7];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][8];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][9];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][10];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][11];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][12];//һ�·�

			}
			$responce->rows[$i]['id'] = $key;
			$responce->rows[$i]['cell'] = un_iconv($tmpval);
			$i++;
		}
	}
	return $responce;
	$this->globalUtil->insertOperateLog('�������¹���', 'salary', '��ʾ������Ϣ', '�ɹ�', $sql);

}
/**
 * ����
 */
function model_hr_user_stat_xls(){
	global $func_limit;
	$seapy = $_GET['seapy']?$_GET['seapy']:$this->nowy;
	//��ҳ
	$sql = "select
		s.rand_key , s.oldname as username , d.dept_name as deptname , s.olddept , s.comedt
		, h.expflag
		, h.usercard
		, s.userid
		, s.passdt
		, y.yearam
		from salary s
		left join hrms h on( h.user_id=s.userid )
		left join user u on (u.user_id=s.userid)
		left join department d on (u.dept_id=d.dept_id)
		left join salary_yeb y on (y.usercard = h.usercard and y.syear='".$seapy."' )
		where ( s.usersta<>3  or year(s.leavedt)>=".$seapy." )
		order by s.id asc ";
	$query = $this->db->query($sql);
	$i = 0;
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
	$userarr=array();
	while ($row = $this->db->fetch_array($query)) {
		$userarr[$row['userid']]=array(
				'key'=>$row['rand_key'],'exp'=>$this->expflag[$row['expflag']]
				,'usercard'=>$row['usercard'], 'username'=>$row['username'], 'deptname'=>$row['deptname']
				,'comedt'=>$row['comedt'] , 'passdt'=>$row['passdt']
				,'yearam'=>$this->salaryClass->decryptDeal($row['yearam'])
				);
	}
	$payarr=array();
	$sql="
		select p.baseam , p.userid , h.userlevel , s.usersta , year(s.passdt) as sy , month(s.passdt) as sm
		, p.pyear as py , p.pmon as pm , p.paycesse , p.paytotal , p.floatam,p.BaseAm,p.gwam,p.jxam,p.txjt,p.gwam,p.sperewam
		from salary_pay p
		left join salary s on (p.userid=s.userid)
		left join hrms h on (h.user_id=p.userid)
		where ( s.usersta<>3  or year(s.leavedt)>=".$seapy." ) and p.pyear='".$seapy."'
		";
	$query = $this->db->query($sql);
	while ($row = $this->db->fetch_array($query)) {
		if($func_limit['����ͳ��']=='1'){
			//$payarr[$row['userid']]['spay'][$row['pm']]=$this->salaryClass->decryptDeal($row['paycesse'])+$this->salaryClass->decryptDeal($row['paytotal']);//ÿ�¹���
			$payarr[$row['userid']]['spay'][$row['pm']]=$this->salaryClass->decryptDeal($row['BaseAm'])+$this->salaryClass->decryptDeal($row['gwam'])+
				$this->salaryClass->decryptDeal($row['jxam'])+$this->salaryClass->decryptDeal($row['ProAm'])+$this->salaryClass->decryptDeal($row['txjt'])+$this->salaryClass->decryptDeal($row['sperewam']);//ÿ�¹���
			$payarr[$row['userid']]['bpay'][$row['pm']]=$this->salaryClass->decryptDeal($row['baseam']);//��������
			$payarr[$row['userid']]['fpay'][$row['pm']]=$this->salaryClass->decryptDeal($row['floatam']);//���Ƚ�
		}else{
			if($row['userlevel']=='4'){
				//$payarr[$row['userid']]['spay'][$row['pm']]=$this->salaryClass->decryptDeal($row['paycesse'])+$this->salaryClass->decryptDeal($row['paytotal']);//ÿ�¹���
				$payarr[$row['userid']]['spay'][$row['pm']]=$this->salaryClass->decryptDeal($row['BaseAm'])+$this->salaryClass->decryptDeal($row['gwam'])+
					$this->salaryClass->decryptDeal($row['jxam'])+$this->salaryClass->decryptDeal($row['ProAm'])+$this->salaryClass->decryptDeal($row['txjt'])+$this->salaryClass->decryptDeal($row['sperewam']);//ÿ�¹���
				$payarr[$row['userid']]['bpay'][$row['pm']]=$this->salaryClass->decryptDeal($row['baseam']);//��������
				$payarr[$row['userid']]['fpay'][$row['pm']]=$this->salaryClass->decryptDeal($row['floatam']);//���Ƚ�
			}else{
				$payarr[$row['userid']]['spay'][$row['pm']]=0;//ÿ�¹���
				$payarr[$row['userid']]['bpay'][$row['pm']]=0;//��������
				$payarr[$row['userid']]['fpay'][$row['pm']]=0;//���Ƚ�
				//�����ս�
				$userarr[$row['userid']]['yearam']=0;
			}
		}
	}
	$xls=new includes_class_excelout('gbk', true, '����ͳ��--'.$seapy);
	$data=array(1=>array('Ա������','Ա����','����','����','��ְ����','ת������'
				,'���ƽ������','���������','���ƽ����������','����ܻ�������'
				,'�ܼ��Ƚ�','���ս�','����'
				,'һ��(����)','����(����)','����(����)','����(����)','����(����)'
				,'����(����)','����(����)','����(����)','����(����)','ʮ��(����)','ʮһ��(����)','ʮ����(����)'));
	$xls->setStyle(array(4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27));
	if(!empty($userarr)){
		foreach($userarr as $key=>$val){
			$tmpval=array();
			$tmpval[]=$userarr[$key]['exp'];
			$tmpval[]=$userarr[$key]['usercard'];
			$tmpval[]=$userarr[$key]['username'];
			$tmpval[]=$userarr[$key]['deptname'];
			$tmpval[]=$userarr[$key]['comedt'];
			$tmpval[]=$userarr[$key]['passdt'];
			if(!empty($payarr[$key])){
				//����ܹ���
				$total=$this->salaryClass->finiView(array_sum($payarr[$key]['spay'])+$userarr[$key]['yearam']);
				//���ƽ������
				$tmpval[]=$this->salaryClass->finiView($total/count($payarr[$key]['spay']));
				$tmpval[]=$total;
				//��������
				$tmpval[]=$this->salaryClass->finiView(array_sum($payarr[$key]['bpay'])/count($payarr[$key]['bpay']));//ƽ������
				$tmpval[]=$this->salaryClass->finiView(array_sum($payarr[$key]['bpay']));//�ܻ���
				$tmpval[]=$this->salaryClass->finiView(array_sum($payarr[$key]['fpay']));//���Ƚ�
				$tmpval[]=$userarr[$key]['yearam'];//���ս�
				$tmpval[]=$this->salaryClass->finiView(array_sum($payarr[$key]['spay'])-array_sum($payarr[$key]['bpay'])-array_sum($payarr[$key]['fpay']));
				//�·�
				$tmpval[]=$payarr[$key]['bpay'][1];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][2];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][3];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][4];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][5];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][6];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][7];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][8];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][9];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][10];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][11];//һ�·�
				$tmpval[]=$payarr[$key]['bpay'][12];//һ�·�

			}
			$data[]= $tmpval;
		}
	}
	$xls->addArray($data);
	$xls->generateXML($seapy);
}
/**
 * ���ɵ���-����
 */
function model_hr_user_exp_xls(){
	$sy=$_GET['sy'];
	$sm=$_GET['sm'];
	$data=array(1=>array('����','Ա����','����','��ְ����','��ְ����'
				,'��λ����','����','�¼�'
				,'���Ƚ�','��Ŀ��'
				,'����'
				,'���⽱��','�����۳�'
				,'����'
				,'Ӧ������'
				,'�����籣','���˹�����'
				,'��˰���'
				,'��˰','ʵ������'
				,'��ҵ�籣'
				,'��ҵ������','�����'
				,'���Ϸ�'
				,'�����','�ϼƷ���'
				,'��ע'));
	$xls=new includes_class_excelout('gbk', true, '���ɹ����б�--'.$sy.'-'.$sm);
	if($sy>$this->nowy||($sy==$this->nowy&&$sm>=$this->nowm)){
		$data[]=array('����������δ���ɣ�');
	}else{
		$xls->setStyle(array(5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24));
		$baseam=array();
		$sql="select
			s.id , p.id as pid , s.userid , u.user_name as username , s.oldname
			, s.accbank as bank, s.comedt , d.dept_name , s.olddept
			, s.oldarea , s.email , p.area , p.pyear ,p.pmon , p.baseam
			, p.basenowam , p.floatam , p.proam , p.otheram , p.bonusam
			, p.perholsdays , p.sickholsdays, p.holsdelam , p.totalam
			, p.gjjam , p.shbam , p.cessebase , p.paycesse , p.paytotal
			, p.othdelam , s.acc , h.address , s.sta ,s.idcard , h.card_no
			, p.sperewam , p.cogjjam ,p.coshbam ,p.prepaream ,p.handicapam
			, p.manageam , p.sdyam , p.spedelam
			, h.usercard , s.leavedt , p.remark , p.nowamflag
			from
			salary_pay p
			left join salary s on ( s.userid=p.userid )
			left join hrms h on (s.userid=h.user_id)
			left join department d on (p.deptid=d.dept_id)
			left join user u on (s.userid=u.user_id )
			where s.userid=p.userid  and p.leaveflag='0' and p.expflag='1'
			and p.pmon='".$sm."' and p.pyear='".$sy."'
			$sqlStr
			group by p.id
			order by s.id";
		$query=$this->db->query($sql);
		while($row=$this->db->fetch_array($query)){
			$total=$this->salaryClass->decryptDeal($row["totalam"]);
			$shb=$this->salaryClass->decryptDeal($row["shbam"]);
			$gjj=$this->salaryClass->decryptDeal($row["gjjam"]);
			if(round($total,2)<round($shb+$gjj,2)){
				$total=round($shb+$gjj,2);
			}
			$paytotal=$this->salaryClass->decryptDeal($row["paytotal"]);
			$coshb=$this->salaryClass->decryptDeal($row["coshbam"]);
			$cogjj=$this->salaryClass->decryptDeal($row["cogjjam"]);
			$pre=$this->salaryClass->decryptDeal($row["prepaream"]);
			$han=$this->salaryClass->decryptDeal($row["handicapam"]);
			$man=$this->salaryClass->decryptDeal($row["manageam"]);
			if($row['nowamflag']=='3'){
				$res['Z'][]=array(
						$row['dept_name'],$row['usercard'],$row['oldname'],$row['comedt'],$row['leavedt']
						,$shb,$gjj
						,$coshb,$cogjj
						,$pre,$han
						,$man,$this->salaryClass->cfv($shb+$gjj+$coshb+$cogjj+$pre+$han+$man)
						,$row["remark"]
						);
			}else{
				$res['L'][]=array(
						$row['dept_name'],$row['usercard'],$row['oldname'],$row['comedt'],$row['leavedt']
						,$this->salaryClass->decryptDeal($row["baseam"]),$row['sickholsdays'],$row['perholsdays']
						,$this->salaryClass->decryptDeal($row["floatam"]),$this->salaryClass->decryptDeal($row["proam"])
						,$this->salaryClass->decryptDeal($row["sdyam"])+$this->salaryClass->decryptDeal($row["otheram"])
						,$this->salaryClass->decryptDeal($row["sperewam"])
						,$this->salaryClass->decryptDeal($row["othdelam"])+$this->salaryClass->decryptDeal($row["spedelam"])
						,$this->salaryClass->decryptDeal($row['bonusam'])
						,$total
						,$shb,$gjj
						,$this->salaryClass->cfv($total-$shb-$gjj)
						,$this->salaryClass->decryptDeal($row["paycesse"]),$paytotal
						,$coshb,$cogjj
						,$pre,$han
						,$man,$this->salaryClass->cfv($total+$coshb+$cogjj+$pre+$han+$man)
						,$row["remark"]
						);
			}
		}
	}
	if(!empty($res['L'])){
		foreach($res['L'] as $val){
			$data[]=$val;
		}
	}
	if(!empty($res['Z'])){
		$data[]=array();
		$data[]=array('����','Ա����','����','��ְ����','��ְ����'
				,'�����籣','���˹�����'
				,'��ҵ�籣'
				,'��ҵ������','�����'
				,'���Ϸ�'
				,'�����','�ϼƷ���'
				,'��ע');
		foreach($res['Z'] as $val){
			$data[]=$val;
		}
	}
	$xls->addArray($data);
	$xls->generateXML($sy.'-'.$sm);
}
/**
 * ���̲�����-����
 */
function model_hr_user_wy_xls(){
	$sy=$_GET['sy'];
	$sm=$_GET['sm'];
	$data=array(1=>array('����','Ա����','����','��ְ����','��ְ����'
				,'��λ����','����','�¼�'
				,'���Ƚ�','��Ŀ��'
				,'����'
				,'���⽱��','�����۳�'
				,'����'
				,'Ӧ������'
				,'�����籣','���˹�����'
				,'��˰���'
				,'��˰','ʵ������'
				,'��ҵ�籣'
				,'��ҵ������','�����'
				,'���Ϸ�'
				,'�����','�ϼƷ���'
				,'��ע'));
	$xls=new includes_class_excelout('gbk', true, '���̹����б�--'.$sy.'-'.$sm);
	$xls->setStyle(array(5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24));
	$baseam=array();
	$sql="select
		s.id , p.id as pid , s.userid , u.user_name as username , s.oldname
		, s.accbank as bank, s.comedt , d.dept_name , s.olddept
		, s.oldarea , s.email , p.area , p.pyear ,p.pmon , p.baseam
		, p.basenowam , p.floatam , p.proam , p.otheram , p.bonusam
		, p.perholsdays , p.sickholsdays, p.holsdelam , p.totalam
		, p.gjjam , p.shbam , p.cessebase , p.paycesse , p.paytotal
		, p.othdelam , s.acc , h.address , s.sta ,s.idcard , h.card_no
		, p.sperewam , p.cogjjam ,p.coshbam ,p.prepaream ,p.handicapam
		, p.manageam , p.sdyam , p.spedelam
		, h.usercard , s.leavedt , p.remark
		from
		salary_pay p
		left join salary s on ( s.userid=p.userid )
		left join hrms h on (s.userid=h.user_id)
		left join department d on (p.deptid=d.dept_id)
		left join user u on (s.userid=u.user_id )
		where s.userid=p.userid  and p.leaveflag='0'
		and ( ( p.deptid in ( 90,91,94,35,34 ) and p.pmon> 5 ) or ( p.deptid in ( 35 ) and p.pmon<=5 ) )
		and p.pmon='".$sm."' and p.pyear='".$sy."'
		$sqlStr
		group by p.id
		order by p.deptid , s.id";
	$query=$this->db->query($sql);
	while($row=$this->db->fetch_array($query)){
		$total=$this->salaryClass->decryptDeal($row["totalam"]);
		$shb=$this->salaryClass->decryptDeal($row["shbam"]);
		$gjj=$this->salaryClass->decryptDeal($row["gjjam"]);
		if(round($total,2)<round($shb+$gjj,2)){
			$total=round($shb+$gjj,2);
		}
		$paytotal=$this->salaryClass->decryptDeal($row["paytotal"]);
		$coshb=$this->salaryClass->decryptDeal($row["coshbam"]);
		$cogjj=$this->salaryClass->decryptDeal($row["cogjjam"]);
		$pre=$this->salaryClass->decryptDeal($row["prepaream"]);
		$han=$this->salaryClass->decryptDeal($row["handicapam"]);
		$man=$this->salaryClass->decryptDeal($row["manageam"]);
		$data[]=array(
				$row['dept_name'],$row['usercard'],$row['oldname'],$row['comedt'],$row['leavedt']
				,$this->salaryClass->decryptDeal($row["baseam"]),$row['sickholsdays'],$row['perholsdays']
				,$this->salaryClass->decryptDeal($row["floatam"]),$this->salaryClass->decryptDeal($row["proam"])
				,$this->salaryClass->decryptDeal($row["sdyam"])+$this->salaryClass->decryptDeal($row["otheram"])
				,$this->salaryClass->decryptDeal($row["sperewam"])
				,$this->salaryClass->decryptDeal($row["othdelam"])+$this->salaryClass->decryptDeal($row["spedelam"])
				,$this->salaryClass->decryptDeal($row['bonusam'])
				,$total
				,$shb,$gjj
				,$this->salaryClass->cfv($total-$shb-$gjj)
				,$this->salaryClass->decryptDeal($row["paycesse"]),$paytotal
				,$coshb,$cogjj
				,$pre,$han
				,$man,$this->salaryClass->cfv($total+$coshb+$cogjj+$pre+$han+$man)
				,$row["remark"]
			     );
	}

	//var_dump($data);
	$xls->addArray($data);
	$xls->generateXML($sy.'-'.$sm);
}
/**
 * ���ɵ�������
 */
function model_hr_user_exp_xls_f(){
	$sy=$_GET['sy'];
	$sm=$_GET['sm'];
	$data=array(1=>array('����','Ա��','Ա����','Ա��״̬','��н����','������ְ/ת������','���Ƚ�','��Ŀ��','�Ͳ�','��������','����','��ٿ۳�','�¼�'
				,'����','�����۳�','����','�۳�'));
	$xls=new includes_class_excelout('gb2312', true, 'My Test Sheet');
	$baseam=array();
	/*
	   $sql="select
	   f.userid , f.changeam
	   from salary_flow f
	   left join hrms h on (f.userid=h.user_id)
	   where
	   f.sta='2' and f.flowname like '%��н%'
	   and f.pyear='".$sy."' and f.pmon='".$sm."'
	   and h.expflag='1' ";
	   $query=$this->db->query($sql);
	   while($row=$this->db->fetch_array($query)){
	   $baseam[$row['userid']]=$this->salaryClass->decryptDeal($row['changeam']);
	   }
	 *
	 */
	$sql="select
		u.user_name , d.dept_name , s.usersta , s.userid , h.usercard
		, p.baseam , p.basenowam
		, p.floatam , p.proam , p.sdyam , p.otheram
		, p.bonusam , p.holsdelam , p.perholsdays , p.sickholsdays
		, p.othdelam , p.sperewam , p.spedelam
		from
		salary s
		left join salary_pay p on (s.userid=p.userid)
		left join user u on (s.userid=u.user_id)
		left join hrms h on (u.user_id=h.user_id)
		left join department d on (u.dept_id=d.dept_id)
		where
		p.expflag='1' and p.pyear='".$sy."'
		and p.pmon='".$sm."'
		and (s.leavedt is null or ( year(s.leavedt)='".$sy."' and month(s.leavedt)='".$sm."' ) )
		";
	$query=$this->db->query($sql);
	while($row=$this->db->fetch_array($query)){
		$baseam=$this->salaryClass->decryptDeal($row['baseam']);
		$basenowam=$this->salaryClass->decryptDeal($row['basenowam']);
		$data[]=array(
				$row['dept_name'], $row['user_name'], $row['usercard'] ,$this->userSta[$row['usersta']]
				, $baseam ,$basenowam , $this->salaryClass->decryptDeal($row['floatam']),$this->salaryClass->decryptDeal($row['proam'])
				, $this->salaryClass->decryptDeal($row['sdyam']) , $this->salaryClass->decryptDeal($row['otheram'])
				, $this->salaryClass->decryptDeal($row['bonusam']) , $this->salaryClass->decryptDeal($row['holsdelam'])
				, $row['perholsdays'] , $row['sickholsdays']
				, $this->salaryClass->decryptDeal($row['othdelam']) , $this->salaryClass->decryptDeal($row['sperewam'])
				, $this->salaryClass->decryptDeal($row['spedelam'])
			     );
	}
	//var_dump($data);
	$xls->addArray($data);
	$xls->generateXML(time());
}
/**
 * �������ݼ��Ͻ�
 */
function model_hr_hols_hd(){
	try {
		$info=array();
		$this->db->query("START TRANSACTION");
		$sql="select count(*) as mc from hols_sta s where s.syear='".$this->nowy."' and s.smon='".$this->nowm."'
			and checkflag<>'1' ";
		$res=$this->db->get_one($sql);
		if(empty($res['mc'])){
			throw new Exception('Data has been turned over to');
		}
		$sql="update
			hols_sta s ,
				 (select userid , type as sty , sum(realdays)  as sds  from hols_sta where syear='".$this->nowy."'
				  and smon='".$this->nowm."' group by userid , type ) sta
					 set s.saldays=sta.sds
					 where s.userid=sta.userid and s.type=sta.sty and s.syear='".$this->nowy."' and s.smon='".$this->nowm."'
					 and checkflag<>'1' ";
		$this->db->query_exc($sql);
		$sql="select
			p.id , h.type , h.saldays , u.company , u.salarycom , h.userid
			from hols_sta h
			left join salary_pay p on (h.userid=p.userid and p.pyear='".$this->nowy."' and p.pmon='".$this->nowm."')
			left join user u on (h.userid=u.user_id)
			where h.syear='".$this->nowy."' and h.smon='".$this->nowm."' and checkflag<>'1'
			group by h.userid , h.type ";
		$query=$this->db->query_exc($sql);
		while($row=$this->db->fetch_array($query)){
			$info[$row['userid']][$row['type']]=$row['saldays'];
			$info[$row['userid']]['pid']=$row['id'];
			$info[$row['userid']]['com']=$row['company'];
			if(!empty($row['salarycom'])&&$row['salarycom']!=''){
				$info[$row['userid']]['com']=$row['salarycom'];
			}
		}
		if(count($info)){
			foreach($info as $key=>$val){
				if($key){
					$comtable=$this->get_com_sql($val['com']);
					if(empty($val['pid'])){
						$sql="select p.id as pid
							from salary_pay p
							where  p.pyear='" . $this->nowy . "' and p.pmon='" . $this->nowm . "' and p.userid='".$key."' ";
						$rescom=$this->db->get_one($sql);
						$val['pid']=$rescom['pid'];
					}
					if(empty($val['pid'])){
						continue;
					}
					$ph=empty ($val['�¼�'])?'0':$val['�¼�'];
					$sh=empty ($val['����'])?'0':$val['����'];
					$this->model_pay_update($val['pid'],
							array('perholsdays'=>$ph ,'sickholsdays'=>$sh)
							, array(0,1));
					$this->model_pay_stat($val['pid']);
				}
			}
		}
		$sql="update
			hols_sta s
			set s.checkflag='1'
			where  s.syear='".$this->nowy."' and s.smon='".$this->nowm."' and s.checkflag<>'1' ";
		$this->db->query_exc($sql);
		$this->db->query("COMMIT");
		$this->globalUtil->insertOperateLog('���ʹ���', 'salary', '���ݼ��Ͻ�', '�ɹ�', $sql);
	} catch (Exception $e) {
		$this->db->query("ROLLBACK");
		$this->globalUtil->insertOperateLog('���ʹ���', 'salary', '���ݼ��Ͻ�', 'ʧ��', $sql);
		echo $sql;
	}
}
/**
 * Ա����ӦȨ��
 */
function model_dp_pow(){
	$dppow=array('1'=>array(),'2'=>array());
	$sql="select majorid , vicemanager , dept_id
		from department d
		where
		( find_in_set('".$_SESSION['USER_ID']."',d.majorid)>0
		  or find_in_set('".$_SESSION['USER_ID']."',d.vicemanager)
		) ";
	$query=$this->db->query($sql);
	while($row=$this->db->fetch_array($query)){
		if(trim($row['majorid'])){
			if(strpos($row['majorid'], strtolower($_SESSION['USER_ID']))===false){
				$dppow['2'][]=$row['dept_id'];
			}else{
				$dppow['1'][]=$row['dept_id'];
			}
		}else{
			$dppow['1'][]=$row['dept_id'];
		}
	}
	if($_SESSION['USER_PRIV']==88){
		$sql="select majorid , vicemanager , dept_id from department d ";
		$query=$this->db->query($sql);
		while($row=$this->db->fetch_array($query)){
			if(trim($row['majorid'])||trim($row['vicemanager'])){
				$dppow['2'][]=$row['dept_id'];
			}else{
				$dppow['1'][]=$row['dept_id'];
			}
		}
	}
	return $dppow;
}
/**
 *ְλֱ���ƿض�Ӧ����
 * @return <type>
 */
function model_dp_ctr_pow(){
	$dppow=array('1'=>array(),'2'=>array(),'3'=>array());
	$sql="select majorid , vicemanager , dept_id
		from department d
		where
		( find_in_set('".$_SESSION['USER_ID']."',d.majorid)>0
		  or find_in_set('".$_SESSION['USER_ID']."',d.vicemanager )
		  or d.vicemanager=''
		) ";
	$query=$this->db->query($sql);
	while($row=$this->db->fetch_array($query)){
		if(strpos($row['majorid'], strtolower($_SESSION['USER_ID']))!==false){
			$dppow['3'][]=$row['dept_id'];
		}elseif(!$row['majorid']){
			if(strpos($row['vicemanager'], strtolower($_SESSION['USER_ID']))!==false){
				$dppow['3'][]=$row['dept_id'];
			}elseif(!$row['vicemanager']){
				if($_SESSION['USER_PRIV']==88){
					$dppow['3'][]=$row['dept_id'];
				}
			}
		}
		if(strpos($row['vicemanager'], strtolower($_SESSION['USER_ID']))!==false){
			$dppow['2'][]=$row['dept_id'];
		}elseif(!$row['vicemanager']){
			if($_SESSION['USER_PRIV']==88){
				$dppow['2'][]=$row['dept_id'];
			}
		}
	}
	if($_SESSION['USER_PRIV']==88){
		$sql="select majorid , vicemanager , dept_id from department d ";
		$query=$this->db->query($sql);
		while($row=$this->db->fetch_array($query)){
			$dppow['1'][]=$row['dept_id'];
		}
	}
	return $dppow;
}
function model_dp_sql_pow($dppow){
	$res='';
	if(is_array($dppow)){
		if(!empty($dppow['1'])){
			$res.=" ( h.userlevel in (0,1) and s.deptid in (".implode(',', $dppow['1']).") ) ";
		}
		if(!empty($dppow['2'])){
			if($res){
				$res.=" or ( h.userlevel=2 and s.deptid in (".implode(',', $dppow['2']).") ) ";
			}else{
				$res.=" ( h.userlevel=2 and s.deptid in (".implode(',', $dppow['2']).") ) ";
			}
		}
		if(!empty($dppow['3'])){
			if($res){
				$res.=" or ( h.userlevel=3 and s.deptid in (".implode(',', $dppow['3']).") ) ";
			}else{
				$res.=" ( h.userlevel=3 and s.deptid in (".implode(',', $dppow['3']).") ) ";
			}
		}
		if($res){
			$res=" and ( ".$res." )";
		}
	}
	if(empty($res)){
		$res=" and 1!=1 ";
	}
	return $res;
}
/**
 *���ʰ���
 * @return string
 */
function model_dp_exa(){
	global $func_limit;
	$str='<table align="left" style="text-align: left;width: 100%;" >
		<tr>
		<td id="hr_user_pass_name" style="line-height: 20px;padding-left: 5px;" class="ui-widget-header ui-corner-all">
		��������
		</td>
		</tr>
		<tr>
		<td><div class="divlist">';
	$dppow=$this->model_dp_ctr_pow();
	$sql="select count(*) , usersta
		from
		salary s
		left join user u on (s.userid=u.user_id)
		left join hrms h on (u.user_id=h.user_id)
		where
		(s.usersta='0' or (s.usersta='1' and passdt!='' ))
		".$this->model_dp_sql_pow($dppow)."
		group by s.usersta ";
	$query=$this->db->query($sql);
	$res=array('0'=>0,'1'=>0);
	while($row=$this->db->fetch_array($query)){
		$res[$row['usersta']]=$row['count(*)'];
	}
	$str.='<div class="nbtn">
		<input type="button" value="Ա����ְ" class="btn" onclick="newParentTab(\'?model=salary&action=dp_join\', \'Ա����ְ\',\'1\')" />
		<div style="text-align: center"><font color="red">'.$res['0'].'</font></div>
		</div>';
	$str.='<div class="nbtn">
		<input type="button" value="Ա��ת��" class="btn" onclick="newParentTab(\'?model=salary&action=dp_pass\', \'Ա��ת��\',\'2\')" />
		<div style="text-align: center"><font color="red">'.$res['1'].'</font></div>
		</div>';
	$holspow=$this->model_dp_pow();
	if(!empty($holspow['1'])){
		$sql="select count(id) as mck from hols_sta where syear='".$this->nowy."' and smon='".$this->nowm."'
			and deptid in ('".implode("','", $holspow['1'])."') and checkflag in (1,2) ";
		$res=$this->db->get_one($sql);
		$str.='<div class="nbtn">
			<input type="button" value="���ݼ�" class="btn" onclick="newParentTab(\'?model=exet_attendance&action=deptsta\', \'���ݼ�\',\'3\')" />
			<div style="text-align: center"><font color="red">'.$res['mck'].'</font></div>
			</div>';
	}
	$sql="select count(fs.id) as ids , f.flowname from salary_flow_step fs
		left join salary_flow f on (fs.salaryfid=f.id)
		where find_in_set('".$_SESSION['USER_ID']."', fs.dealuser)>0 and  fs.sta='0' group by f.flowname ";
	$query=$this->db->query($sql);
	while($row=$this->db->fetch_array($query)){
		$resck[$row['flowname']]=$row['ids'];
	}
	$resck['����ȵ�н']=$resck['����ȵ�н-��ͨ']+$resck['����ȵ�н-����']+$resck['����ȵ�н-�ܼ�']+$resck['����ȵ�н-����']+$resck['��ȵ�н'];
	$resck['��������']=$resck['��������']+$resck['��������-��ͨ']+$resck['��������-�ܼ�']+$resck['��������-����']+$resck['��������-�ܲ�'];
	$resck['����ȵ�н']=$resck['����ȵ�н']?$resck['����ȵ�н']:0;
	$resck['��Ŀ��']=$resck['��Ŀ��']+$resck['��Ŀ��-��ͨ']+$resck['��Ŀ��-�ܼ�']+$resck['��Ŀ��-����']+$resck['��Ŀ��-�ܲ�'];
	$resck['���ʽ���']=$resck['���ʽ���']?$resck['���ʽ���']:0;
	$resck['���Ƚ�']=$resck['���Ƚ�']?$resck['���Ƚ�']:0;
	$resck['���²���']=$resck['���²���']+$resck['���²���-��ͨ']+$resck['���²���-�ܼ�']+$resck['���²���-����']+$resck['���²���-�ܲ�'];
	$resck['��Ŀ����ϸ']=$resck['��Ŀ����ϸ']?$resck['��Ŀ����ϸ']:0;
	$str.='<div class="nbtn">
		<input type="button" value="����/�۳�" class="btn" onclick="newParentTab(\'?model=salary&action=dp_sal_exa_spe\', \'����/�۳�����\',\'41\')" />
		<div style="text-align: center"><font color="red">'.$resck['��������'].'</font></div>
		</div>';
	$str.='<div class="nbtn">
		<input type="button" value="���ʵ�н" class="btn" onclick="newParentTab(\'?model=salary&action=dp_sal_exa_nym\', \'���ʵ�н\',\'42\')" />
		<div style="text-align: center"><font color="red">'.$resck['����ȵ�н'].'</font></div>
		</div>';
	$str.='<div class="nbtn">
		<input type="button" value="���Ƚ�" class="btn" onclick="newParentTab(\'?model=salary&action=dp_sal_exa_fla\', \'���Ƚ�\',\'46\')" />
		<div style="text-align: center"><font color="red">'.$resck['���Ƚ�'].'</font></div>
		</div>';
	$str.='<div class="nbtn">
		<input type="button" value="��Ŀ��" class="btn" onclick="newParentTab(\'?model=salary&action=dp_sal_exa_pro\', \'��Ŀ��\',\'43\')" />
		<div style="text-align: center"><font color="red">'.$resck['��Ŀ��'].'</font></div>
		</div>';
	$str.='<div class="nbtn">
		<input type="button" value="����" class="btn" onclick="newParentTab(\'?model=salary&action=dp_sal_exa_bos\', \'����\',\'44\')" />
		<div style="text-align: center"><font color="red">'.$resck['���ʽ���'].'</font></div>
		</div>';
	$str.='<div class="nbtn">
		<input type="button" value="���²���" class="btn" onclick="newParentTab(\'?model=salary&action=dp_sal_exa_sdy\', \'���²���\',\'45\')" />
		<div style="text-align: center"><font color="red">'.$resck['���²���'].'</font></div>
		</div>';
	$str.='<div class="nbtn">
		<input type="button" value="������Ŀ����ϸ" class="btn" onclick="newParentTab(\'?model=salary&action=dp_sal_exa_prod\', \'��Ŀ����ϸ\',\'456\')" />
		<div style="text-align: center"><font color="red">'.$resck['��Ŀ����ϸ'].'</font></div>
		</div>';
	$str.='         </div>
		</td>
		</tr>';
	$str.='<tr>
		<td id="hr_user_pass_name" style="line-height: 20px;padding-left: 5px;" class="ui-widget-header ui-corner-all">
		��������
		</td>
		</tr>
		<tr>
		<td><div class="divlist">';
	$str.='<div class="nbtn">
		<input type="button" value="���ʵ�н" class="btn" onclick="newParentTab(\'?model=salary&action=dp_mdf\', \'���ʵ�н\',\'6\')" />
		</div>';
	//        $str.='<div class="nbtn">
	//                    <input type="button" value="���Ƚ�" class="btn" onclick="newParentTab(\'?model=salary&action=dp_fla\', \'���Ƚ�\',\'7\')" />
	//                </div>';
	$str.='<div class="nbtn">
		<input type="button" value="��Ŀ��" class="btn" onclick="newParentTab(\'?model=salary&action=dp_pro\', \'��Ŀ��\',\'8\')" />
		</div>';
	//        $str.='<div class="nbtn">
	//                    <input type="button" value="����" class="btn" onclick="newParentTab(\'?model=salary&action=dp_bos\', \'����\',\'9\')" />
	//                </div>';
	//        $str.='<div class="nbtn">
	//                    <input type="button" value="����" class="btn" onclick="newParentTab(\'?model=salary&action=dp_sdy\', \'����\',\'10\')" />
	//                </div>';
	if($func_limit['���ս�']=='1'){
		$str.='<div class="nbtn">
			<input type="button" value="���ս�����" class="btn" onclick="newParentTab(\'?model=salary&action=dp_yeb\', \'���ս�����\',\'11\')" />
			</div>';
	}
	if($func_limit['��ȵ�н']=='1'){
		$str.='<div class="nbtn">
			<input type="button" value="��ȵ�н" class="btn" onclick="newParentTab(\'?model=salary&action=dp_ymd\', \'��ȵ�н\',\'12\')" />
			</div>';
	}
	$str.='         </div>
		</td>
		</tr>';
	if(in_array($_SESSION['USER_ID'], $this->fnStatU)){
		$str.='<tr>
			<td id="hr_user_pass_name" style="line-height: 20px;padding-left: 5px;" class="ui-widget-header ui-corner-all">
			�������
			</td>
			</tr>
			<tr>
			<td><div class="divlist">';
		$str.='<div class="nbtn">
			<input type="button" value="��������" class="btn" onclick="newParentTab(\'?model=salary&action=close_stat\', \'��������\',\'505\')" />
			</div>';
		$str.='<div class="nbtn">
			<input type="button" value="�������" class="btn" onclick="newParentTab(\'?model=salary&action=fn_stat\', \'�������\',\'5\')" />
			</div>';
		$str.='<div class="nbtn">
			<input type="button" value="Ա����Ϣ����" class="btn" onclick="newParentTab(\'?model=salary&action=fn_user_info\', \'Ա����Ϣ����\',\'51\')" />
			</div>';
		$str.='<div class="nbtn">
			<input type="button" value="���ս�" class="btn" onclick="newParentTab(\'?model=salary&action=fn_yeb\', \'���ս�\',\'52\')" />
			</div>';
		if($func_limit['��Կ����']=='1'){
			$str.='<div class="nbtn">
				<input type="button" value="�������" class="btn"
				onclick="newParentTab(\'./general/salary/index.php?lpw=pwi&scl=index\', \'�������\',\'53\')" />
				</div>';
		}
		$str.='         </div>
			</td>
			</tr>';
	}
	if($func_limit['Ա������']=='1'||$func_limit['����㹤��']=='1'){
		$str.='<tr>
			<td id="hr_user_pass_name" style="line-height: 20px;padding-left: 5px;" class="ui-widget-header ui-corner-all">
			Ա����Ϣ
			</td>
			</tr>
			<tr>
			<td><div class="divlist">';
		if($func_limit['Ա������']=='1'){
			$str.='<div class="nbtn">
				<input type="button" value="��Ŀ����" class="btn" onclick="newParentTab(\'?model=salary&action=dp_user_type&flag=pro\', \'��Ŀ����\',\'11\')" />
				</div>';
		}
		if($func_limit['����㹤��']=='1'){
			$str.='<div class="nbtn">
				<input type="button" value="����㹤��" class="btn" onclick="location.href=\'?model=salary&action=hr_xls_out&flag=manager\'" />
				</div>';
		}
		$str.='         </div>
			</td>
			</tr>';
	}
	if($func_limit['���Ƚ�ͳ��']=='1'||$func_limit['���ɹ���']=='1'||$func_limit['���̹���']=='1'||$func_limit['���Ź���']=='1'||$func_limit['���ŷ�����']=='1'){
		$str.='<tr>
			<td id="hr_user_pass_name" style="line-height: 20px;padding-left: 5px;" class="ui-widget-header ui-corner-all">
			����ͳ��
			</td>
			</tr>
			<tr>
			<td><div class="divlist">';
		if($func_limit['���Ƚ�ͳ��']=='1'){
			$str.='<div class="nbtn">
				<input type="button" value="���Ƚ�ͳ��" class="btn" onclick="location.href=\'?model=salary&action=dp_stat_float\'" />
				</div>';
		}
		if($func_limit['���ɹ���']=='1'){
			$str.='<div class="nbtn">
				<input type="button" value="���ɹ���" class="btn" onclick="expClick(\'?model=salary&action=hr_user_exp_xls\')" />
				</div>';
		}
		if($func_limit['���̹���']=='1'){
			$str.='<div class="nbtn">
				<input type="button" value="���̹���" class="btn" onclick="expClick(\'?model=salary&action=hr_user_wy_xls\')" />
				</div>';
		}
		if($func_limit['���Ź���']=='1'){
			//                $str.='<div class="nbtn">
			//                    <input type="button" value="���Ź���" class="btn" onclick="expClick(\'?model=salary&action=fn_xls&ty=4\')" />
			//                </div>';
			$str.='<div class="nbtn">
				<input type="button" value="���Ź���"" class="btn" onclick="expClick(\'?model=salary&action=xls_out&flag=dp_tol\')" />
				</div>';
		}
		if($func_limit['���Ź���']=='1'){
			$str.='<div class="nbtn">
				<input type="button" value="��Ŀ����" class="btn" onclick="expClick(\'?model=salary&action=xls_out&flag=fn_pro\')" />
				</div>';
		}
		if($func_limit['���ŷ�����']=='1'){
			$str.='<div class="nbtn">
				<input type="button" value="���ŷ�����" class="btn" onclick="expClick(\'?model=salary&action=xls_out&flag=gs_tol\')" />
				</div>';
		}
		$str.='         </div>
			</td>
			</tr>';
	}
	$str.='</table>';
	return $str;
}
/**
 * ����ͳ�Ƽ��Ƚ�
 */
function model_dp_stat_float(){
	global $func_limit;
	if($func_limit['���Ƚ�ͳ��']=='1'){
		$xls=new includes_class_excelout('gb2312', true, 'My Test Sheet');
		$data = array(1=> array ('����', 'һ��', '����', '����', '����'
					, '����', '����', '����', '����', '����', 'ʮ��'
					,'ʮһ��','ʮ����'));
		$xls->setStyle(array(1,2,3,4,5,6,7,8,9,10,11,12,13));
		$info=array();
		$sql="select
			s.id , p.id as pid , s.userid , u.user_name as username , s.oldname
			, s.accbank as bank, s.comedt , d.dept_name , s.olddept
			, s.oldarea , s.email , p.area , p.pyear ,p.pmon , p.baseam
			, p.basenowam , p.floatam , p.proam , p.otheram , p.bonusam
			, p.perholsdays , p.sickholsdays, p.holsdelam , p.totalam
			,  p.gjjam , p.shbam , p.cessebase , p.paycesse , p.paytotal
			, p.othdelam , s.acc , h.address , s.sta ,s.idcard , h.card_no
			, p.sperewam , p.cogjjam ,p.coshbam ,p.prepaream ,p.handicapam
			, p.manageam , p.sdyam , p.spedelam
			from
			salary_pay p
			left join salary s on ( s.userid=p.userid )
			left join hrms h on (s.userid=h.user_id)
			left join department d on (s.deptid=d.dept_id)
			left join user u on (s.userid=u.user_id )
			where s.userid=p.userid  and p.leaveflag='0'
			and p.pyear='".date('Y')."' group by p.id order by s.id";
		$query=$this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			if($row['pmon'] < $this->nowm || date('Y')!=$this->nowy){
				$info[$row['olddept']][$row['pmon']]=isset($info[$row['olddept']][$row['pmon']])?round($info[$row['olddept']][$row['pmon']]+$this->salaryClass->decryptDeal($row['floatam']),2):$this->salaryClass->decryptDeal($row['floatam']);

			}
		}
		foreach($info as $key=>$val){
			$data[]=array(
					$key,$val['1'],$val['2'],$val['3'],$val['4'],$val['5']
					,$val['6'],$val['7'],$val['8'],$val['9'],$val['10']
					,$val['11'],$val['12']
				     );
		}
		$xls->addArray($data);
		$xls->generateXML('salary');
	}
}
/**
 *������ְ
 * @return <type>
 */
function model_dp_join_list(){
	global $func_limit;
	$dppow=$this->model_dp_ctr_pow();
	$sqlflag=$this->model_dp_sql_pow($dppow);
	if($func_limit['��ְ����']=='1'){
		return $this->model_hr_join_list(false,'');
	}else{
		return $this->model_hr_join_list(false,$sqlflag);
	}
}
/**
 *������֤ת��
 * @return <type>
 */
function model_dp_pass_list(){
	$dppow=$this->model_dp_ctr_pow();
	$sqlflag=$this->model_dp_sql_pow($dppow);
	//$sqlflag.=" and passdt!='' ";
	return $this->model_hr_pass_list(false,$sqlflag);
}
/**
 * �������ݼ��Ͻ�
 */
function model_dp_hols_hd(){
	$id=$_POST['id'];
	$uid=$_POST['uid'];
	$pud=$_POST['pub'];
	try {
		$this->db->query("START TRANSACTION");
		$sql="select
			s.type , p.id , s.userid , u.company , u.salarycom
			from
			hols_sta s
			left join user u on (s.userid=u.user_id)
			left join salary_pay p on (s.userid=p.userid and p.pyear=s.syear and p.pmon=s.smon )
			where
			s.userid='".  str_replace('_', '.', $uid)."' and s.id='".$id."'
			and s.syear='".$this->nowy."' and s.smon='".$this->nowm."' ";
		$res=$this->db->get_one($sql);
		$res['com']=$res['company'];
		if(!empty($res['salarycom'])){
			$res['com']=$res['salarycom'];
		}
		if(empty($res['id'])){
			$comtable=$this->get_com_sql($res['com']);
			$sql="select p.id as pid
				from salary_pay p
				where  p.pyear='" . $this->nowy . "' and p.pmon='" . $this->nowm . "' and p.userid='".$res['userid']."' ";
			$rescom=$this->db->get_one($sql);
			$res['id']=$rescom['pid'];
		}
		if(!$res['type']||!$res['id']){
			throw new Exception('Data Query failed');
		}

		$sql="update
			hols_sta
			set saldays='".$pud."'
			where
			type='".$res['type']."'
			and syear='".$this->nowy."' and smon='".$this->nowm."'
			and userid='".$res['userid']."' ";
		$this->db->query_exc($sql);
		if($res['type']=='�¼�'){
			$this->model_pay_update($res['id'],
					array('perholsdays'=>$pud)
					, array(0));
			$this->model_pay_stat($res['id']);
		}elseif($res['type']=='����'){
			$this->model_pay_update($res['id'],
					array('sickholsdays'=>$pud)
					, array(0));
			$this->model_pay_stat($res['id']);
		}
		$this->db->query("COMMIT");
		$this->globalUtil->insertOperateLog('���ʹ���', 'salary', '���ݼ��޸�', '�ɹ�', $sql);
	} catch (Exception $e) {
		$this->db->query("ROLLBACK");
		$this->globalUtil->insertOperateLog('���ʹ���', 'salary', '���ݼ��޸�', 'ʧ��', $e->getMessage());
		echo $e->getMessage();
	}
}
/**
 *�����б�
 */
function model_dp_sal_exa_list($flag=true,$sqlflag='',$sf=''){
	$page = $_GET['page'];
	$limit = $_GET['rows'];
	$sidx = $_GET['sidx'];
	$sord = $_GET['sord'];
	$schOper = $_GET['searchOper'];
	$schStr = $_GET['searchString'];
	$schField = $_GET['searchField'];
	$sqlSch = '';
	if ($schOper) {
		$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
	}
	if($flag==false){
		$sqlSch.=$sqlflag;
	}
	$start = $limit * $page - $limit;
	//����
	$sql = "select count(*)
		from salary_flow_step fs
		left join salary_flow f on (fs.salaryfid=f.id)
		left join salary s on (f.userid=s.userid)
		where
		find_in_set('".$_SESSION['USER_ID']."',fs.dealuser)
		and fs.sta!=''
		$sqlSch ";
	$rs = $this->db->get_one($sql);
	$count = $rs['count(*)'];
	if ($count > 0) {
		$total_pages = ceil($count / $limit);
	} else {
		$total_pages = 0;
	}
	if ($page > $total_pages){
		$page = $total_pages;
	}
	$i = 0;
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
	$sql="select
		fs.rand_key , f.id , u1.user_name as username , d.dept_name as olddept , f.flowname , f.changeam , f.userid
		, f.pyear , f.pmon , fs.item , f.sta , u.user_name , f.createdt , fs.sta as fssta , sp.paytype as spetype
		, fs.res as fsres , fs.dealdt
		, f.remark , f.remark_rea , f.changedt
		, f.gwam , f.jxam
		, f.oldam , f.oldgwam , f.oldjxam 
		, f.jjam , f.gljtam , f.lszsam
		, f.txjt , f.qtjtam , f.expenCeiling
		, f.oldjjam , f.oldgljtam , f.oldlszsam
		, f.oldtxjt , f.oldqtjtam , f.oldexpenCeiling
		from salary_flow_step fs
		left join salary_flow f on ( fs.salaryfid=f.id )
		left join salary s on (f.userid=s.userid)
		left join user u on (f.createuser=u.user_id)
		left join salary_spe sp on (f.flowname in ('".$this->flowName['spe']."','".$this->flowName['spe_3']."','".$this->flowName['spe_5']."','".$this->flowName['spe_1']."','".$this->flowName['spe_0']."'
					,'".$this->flowName['spe_xs_3']."','".$this->flowName['spe_xs_5']."','".$this->flowName['spe_xs_1']."','".$this->flowName['spe_xs_0']."','".$this->flowName['spe_xs_12']."') and f.salarykey=sp.rand_key)
		left join user u1 on (u1.user_id=f.userid)
		left join department d on (u1.dept_id=d.dept_id)
		where
		(find_in_set('".$_SESSION['USER_ID']."',fs.dealuser)or '".$_SESSION['USER_ID']."' in('admin','yunxia.zhu'))
		and fs.sta!=''
		$sqlSch
		order by fs.sta asc , fs.dealdt desc , $sidx $sord
		limit $start , $limit ";
	$query = $this->db->query($sql);
	while ($row = $this->db->fetch_array($query)) {
		if($this->flowName['spe']==$row['flowname'] || $row['flowname']==$this->flowName['spe_3'] || 
				$row['flowname']==$this->flowName['spe_5'] || $row['flowname']==$this->flowName['spe_1'] || 
				$row['flowname']==$this->flowName['spe_0'] || $row['flowname']==$this->flowName['spe_xs_3'] || 
				$row['flowname']==$this->flowName['spe_xs_5'] || $row['flowname']==$this->flowName['spe_xs_1'] || 
				$row['flowname']==$this->flowName['spe_xs_0'] || $row['flowname']==$this->flowName['spe_xs_12']){
			if($row['spetype']=='0'){
				$flownamet='���⽱��';
				$spetype='����';
			}else{
				$flownamet='����۳�';
				$spetype='<font color="red">�۳�</font>';
			}
		}else{
			$flownamet=$row['flowname'];
		}
		if($row['fssta']=='0'){
			$ck='yes';
		}else{
			$ck='no';
		}
		$responce->rows[$i]['id'] = $row['userid'];
		if($this->flowName['spe']==$row['flowname'] || $row['flowname']==$this->flowName['spe_3'] || 
				$row['flowname']==$this->flowName['spe_5'] || $row['flowname']==$this->flowName['spe_1'] || 
				$row['flowname']==$this->flowName['spe_0'] || $row['flowname']==$this->flowName['spe_xs_3'] || 
				$row['flowname']==$this->flowName['spe_xs_5'] || $row['flowname']==$this->flowName['spe_xs_1'] || 
				$row['flowname']==$this->flowName['spe_xs_0'] || $row['flowname']==$this->flowName['spe_xs_12']){
			$responce->rows[$i]['cell'] = un_iconv(
					array("", $row['rand_key'], $row['id'], $row['username']
						, $row['olddept']
						, $spetype
						, $this->salaryClass->decryptDeal($row['changeam'])
						, $row['remark']
						, $row['item']
						, $this->flowStepSta[$row['fsres']]
						, $row['user_name']
						, $row['dealdt']
						, $ck
						, $row['remark_rea']
					     )
					);
		}else{
			if($sf=='nym'){
				$responce->rows[$i]['cell'] = un_iconv(
						array("", $row['rand_key'], $row['id'], $row['username']
							, $row['olddept']
							, $this->salaryClass->decryptDeal($row['changeam'])
							, $this->salaryClass->decryptDeal($row['gwam'])
							, $this->salaryClass->decryptDeal($row['jxam'])
							, $this->salaryClass->decryptDeal($row['oldam'])
							, $this->salaryClass->decryptDeal($row['oldgwam'])
							, $this->salaryClass->decryptDeal($row['oldjxam'])
							, $row['remark']
							, $row['item']
							, $this->flowStepSta[$row['fsres']]
							, $row['user_name']
							, $row['dealdt']
							, $ck
							, $row['remark_rea']
							,(empty($row['changedt'])?'ȫ��':$row['changedt'])
						     )
						);
			}else{
				$responce->rows[$i]['cell'] = un_iconv(
						array("", $row['rand_key'], $row['id'], $row['username']
							, $row['olddept']
							, $this->salaryClass->decryptDeal($row['changeam'])
							, $row['remark']
							, $row['item']
							, $this->flowStepSta[$row['fsres']]
							, $row['user_name']
							, $row['dealdt']
							, $ck
							, $row['remark_rea']
							,(empty($row['changedt'])?'ȫ��':$row['changedt'])
						     )
						);
			}
		}
		$i++;
	}
	return $responce;
}
/**
 * ���������б�
 */
function model_dp_sal_exa_prod_list(){
	$page = $_GET['page'];
	$limit = $_GET['rows'];
	$sidx = $_GET['sidx'];
	$sord = $_GET['sord'];
	$schOper = $_GET['searchOper'];
	$schStr = $_GET['searchString'];
	$schField = $_GET['searchField'];
	$sqlSch = '';
	if ($schOper) {
		$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
	}
	if($flag==false){
		$sqlSch.=$sqlflag;
	}
	$start = $limit * $page - $limit;
	$exa_sta=$_REQUEST['exa_sta'];
	if(empty($exa_sta)){
		$sfq=" and fs.sta='0' ";
	}else{
		$sfq=" and fs.sta='".$exa_sta."' ";
	}
	//����
	$sql = "select count(*)
		from salary_flow_step fs
		left join salary_flow f on (fs.salaryfid=f.id)
		left join salary_prod sp on (f.salarykey=sp.rand_key)
		left join salary s on (f.userid=s.userid)
		where
		f.salarykey=sp.rand_key
		and (find_in_set('".$_SESSION['USER_ID']."',fs.dealuser) or '".$_SESSION['USER_ID']."'='admin')
		and fs.sta!=''
		$sqlSch $sfq ";
	$rs = $this->db->get_one($sql);
	$count = $rs['count(*)'];
	if ($count > 0) {
		$total_pages = ceil($count / $limit);
	} else {
		$total_pages = 0;
	}
	if ($page > $total_pages){
		$page = $total_pages;
	}
	$i = 0;
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
	$sql="select
		fs.rand_key , f.id , u1.user_name as username , d.dept_name as olddept , f.flowname , f.changeam , f.userid
		, f.pyear , f.pmon , fs.item , f.sta , u.user_name , f.createdt , fs.sta as fssta
		, fs.res as fsres , fs.dealdt
		, f.remark
		, sp.ccxs , sp.khxs , sp.jjam , sp.gljtam , sp.qtjtam , sp.jxzcam , sp.lszsam  
		from salary_flow_step fs
		left join salary_flow f on ( fs.salaryfid=f.id )
		left join salary s on (f.userid=s.userid)
		left join user u on (f.createuser=u.user_id)
		left join salary_prod sp on (f.salarykey=sp.rand_key)
		left join user u1 on (u1.user_id=f.userid)
		left join department d on (u1.dept_id=d.dept_id)
		where
		f.salarykey=sp.rand_key
		and (find_in_set('".$_SESSION['USER_ID']."',fs.dealuser) or '".$_SESSION['USER_ID']."'='admin')
		and fs.sta!=''
		$sqlSch $sfq
		order by fs.sta asc , fs.dealdt desc , $sidx $sord
		limit $start , $limit ";
	$query = $this->db->query($sql);
	while ($row = $this->db->fetch_array($query)) {
		$flownamet=$row['flowname'];
		if($row['fssta']=='0'){
			$ck='yes';
		}else{
			$ck='no';
		}
		$responce->rows[$i]['id'] = $row['userid'];
		$responce->rows[$i]['cell'] = un_iconv(
				array("", $row['rand_key'], $row['id'], $row['username']
					, $row['olddept']

					, $row['ccxs'] , $row['khxs']
					, $row['jjam'] , $row['gljtam']
					, $row['qtjtam'] , $row['jxzcam'] , $row['lszsam']

					, $row['remark']
					, $row['item']
					, $this->flowStepSta[$row['fsres']]
					, $row['user_name']
					, $row['dealdt']
					, $ck
				     )
				);
		$i++;
	}
	return $responce;
}
/**
 * ���������б�
 */
function model_dp_sal_exa_sdy_list(){
	$page = $_GET['page'];
	$limit = $_GET['rows'];
	$sidx = $_GET['sidx'];
	$sord = $_GET['sord'];
	$schOper = $_GET['searchOper'];
	$schStr = $_GET['searchString'];
	$schField = $_GET['searchField'];
	$sqlSch = '';
	if ($schOper) {
		$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
	}
	if($flag==false){
		$sqlSch.=$sqlflag;
	}
	$start = $limit * $page - $limit;
	//����
	$sql = "select count(*)
		from salary_flow_step fs
		left join salary_flow f on (fs.salaryfid=f.id)
		left join salary_sdy sp on (f.salarykey=sp.rand_key)
		left join salary s on (f.userid=s.userid)
		where
		f.salarykey=sp.rand_key
		and (find_in_set('".$_SESSION['USER_ID']."',fs.dealuser) or '".$_SESSION['USER_ID']."'='admin')
		and fs.sta!=''
		$sqlSch ";
	$rs = $this->db->get_one($sql);
	$count = $rs['count(*)'];
	if ($count > 0) {
		$total_pages = ceil($count / $limit);
	} else {
		$total_pages = 0;
	}
	if ($page > $total_pages){
		$page = $total_pages;
	}
	$i = 0;
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
	$sql="select
		fs.rand_key , f.id , u1.user_name as username , d.dept_name as olddept , f.flowname , f.changeam , f.userid
		, f.pyear , f.pmon , fs.item , f.sta , u.user_name , f.createdt , fs.sta as fssta
		, fs.res as fsres , fs.dealdt
		, f.remark
		, sp.sdymeal , sp.sdyother
		from salary_flow_step fs
		left join salary_flow f on ( fs.salaryfid=f.id )
		left join salary s on (f.userid=s.userid)
		left join user u on (f.createuser=u.user_id)
		left join salary_sdy sp on (f.salarykey=sp.rand_key)
		left join user u1 on (u1.user_id=f.userid)
		left join department d on (u1.dept_id=d.dept_id)
		where
		f.salarykey=sp.rand_key
		and (find_in_set('".$_SESSION['USER_ID']."',fs.dealuser) or '".$_SESSION['USER_ID']."'='admin')
		and fs.sta!=''
		$sqlSch
		order by fs.sta asc , fs.dealdt desc , $sidx $sord
		limit $start , $limit ";
	$query = $this->db->query($sql);
	while ($row = $this->db->fetch_array($query)) {
		$flownamet=$row['flowname'];
		if($row['fssta']=='0'){
			$ck='yes';
		}else{
			$ck='no';
		}
		$responce->rows[$i]['id'] = $row['userid'];
		$responce->rows[$i]['cell'] = un_iconv(
				array("", $row['rand_key'], $row['id'], $row['username']
					, $row['olddept']
					, $this->salaryClass->decryptDeal($row['sdymeal'])
					, $this->salaryClass->decryptDeal($row['sdyother'])
					, $row['remark']
					, $row['item']
					, $this->flowStepSta[$row['fsres']]
					, $row['user_name']
					, $row['dealdt']
					, $ck
				     )
				);
		$i++;
	}
	return $responce;
}
/**
 * ������Ϣ
 */
function model_dp_sal_exa_info(){
	$msg='';
	$id=$_POST['id'];
	$sub=$_POST['sub'];
	if(!$id){
		return $msg='<font color="red">��ȡ����ʧ��</font>';
	}
	$info=array();
	if($sub=='fid'){
		$sql="select fs.item , fs.step ,fs.dealuser , fs.res , fs.remark , fs.dealdt
			from
			salary_flow_step fs
			left join salary_flow f on (fs.salaryfid=f.id)
			where
			f.rand_key='".$id."' ";
	}else{
		$sql="select fs.item , fs.step ,fs.dealuser , fs.res , fs.remark , fs.dealdt
			from
			salary_flow_step fs
			left join salary_flow f on (fs.salaryfid=f.id)
			left join salary_flow_step sp on (f.id=sp.salaryfid)
			where
			sp.rand_key='".$id."' ";
	}
	$query=$this->db->query($sql);
	while($row=$this->db->fetch_array($query)){
		$info[$row['step']]['item']=$row['item'];
		$info[$row['step']]['dealuser']=$row['dealuser'];
		$info[$row['step']]['res']=$row['res'];
		$info[$row['step']]['dealdt']=$row['dealdt'];
		$info[$row['step']]['remark']=$row['remark'];
	}
	if(count($info)){
		$msg.='<table style="text-align: center;"><tr><td width="80">��������</td><td width="80">������</td>
			<td width="80">�������</td><td width="120">��������</td><td width="138">���</td></tr>';
		foreach($info as $key=>$val){
			$dn='';
			$rs='δ��';
			if($val['dealuser']){
				$sql="select user_name from user where user_id in ('".  str_replace(',', "','", $val['dealuser'])."') ";
				$query=$this->db->query($sql);
				while($row=$this->db->fetch_array($query)){
					$dn.=$row['user_name'].';';
				}
				$dn=trim($dn,';');
			}
			if($val['res']=='yes'){
				$rs='<font color="green">ͬ��</font>';
			}elseif($val['res']=='no'){
				$rs='<font color="red">��ͬ��</font>';
			}
			$msg.='<tr>
				<td>'.$val['item'].'</td>
				<td>'.$dn.'</td>
				<td>'.$rs.'</td>
				<td>'.$val['dealdt'].'</td>
				<td>'.$val['remark'].'</td>
				</tr>';
		}
		$msg.='</table>';
	}
	return $msg;
}
/**
 * ����������
 */
function model_dp_sal_exa_ck(){
	$id = $_POST['id'];
	$ck=0;
	$ckid='';
	if(!empty($id)){
		if(is_array($id)){
			$ckid=implode(',',$id);
		}else{
			$ckid=$id;
		}
		$sql="select
			fs.rand_key
			from
			salary_flow_step fs
			where
			fs.rand_key in ('".str_replace(',', "','", $ckid)."')
			and (find_in_set('".$_SESSION['USER_ID']."',fs.dealuser) or '".$_SESSION['USER_ID']."'='admin')
			and fs.sta='0' ";
		$query=$this->db->query_exc($sql);
		while($row=$this->db->fetch_array($query)){
			if($row['rand_key']){
				$ck=1;
			}
		}
	}
	return $ck;
}
/**
 * ������������
 */
function model_dp_sal_exa_in(){
	$id = $_POST['id'];
	$res = $_POST['res'];
	$remark = $_POST['remark'];
	$sub = $_POST['sub'];
	try {
		if($sub=='all'&&!empty($id)){
			$idArr=array();
			$sql="select
				fs.rand_key
				from
				salary_flow_step fs
				where
				fs.rand_key in ('".str_replace(',', "','", $id)."')
				and (find_in_set('".$_SESSION['USER_ID']."',fs.dealuser) or '".$_SESSION['USER_ID']."'='admin')
				and fs.sta='0' ";
			$query=$this->db->query_exc($sql);
			while($row=$this->db->fetch_array($query)){
				$idArr[]=$row['rand_key'];
			}
			if(!empty($idArr)){
				foreach($idArr as $val){
					$responce->error=$this->model_flow_do($val, $res, $remark);
				}
			}
			$responce->id = $id;
		}elseif(!empty($id)){
			$responce->error=$this->model_flow_do($id, $res, $remark);
			$responce->id = $id;
		}
	} catch (Exception $e) {
		$responce->error = $e->getMessage();
	}
	return $responce;
}
/**
 *������������
 * @param type $key
 */
function model_dp_sal_exa_del($key){
	$sql="select sta , id  from salary_flow where rand_key = '".$key."' ";
	$ck= $this->db->get_one($sql);
	if($ck['sta']=='0'){
		$sql="delete from salary_flow where id= '".$ck['id']."' ";
		$this->db->query_exc($sql);
		$sql="delete from salary_flow_step where salaryfid= '".$ck['id']."' ";
		$this->db->query_exc($sql);
		$res['succ']=1;
	}else{
		$res['error']='�������뵥�������쵼����������ʧ��';
	}
	return $res;
}
/**
 *�����б�
 */
function model_dp_mdf_list($ty,$vty=''){
	if(!$ty||empty ($ty)){
		throw new Exception('Query type error');
	}
	$page = $_GET['page'];
	$limit = $_GET['rows'];
	$sidx = $_GET['sidx'];
	$sord = $_GET['sord'];
	$schOper = $_GET['searchOper'];
	$schStr = $_GET['searchString'];
	$schField = $_GET['searchField'];
	$sqlSch = '';
	if ($schOper) {
		$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
	}
	$start = $limit * $page - $limit;
	if(is_array($ty)){
		$sqlCk=" f.flowname in ( ";
		foreach($ty as $val){
			$sqlCk.="'".$this->flowName[$val]."' ,";
		}
		$sqlCk=trim($sqlCk,',');
		$sqlCk.=" ) ";
	}else{
		$sqlCk=" f.flowname ='".$this->flowName[$ty]."' ";
	}
	//����
	$sql = "select count(*)
		from salary_flow f
		left join salary s on (f.salarykey=s.rand_key and f.userid=s.userid)
		left join salary_flow_step fs on (f.id=fs.salaryfid and fs.sta='0')
		where
		(f.createuser='".$_SESSION['USER_ID']."' or '".$_SESSION['USER_ID']."'='admin' or '".$_SESSION['USER_ID']."'='admin') and
		$sqlCk
		$sqlSch ";
	$rs = $this->db->get_one($sql);
	$count = $rs['count(*)'];
	if ($count > 0) {
		$total_pages = ceil($count / $limit);
	} else {
		$total_pages = 0;
	}
	if ($page > $total_pages){
		$page = $total_pages;
	}
	$i = 0;
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
	$sql="select
		f.rand_key , s.username  , s.olddept , f.changeam , f.pyear , f.pmon , f.sta , fs.item , f.createdt ,f.remark
		, f.proname , f.prono , f.changedt, f.remark_rea
		, f.gwam , f.jxam
		from salary_flow f
		left join salary s on (f.userid=s.userid)
		left join salary_flow_step fs on (f.id=fs.salaryfid and fs.sta='0')
		where
		(f.createuser='".$_SESSION['USER_ID']."' or '".$_SESSION['USER_ID']."'='admin' or '".$_SESSION['USER_ID']."'='admin') and
		$sqlCk
		$sqlSch
		order by $sidx $sord
		limit $start , $limit ";
	$query = $this->db->query($sql);
	while ($row = $this->db->fetch_array($query)) {
		if($row['sta']=='1'){
			$sta='����'.$row['item'];
		}else{
			$sta=$this->flowSta[$row['sta']];
		}
		if(empty($row['changedt'])){
			$chdt='ȫ��';
		}else{
			$chdt=$row['changedt'];
		}
		$responce->rows[$i]['id'] = $row['rand_key'];
		if(in_array('pro', $ty)){
			$responce->rows[$i]['cell'] = un_iconv(
					array("", $row['rand_key']
						, $row['username']
						, $row['olddept']
						, $this->salaryClass->decryptDeal($row['changeam'])
						, $row['prono']
						, $row['proname']
						, $row['pyear'].'-'.$row['pmon']
						, $row['remark']
						, $sta
						, $row['createdt']
						, $row['remark_rea']
					     )
					);
		}else{
			if($vty=='nym'){
				$responce->rows[$i]['cell'] = un_iconv(
						array("", $row['rand_key']
							, $row['username']
							, $row['olddept']
							, $this->salaryClass->decryptDeal($row['changeam'])
							, $this->salaryClass->decryptDeal($row['gwam'])
							, $this->salaryClass->decryptDeal($row['jxam'])
							, $row['pyear'].'-'.$row['pmon']
							, $chdt
							, $row['remark_rea']
							, $row['remark']
							, $sta
							, $row['createdt']
							, $row['sta']
						     )
						);
			}else{
				$responce->rows[$i]['cell'] = un_iconv(
						array("", $row['rand_key']
							, $row['username']
							, $row['olddept']
							, $this->salaryClass->decryptDeal($row['changeam'])
							, $row['pyear'].'-'.$row['pmon']
							, $chdt
							, $row['remark']
							, $sta
							, $row['createdt']
						     )
						);
			}

		}
		$i++;
	}
	return $responce;
}
/**
 * ����ȵ�н
 */
function model_dp_nym_in(){
	//print_r($_POST);
	//die();
	$id = $_POST['id'];
	$sub= $_POST['sub'];
	$amount=$_POST['amount'];
	$gwam=$_POST['gwam'];
	$jxam=$_POST['jxam'];

	$oldam=$_POST['oldam'];
	$oldgwam=$_POST['oldgwam'];
	$oldjxam=$_POST['oldjxam'];

	$remark=$_POST['remark'];
	$remark_rea=$_POST['remark_rea'];
	$uty = $_POST['uty'];
	$udt = $_POST['udt'];
	$chdt = '';
	$sm=false;
	try {
		$this->db->query("START TRANSACTION");
		if($sub=='new'){
			if(!$id||!trim($id)){
				throw new Exception('no user id');
			}
			if(!$_SESSION['USER_ID']){
				throw new Exception('time out');
			}
			$tmpua=explode(',', $id);
			if($uty=='part'){
				$chdt=$udt;
			}
			$usi = array();
			$sql="select h.userlevel , h.user_id , s.Amount , s.gwam , s.jxam, s.usercom from hrms h
				LEFT JOIN salary s on (h.USER_ID = s.UserId )
				where h.user_id in ('".implode("','", $tmpua)."')";
			$query=$this->db->query($sql);
			$tmpua=array();
			while($row=$this->db->fetch_array($query)){
				$tmpua[$row['user_id']]=$row['userlevel'];
				$usi[$row['user_id']]['Amount']=$row['Amount'];
				$usi[$row['user_id']]['gwam']=$row['gwam'];
				$usi[$row['user_id']]['jxam']=$row['jxam'];
			}
			if(count($tmpua)){
				foreach($tmpua as $key=>$val){
					if($val!='0'&&(!$val||$val=='')){
						continue;
					}
					$flowname = $this->flowName['nym_'.$val];
					if($row['usercom'] == 'xs') {
						$flowname = $this->flowName['nym_xs_'.$val];
					}
					$info=array('flowname'=>$flowname
							,'userid'=>$key
							,'salarykey'=>''
							,'changeam'=>$this->salaryClass->encryptDeal($amount)
							,'gwam'=>$this->salaryClass->encryptDeal($gwam)
							,'jxam'=>$this->salaryClass->encryptDeal($jxam)

							,'oldam'=>$usi[$key]['Amount']
							,'oldgwam'=>$usi[$key]['gwam']
							,'oldjxam'=>$usi[$key]['jxam']

							,'remark'=>$remark
							,'changedt'=>$chdt
							,'remark_rea'=>$remark_rea
						   );
					$sm[$key]=$this->model_flow_new($info);
				}
			}
		}
		$this->db->query("COMMIT");
		if(is_array($sm)){
			if(count($sm)){
				foreach($sm as $val){
					$body='���ã�<br><br>
						ϵͳ���з���ȵ�н�������ݣ���Ҫ����������<br>
						����������'.$_SESSION['USER_NAME'].'�����ύ<br>
						лл��';
					$this->model_send_email('����--����ȵ�н', $body, $val, false,true);
				}
			}
		}elseif($sm){
			$body='���ã�<br><br>
				ϵͳ���з���ȵ�н�������ݣ���Ҫ����������<br>
				����������'.$_SESSION['USER_NAME'].'�����ύ<br>
				лл��';
			$this->model_send_email('����--����ȵ�н', $body, $sm, false,true);
		}
		$responce->id = $id;
		$this->globalUtil->insertOperateLog('���ʹ���', $id, '����ȵ�н', '�ɹ�');
	} catch (Exception $e) {
		$this->db->query("ROLLBACK");
		$responce->error = $e->getMessage();
		$this->globalUtil->insertOperateLog('���ʹ���', $id, '����ȵ�н', 'ʧ��', $e->getMessage());
	}
	return $responce;
}
/**
 *��н����
 * @return string
 */
function model_dp_nym_xls(){
	set_time_limit(600);
	global $func_limit;
	$sqlflag='';
	$dppow=$this->model_dp_pow();
	// $sqlflag=$this->getSqlParam($func_limit['�������'],$dppow);
	$flag=$_REQUEST['flag'];
	$type=$_POST['ctr_type'];
	$sqlCk=$type=='com'?'0':'1';
	$str='';
	$ckt=time();
	$infoE=array();
	$code=$flag=='year'?'amount-year':'amount';
	try{
		$sql="delete from salary_temp where code = '".$code."' and creator='".$_SESSION['USER_ID']."' ";
		$this->db->query_exc($sql);
		$excelfilename='attachment/xls_model/dp_nym/'.$ckt.".xls";
		if(empty ($_FILES["ctr_file"]["tmp_name"])){
			$str='<tr><td colspan="10">�뵼���н���ݱ�</td></tr>';
		}elseif (!move_uploaded_file( $_FILES["ctr_file"]["tmp_name"], $excelfilename) ){
			$str='<tr><td colspan="10">�ϴ�ʧ�ܣ�</td></tr>';
		}else{
			//��ȡexcel��Ϣ
			include('includes/classes/excel.php');
			$excel = Excel::getInstance();
			$excel->setFile(WEB_TOR.$excelfilename);
			$excel->Open();
			$excel->setSheet();
			$excelFields = $excel->getFields();
			$excelArr=$excel->getAllData();
			$excel->Close();
			if(!in_array('Ա��', $excelFields)||!in_array('Ա����', $excelFields)
					||!in_array('��н���������', $excelFields)||!in_array('����ԭ��', $excelFields)
					||!in_array('��������ע', $excelFields)){
				throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
			}
			if(count($excelArr)&&!empty($excelArr)){
				foreach($excelArr['Ա����'] as $key=>$val ){
					$infoE[$val]['name']=$excelArr['Ա��'][$key];
					$infoE[$val]['amount']=$excelArr['��н���������'][$key];
					$infoE[$val]['gwam']=$excelArr['��н���λ����'][$key];
					$infoE[$val]['jxam']=$excelArr['��н��Ч����'][$key];
					$infoE[$val]['remark_rea']=$excelArr['����ԭ��'][$key];
					$infoE[$val]['remark']=$excelArr['��������ע'][$key];
				}
			}
			if($flag=='year'){
				$sql="select
					s.username , s.userid , h.usercard as idcard , d.dept_name
					from
					salary s
					left join hrms h on(s.userid=h.user_id)
					left join user u on (s.userid=u.user_id)
					left join department d on (u.dept_id=d.dept_id)
					where 1
					and s.usersta!=3";
			}else{
				$sql="select
					s.username , s.userid , h.usercard as idcard , d.dept_name
					from
					salary s
					left join hrms h on (s.userid=h.user_id)
					left join user u on (s.userid=u.user_id)
					left join department d on (u.dept_id=d.dept_id)
					where 1 ".$sqlflag;
			}
			$query=$this->db->query_exc($sql);
			while($row=$this->db->fetch_array($query)){
				$infoA[]=$row['idcard'];
				if(array_key_exists($row['idcard'],$infoE)){
					$infoE[$row['idcard']]['type']=0;
					$infoE[$row['idcard']]['name']=$row['username'];
					$infoE[$row['idcard']]['dept']=$row['dept_name'];
				}
			}
			if(count($infoE)){
				foreach($infoE as $key=>$val){
					if(!in_array($key,$infoA)){
						$infoE[$key]['type']=1;
					}
				}
			}
			$this->db->query("START TRANSACTION");
			if(count($infoE)){
				//print_r($infoE);
				foreach($infoE as $key=>$val){
					if($val['type']=='0'){
						$cl='green';
					}else{
						$cl='#FF9900';
					}
					$str.='<tr style="color:'.$cl.'">
						<td>'.$key.'</td>
						<td>'.$val['name'].'</td>
						<td>'.$val['amount'].'</td>
						<td>'.$val['gwam'].'</td>
						<td>'.$val['jxam'].'</td>
						<td>'.$val['remark_rea'].'</td>
						<td>'.$val['remark'].'</td>
						<td>'.($val['type']=='0'?'��Ч':'Ա����ƥ�䲻�ɹ����Ա���Ǳ�����Ա��').'</td>
						</tr>';
					if($val['type']=='0'&&$key){

						$sql="insert into salary_temp ( idcard , code , amount , remark , type , creator , remark_rea, gwam , jxam )
							values ( '".$key."' , '".$code."' , '".round($val['amount'],2)."'
									, '".$val['remark']."' , 'salary' ,'".$_SESSION['USER_ID']."' , '".$val['remark_rea']."'
									, '".$val['gwam']."', '".$val['jxam']."'
							       )";
						$this->db->query_exc($sql);
					}
				}
			}
			$this->db->query("COMMIT");
		}
	}catch(Exception $e){
		$this->db->query("ROLLBACK");
		$str='<tr><td colspan="5">�������ݴ���'.$e->getMessage().'</td></tr>';
	}
	return $str;
}
/**
 *��н���ݵ���
 * @return <type>
 */
function model_dp_nym_xls_in(){
	try {
		$info=array();
		$this->db->query("START TRANSACTION");
		$sql="select
			t.amount , h.userlevel , s.userid , t.remark , t.code , t.remark_rea
			,t.gwam , t.jxam
			, s.amount as oldam , s.gwam as oldgwam , s.jxam as oldjxam , s.usercom
			from salary_temp t
			left join hrms h on (t.idcard=h.usercard)
			left join salary s on ( s.userid=h.user_id)
			where t.code in ( 'amount' , 'amount-year' ) and t.creator='".$_SESSION['USER_ID']."' ";
		$query=$this->db->query_exc($sql);
		if(!$this->db->affected_rows()){
			throw new Exception('No updated data');
		}
		while($row=$this->db->fetch_array($query)){
			$info[$row['userid']]['amount']=$row['amount'];
			$info[$row['userid']]['gwam']=$row['gwam'];
			$info[$row['userid']]['jxam']=$row['jxam'];

			$info[$row['userid']]['ul']=$row['userlevel'];
			$info[$row['userid']]['remark']=$row['remark'];
			$info[$row['userid']]['flag']=$row['code'];
			$info[$row['userid']]['remark_rea']=$row['remark_rea'];

			$info[$row['userid']]['oldam']=$row['oldam'];
			$info[$row['userid']]['oldgwam']=$row['oldgwam'];
			$info[$row['userid']]['oldjxam']=$row['oldjxam'];
			$info[$row['userid']]['usercom']=$row['usercom'];
		}
		if(count($info)){
			foreach($info as $key=>$val){
				$flowname=$val['flag']=='amount-year'?$this->flowName['ymd']:$this->flowName['nym_'.$val['ul']];
				if($val['usercom']=="xs") {
					$flowname=$val['flag']=='amount-year'?$this->flowName['ymd']:$this->flowName['nym_xs_'.$val['ul']];
				}
				$info=array('flowname'=>$flowname
						,'userid'=>$key
						,'salarykey'=>''
						,'changeam'=>$this->salaryClass->encryptDeal($val['amount'])
						,'gwam'=>$this->salaryClass->encryptDeal($val['gwam'])
						,'jxam'=>$this->salaryClass->encryptDeal($val['jxam'])

						,'oldam'=>$val['oldam']
						,'oldgwam'=>$val['oldgwam']
						,'oldjxam'=>$val['oldjxam']

						,'remark'=>$val['remark']
						,'remark_rea'=>$val['remark_rea']
					   );
				$sm[$key]=$this->model_flow_new($info);
			}
		}
		if(empty($sm)){
			foreach($sm as $val){
				$body='���ã�<br><br>
					ϵͳ���з���ȵ�н�������ݣ���Ҫ����������<br>
					����������'.$_SESSION['USER_NAME'].'�����ύ<br>
					лл��';
				$this->model_send_email('����--����ȵ�н', $body, $val, false,true);
			}
		}
		$this->db->query("COMMIT");
		$responce->id = $id;
		$this->globalUtil->insertOperateLog('���ʹ���', $id, '��н', '�ɹ�');
	} catch (Exception $e) {
		$this->db->query("ROLLBACK");
		$responce->error = $e->getMessage();
		$this->globalUtil->insertOperateLog('���ʹ���', $id, '��н', 'ʧ��', $e->getMessage());
	}
	return $responce;
}
/**
 * ����
 */
function model_dp_bos_in(){
	$id = $_POST['id'];
	$sub= $_POST['sub'];
	$amount=$_POST['amount'];
	$remark=$_POST['remark'];
	$sm=false;
	try {
		$this->db->query("START TRANSACTION");
		if($sub=='new'){
			if(!$id||!trim($id)){
				throw new Exception('no user id');
			}
			if(!$_SESSION['USER_ID']){
				throw new Exception('time out');
			}
			$tmpua=explode(',', $id);
			$sql="select userlevel , user_id from hrms where user_id in ('".implode("','", $tmpua)."')";
			$query=$this->db->query($sql);
			$tmpua=array();
			while($row=$this->db->fetch_array($query)){
				$tmpua[$row['user_id']]=$row['userlevel'];
			}
			if(count($tmpua)){
				foreach($tmpua as $key=>$val){
					if(!$val||$val==''){
						continue;
					}
					$info=array('flowname'=>$this->flowName['bos']
							,'userid'=>$key
							,'salarykey'=>''
							,'changeam'=>$this->salaryClass->encryptDeal($amount)
							,'remark'=>$remark
						   );
					$sm[$key]=$this->model_flow_new($info);
				}
			}
		}
		$this->db->query("COMMIT");
		if(is_array($sm)){
			if(count($sm)){
				foreach($sm as $val){
					$body='���ã�<br>
						��������-��Ŀ������Ҫ����������<br>
						лл��';
					$this->model_send_email('����--����', $body, $val, false);
				}
			}
		}elseif($sm){
			$body='���ã�<br>
				��������-��Ŀ������Ҫ����������<br>
				лл��';
			$this->model_send_email('����--����', $body, $sm, false);
		}
		$responce->id = $id;
		$this->globalUtil->insertOperateLog('���ʹ���', $id, '����', '�ɹ�');
	} catch (Exception $e) {
		$this->db->query("ROLLBACK");
		$responce->error = $e->getMessage();
		$this->globalUtil->insertOperateLog('���ʹ���', $id, '����', 'ʧ��', $e->getMessage());
	}
	return $responce;
}
/**
 *
 */
function model_dp_bos_xls($ckt){
	set_time_limit(600);
	$type=$_POST['ctr_type'];
	$sqlCk=$type=='com'?'0':'1';
	$str='';
	$infoE=array();
	try{
		$sql="delete from salary_temp where code = 'amount' and creator='".$_SESSION['USER_ID']."' ";
		$this->db->query_exc($sql);
		$excelfilename='attachment/xls_model/bos/'.$ckt.".xls";
		if(empty ($_FILES["ctr_file"]["tmp_name"])){
			$str='<tr><td colspan="10">�뵼�뽱�����ݱ�</td></tr>';
		}elseif (!move_uploaded_file( $_FILES["ctr_file"]["tmp_name"], $excelfilename) ){
			$str='<tr><td colspan="10">�ϴ�ʧ�ܣ�</td></tr>';
		}else{
			//��ȡexcel��Ϣ
			include('includes/classes/excel.php');
			$excel = Excel::getInstance();
			$excel->setFile(WEB_TOR.$excelfilename);
			$excel->Open();
			$excel->setSheet();
			$excelFields = $excel->getFields();
			$excelArr=$excel->getAllData();
			$excel->Close();
			if(!in_array('Ա��', $excelFields)||!in_array('Ա����', $excelFields)
					||!in_array('����', $excelFields)||!in_array('��ע', $excelFields))
			{
				throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
			}
			if(count($excelArr)&&!empty($excelArr)){
				foreach($excelArr['Ա����'] as $key=>$val ){
					$infoE[$val]['name']=$excelArr['Ա��'][$key];
					$infoE[$val]['pro']=$excelArr['����'][$key];
					$infoE[$val]['remark']=$excelArr['��ע'][$key];
				}
			}
			$sql="select
				s.username , s.userid , h.usercard as idcard
				from
				salary s
				left join hrms h on(s.userid=h.user_id)
				where s.usersta!=3  ";
			$query=$this->db->query_exc($sql);
			while($row=$this->db->fetch_array($query)){
				$infoA[]=$row['idcard'];
				if(array_key_exists($row['idcard'],$infoE)){
					$infoE[$row['idcard']]['type']=0;
					$infoE[$row['idcard']]['name']=$row['username'];
				}
			}
			if(count($infoE)){
				foreach($infoE as $key=>$val){
					if(!in_array($key,$infoA)){
						$infoE[$row['idcard']]['type']=1;
					}
				}
			}
			if(count($infoE)){
				$totalA=array('pro'=>0);
				foreach($infoE as $key=>$val){
					if(empty($key)){
						continue;
					}
					if($val['type']=='0'){
						$cl='green';
					}elseif($val['type']=='1'){
						$cl='red';
					}
					$totalA['pro']=$totalA['pro']+$val['pro'];
					$str.='<tr style="color:'.$cl.'">
						<td>'.$key.'</td>
						<td>'.$val['name'].'</td>
						<td>'.$val['pro'].'</td>
						<td>'.$val['remark'].'</td>
						</tr>';
				}
			}
			$str.='<tr style="color:red">
				<td></td>
				<td>�ϼƣ�</td>
				<td>'.$totalA['pro'].'</td>
				<td></td>
				</tr>';
		}
	}catch(Exception $e){
		$str='<tr><td colspan="10">�������ݴ���'.$e->getMessage().'</td></tr>';
	}
	return $str;
}
/**
 * �����ʼ������
 */
function model_dp_bos_xls_in(){
	set_time_limit(600);
	$ckt=$_POST['ckt'];
	$excelfilename=WEB_TOR.'attachment/xls_model/bos/'.$ckt.".xls";
	try{
		if(!file_exists($excelfilename)){
			throw new Exception('File does not exist');
		}
		include('includes/classes/excel.php');
		$excel = Excel::getInstance();
		$excel->setFile($excelfilename);
		$excel->Open();
		$excel->setSheet();
		$excelFields = $excel->getFields();
		$excelArr=$excel->getAllData();
		$excel->Close();
		if(!in_array('Ա��', $excelFields)||!in_array('Ա����', $excelFields)
				||!in_array('����', $excelFields)||!in_array('��ע', $excelFields))
		{
			throw new Exception('Update failed');
		}
		if(count($excelArr)&&!empty($excelArr)){
			foreach($excelArr['Ա����'] as $key=>$val ){
				$infoE[$val]['name']=$excelArr['Ա��'][$key];
				$infoE[$val]['pro']=$excelArr['����'][$key];
				$infoE[$val]['remark']=$excelArr['��ע'][$key];
			}
		}
		if(count($infoE)){
			foreach($infoE as $key=>$val){
				$sql="select s.rand_key , p.id as pid , s.userid,h.userlevel from salary s
					left join salary_pay p on (s.userid=p.userid and p.pyear='".$this->nowy."' and pmon='".$this->nowm."')
					left join hrms h on (s.userid=h.user_id)
					where  h.usercard='".$key."' ";
				$res=$this->db->get_one($sql);
				if(!empty($res)){
					$info=array('flowname'=>$this->flowName['bos']
							,'userid'=>$res['userid']
							,'salarykey'=>''
							,'changeam'=>$this->salaryClass->encryptDeal($val['pro'])
							,'remark'=>$val['remark']
						   );
					$sm[$key]=$this->model_flow_new($info);
				}
			}
		}
		if(is_array($sm)){
			if(count($sm)){
				foreach($sm as $val){
					$body='���ã�<br>
						��������-������Ҫ����������<br>
						лл��';
					$this->model_send_email('����--����', $body, $val, false);
				}
			}
		}
	}catch(Exception $e){
		$responce->error = un_iconv($e->getMessage());
	}
	return $responce;
}
/**
 *
 * @param unknown $flag
 * @param unknown $info
 */
function model_xls_in($flag,$info){
	$ckt=$_POST['ckt'];
	$excelUtil = new model_salary_excelUtil();
	$data=$excelUtil->xls_check($ckt,$flag,'arr',$info);
	if($flag =='hr_join'){
		if(count($data)){
			try {
				$this->db->query("START TRANSACTION");
				//print_r($data);
				foreach($data as $key=>$val){
					if($val['��֤']=='1'){
						//
						if($val['Ա������']==4 || 1==1){//�ǹ����Ա��

							if (strtotime($val['����']) < strtotime(date('Y-m') . '-01')) {
								$baseNow = 0;
							} else {
								$baseNow = $this->salaryClass->salaryDeal($val['����']
										, round($val['�������ʽ��']+$val['��λ���ʽ��']+$val['��Ч���ʽ��'],2)
										);
							}
							$this->model_salary_update($val['skey'],
									array('amount' => $val['�������ʽ��'], 'probationam' => $val['�������ʽ��']
										,'probationnowam'=>$this->salaryClass->salaryDeal($val['����'],
											round($val['�������ʽ��']+$val['��λ���ʽ��']+$val['��Ч���ʽ��'],2)
											)
										, 'gwam' =>$val['��λ���ʽ��']
										, 'jxam' =>$val['��Ч���ʽ��']
										, 'usersta' => '1'
										, 'probationdt' => 'now()', 'probationuser' => $_SESSION['USER_ID']
										,'oldname'=>$val['����']
										,'idcard'=>$val['���֤'],'acc'=>$val['�˺�']
										,'accbank'=>$val['������']
										,'comedt' =>date('Ymd',strtotime($val['����']))
									     )
									, array(5,6,7,8,9,10,11,12,13,14,15));
							$this->model_pay_update($val['pid'],
									array('baseam' => $val['�������ʽ��'], 'basenowam' => $baseNow
										, 'gwam' =>$val['��λ���ʽ��']
										, 'jxam' =>$val['��Ч���ʽ��']
										, 'nowamflag' => '1', 'leaveflag'=>'0')
									, array(4,5));
							$this->model_pay_stat($val['pid']);
						}else{//�����
							$this->model_salary_update($val['skey'],
									array(
										'oldname'=>$val['����']
										,'idcard'=>$val['���֤'],'acc'=>$val['�˺�']
										,'accbank'=>$val['������']
										,'comedt' =>date('Ymd',strtotime($val['����']))
									     ),array(0,1,2,3,4,5,6,7)
									);
						}
					}
				}
				$this->db->query("COMMIT");
				$this->globalUtil->insertOperateLog('��ְ����', '��ְ����', '��ְ����', '�ɹ�');
			} catch (Exception $e) {
				$this->db->query("ROLLBACK");
				$responce->error = un_iconv($e->getMessage());
				$this->globalUtil->insertOperateLog('��ְ����', '��ְ����' , '��ְ����', 'ʧ��', $e->getMessage());
			}
		}
	}elseif($flag =='hr_pass'){//ת��
		//          print_r($data);
		if(count($data)){
			try {
				$this->db->query("START TRANSACTION");

				foreach($data as $key=>$val){
					if($val['��֤']=='1'){
						$passam=$val['ת����������'];
						$passdt=$val['ת������'];

						$gwam=$val['ת����λ����'];
						$jxam=$val['ת����Ч����'];

						if ($val['Ա������'] == 4 || $val['Ա������'] != 4) {
							if($val['usersta']==2){ //������
								$passOldAm=$this->salaryClass->decryptDeal($val['passoldam']);
							}else{

								$passOldAm=round( $this->salaryClass->decryptDeal($val['amount'])
										+$this->salaryClass->decryptDeal($val['gwam'])
										+$this->salaryClass->decryptDeal($val['jxam'])
										, 2);
							}
							$passNowAm=$this->salaryClass->salaryPass($passOldAm
									,  round($passam+$gwam+$jxam  ,2)
									, $passdt);

							if(date('Y-m',  strtotime($passdt))==date('Y-m')){//����ת��
								$baseNowAm = $passNowAm;
							}else{
								$baseNowAm = 0;
							}
							$this->model_salary_update($val['skey'],
									array('amount' => $passam, 'passam' => $passam, 'usersta' => '2'
										, 'passdt' => $passdt
										, 'passuserdt' => 'now()', 'passuser' => $_SESSION['USER_ID']
										, 'passnowam'=>$passNowAm
										, 'passoldam'=>$passOldAm
										, 'gwam'=>$gwam
										, 'jxam'=>$jxam
									     )
									, array(2, 3, 4,5));
							$this->model_pay_update($val['pid'],
									array('baseam' => $passam, 'basenowam' => $baseNowAm
										, 'gwam'=>$gwam
										, 'jxam'=>$jxam
										, 'nowamflag' => '2')
									, array(4));
							$this->model_pay_stat($val['pid']);
						} else {
							$sm=true;
							$this->model_salary_update($val['skey']
									, array('passdt' => $passdt, 'passuser' => $_SESSION['USER_ID']), array(0, 1));
						}

						$sql="update hrms set join_date='".$passdt."' where usercard='".$val['Ա����']."' ";
						$this->db->query_exc($sql);
					}
				}

				$this->db->query("COMMIT");
				$this->globalUtil->insertOperateLog('ת������', 'ת������', 'ת������', '�ɹ�');
			} catch (Exception $e) {
				$this->db->query("ROLLBACK");
				$responce->error = un_iconv($e->getMessage());
				$this->globalUtil->insertOperateLog('ת������', 'ת������' , 'ת������', 'ʧ��', $e->getMessage());
			}
		}
	}elseif($flag=='hr_spe'){//�۳�����

		if(count($data)){
			try {
				$this->db->query("START TRANSACTION");
				$ptyarr=array_flip($this->speType);
				$ctyarr=array_flip($this->accType);
				foreach($data as $key=>$val){
					if($val['��֤']=='1'){
						$spekey=get_rand_key();
						$sql="insert into salary_spe
							( payyear , paymon , amount
							  , payuserid , payuserna ,remark
							  , createdt , creator , spesta ,rand_key , paytype , acctype
							)
							select
							'".$this->nowy."' , '".$this->nowm."' , '".$this->salaryClass->encryptDeal($val['���'])."'
							, user_id , user_name , '".$val['��ע']."'
							, now() , '".$_SESSION['USER_ID']."' , 1 , '".$spekey."' ,'".$ptyarr[$val['����']]."','".$ctyarr[$val['�Ƿ��˰']]."'
							from user where user_id='".$val['userid']."' ";
						$this->db->query_exc($sql);

						$usercom=$this->db->get_one("select usercom from salary s where s.userid = '"+ $val['userid'] +"'");
						$flowname = $this->flowName['spe_'.$val['Ա������']];
						if($usercom['usercom'] == 'xs') {
							$flowname = $this->flowName['spe_xs_'.$val['Ա������']];
						}
						$info=array('flowname'=>$flowname
								,'userid'=>$val['userid']
								,'salarykey'=>$spekey
								,'changeam'=>$this->salaryClass->encryptDeal($val['���'])
								,'remark'=>$val['��ע']
							   );
						$sm[$val]=$this->model_flow_new($info);
					}
				}

				$this->db->query("COMMIT");
				$this->globalUtil->insertOperateLog('��������', '��������', '��������', '�ɹ�');
			} catch (Exception $e) {
				$this->db->query("ROLLBACK");
				$responce->error = un_iconv($e->getMessage());
				$this->globalUtil->insertOperateLog('��������', '��������' , '��������', 'ʧ��', $e->getMessage());
			}
		}
	}elseif($flag=='hr_jb'){//��������

		if(count($data)){
			try {
				$this->db->query("START TRANSACTION");

				foreach($data as $key=>$val){
					if($val['��֤']=='1'){
						$this->model_salary_update($val['skey'],
								array('amount' => $val['��������'], 'gwam' => $val['��λ����'], 'jxam' =>$val['��Ч����'] )
								);
						$this->model_pay_update($val['pid'],
								array('baseam' =>$val['��������'], 'gwam' => $val['��λ����'], 'jxam' =>$val['��Ч����'] ));

						$this->model_pay_stat($val['pid']);
					}
				}

				$this->db->query("COMMIT");
				$this->globalUtil->insertOperateLog('�������ʵ���', '�������ʵ���', '�������ʵ���', '�ɹ�');
			} catch (Exception $e) {
				$this->db->query("ROLLBACK");
				$responce->error = un_iconv($e->getMessage());
				$this->globalUtil->insertOperateLog('�������ʵ���', '�������ʵ���' , '�������ʵ���', 'ʧ��', $e->getMessage());
			}
		}
	}elseif($flag=='hr_gw'||$flag=='hr_tx'){//��λ����

		if(count($data)){
			try {
				$this->db->query("START TRANSACTION");

				foreach($data as $key=>$val){
					if($val['��֤']=='1'){
						if($flag=='hr_gw'){
							$this->model_salary_update($val['skey'],
									array('gwam' => $val['��λ����'])  );
							$this->model_pay_update($val['pid'],
									array ( 'gwam' => $val['��λ����']) );

							$this->model_pay_stat($val['pid']);
						}elseif($flag=='hr_tx'){
							$this->model_pay_update($val['pid'],
									array ( 'txjt' => $val['ͨ�Ž���']) );

							$this->model_pay_stat($val['pid']);
						}

					}
				}

				$this->db->query("COMMIT");
				$this->globalUtil->insertOperateLog('�������ʵ���', '�������ʵ���', '�������ʵ���', '�ɹ�');
			} catch (Exception $e) {
				$this->db->query("ROLLBACK");
				$responce->error = un_iconv($e->getMessage());
				$this->globalUtil->insertOperateLog('�������ʵ���', '�������ʵ���' , '�������ʵ���', 'ʧ��', $e->getMessage());
			}
		}
	}

	return $responce;
}

/**
 * ��ְ�����ʼ������
 */
function model_hr_join_xls_in($hrflag='fn'){
	set_time_limit(600);
	$ckt=$_POST['ckt'];
	$manflag=$_GET['manflag'];
	$excelfilename=WEB_TOR.'attachment/xls_model/join/'.$ckt.".xls";
	try{
		if(!file_exists($excelfilename)){
			throw new Exception('File does not exist');
		}
		include('includes/classes/excel.php');
		$excel = Excel::getInstance();
		$excel->setFile($excelfilename);
		$excel->Open();
		$excel->setSheet();
		$excelFields = $excel->getFields();
		$excelArr=$excel->getAllData();
		$excel->Close();
		if($hrflag=='hr'){//��ְ
			if(!in_array('����', $excelFields)||!in_array('Ա����', $excelFields))
			{
				throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
			}
			if(count($excelArr)&&!empty($excelArr)){
				foreach($excelArr['Ա����'] as $key=>$val ){
					$infoE[$val]['name']=$excelArr['����'][$key];
					$infoE[$val]['comedt']=$excelArr['����'][$key];
					$infoE[$val]['am']=$excelArr['���ʽ��'][$key];
					$infoE[$val]['idcard']=$excelArr['���֤'][$key];
					$infoE[$val]['acc']=$excelArr['�˺�'][$key];
					$infoE[$val]['accbank']=$excelArr['������'][$key];
					$infoE[$val]['type']=1;
				}
			}
			$sql="select
				h.usercard , s.username , h.userlevel , p.id as pid , s.rand_key
				, u.company , u.salarycom
				from salary s
				left join hrms h on ( s.userid=h.user_id )
				left join user u on ( u.user_id=s.userid)
				left join salary_pay p on ( p.pyear='" . $this->nowy . "' and p.pmon='" . $this->nowm . "' and p.userid=s.userid )
				where
				s.userid=h.user_id
				and ( s.usersta='0' or
						( year(s.probationdt)='".$this->nowy."' and  month(s.probationdt)='".$this->nowm."' )
				    )
				order by s.id
				";
			$query=$this->db->query_exc($sql);
			while($row=$this->db->fetch_array($query)){
				if(array_key_exists($row['usercard'],$infoE)){
					$infoE[$row['usercard']]['type']='0';
					$infoE[$row['usercard']]['userlevel']=$row['userlevel'];
					//$infoE[$row['usercard']]['pid']=$row['pid'];
					$infoE[$row['usercard']]['com']=$row['company'];
					if(!empty($row['salarycom'])){
						$infoE[$row['usercard']]['com']=$row['salarycom'];
					}
					$infoE[$row['usercard']]['sid']=$row['rand_key'];
				}
			}
			if(count($infoE)){
				try {
					$this->db->query("START TRANSACTION");

					foreach($infoE as $key=>$val){
						if($val['type']=='0'){
							if($val['userlevel']==4){//�ǹ����Ա��
								$comtable=$this->get_com_sql($val['com']);
								$sql="select
									p.id as pid
									from salary s
									left join ".$comtable."salary_pay p
									on ( p.pyear='" . $this->nowy . "' and p.pmon='" . $this->nowm . "' and p.userid=s.userid )
									where
									s.rand_key='".$val['sid']."'";
								$rescom=$this->db->get_one($sql);
								$val['pid']=$rescom['pid'];
								if (strtotime($val['comedt']) < strtotime(date('Y-m') . '-01')) {
									$baseNow = 0;
								} else {
									$baseNow = $this->salaryClass->salaryDeal($val['comedt'], $val['am']);
								}
								$this->model_salary_update($val['sid'],
										array('amount' => $val['am'], 'probationam' => $val['am'], 'usersta' => '1'
											, 'probationdt' => 'now()', 'probationuser' => $_SESSION['USER_ID']
											,'probationnowam'=>$this->salaryClass->salaryDeal($val['comedt'], $val['am'])
											,'oldname'=>$val['name']
											,'idcard'=>$val['idcard'],'acc'=>$val['acc']
											,'accbank'=>$val['accbank']
											,'comedt' =>date('Ymd',strtotime($val['comedt']))
										     )
										, array(2, 3, 4,6,7,8,9,10,11,12,13));
								$this->model_pay_update($val['pid'],
										array('baseam' => $val['am'], 'basenowam' => $baseNow, 'nowamflag' => '1', 'leaveflag'=>'0')
										, array(2,3),$comtable);
								$this->model_pay_stat($val['pid'],$comtable);
							}else{//�����
								$this->model_salary_update($val['sid'],
										array(
											'oldname'=>$val['name']
											,'idcard'=>$val['idcard'],'acc'=>$val['acc']
											,'accbank'=>$val['accbank']
											,'comedt' =>date('Ymd',strtotime($val['comedt']))
										     ),array(0,1,2,3,4,5,6,7)
										);
							}
						}
					}

					$this->db->query("COMMIT");
					$this->globalUtil->insertOperateLog('��ְ����', '��ְ����', '��ְ����', '�ɹ�');
				} catch (Exception $e) {
					$this->db->query("ROLLBACK");
					$responce->error = un_iconv($e->getMessage());
					$this->globalUtil->insertOperateLog('��ְ����', '��ְ����' , '��ְ����', 'ʧ��', $e->getMessage());
				}
			}
		}elseif($hrflag=='pass'){//ת��
			if(!in_array('����', $excelFields)||!in_array('Ա����', $excelFields))
			{
				throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
			}
			if(count($excelArr)&&!empty($excelArr)){
				foreach($excelArr['Ա����'] as $key=>$val ){
					$infoE[$val]['name']=$excelArr['����'][$key];
					$infoE[$val]['passdt']=$excelArr['ת������'][$key];
					$infoE[$val]['am']=$excelArr['ת������'][$key];
					$infoE[$val]['type']=1;
				}
			}

			$sql="select
				h.usercard , s.username , h.userlevel , p.id as pid , s.rand_key
				, u.company , u.salarycom
				, s.amount , s.usersta , s.passoldam , s.passdt , h.expflag
				, s.userid
				from salary s
				left join hrms h on ( s.userid=h.user_id )
				left join user u on ( u.user_id=s.userid)
				left join salary_pay p on ( p.pyear='" . $this->nowy . "' and p.pmon='" . $this->nowm . "' and p.userid=s.userid )
				where
				s.userid=h.user_id
				and ( s.usersta='1' or
						( year(s.passdt)='".$this->nowy."' and  month(s.passdt)='".$this->nowm."' )
				    )
				order by s.id
				";
			$query=$this->db->query_exc($sql);
			while($row=$this->db->fetch_array($query)){
				if(array_key_exists($row['usercard'],$infoE)){
					$infoE[$row['usercard']]['type']='0';
					$infoE[$row['usercard']]['userlevel']=$row['userlevel'];
					//$infoE[$row['usercard']]['pid']=$row['pid'];

					$infoE[$row['usercard']]['passoldam']=$row['passoldam'];
					$infoE[$row['usercard']]['amount']=$row['amount'];
					$infoE[$row['usercard']]['usersta']=$row['usersta'];
					$infoE[$row['usercard']]['userid']=$row['userid'];

					$infoE[$row['usercard']]['com']=$row['company'];
					if(!empty($row['salarycom'])){
						$infoE[$row['usercard']]['com']=$row['salarycom'];
					}
					$infoE[$row['usercard']]['sid']=$row['rand_key'];
				}
			}

			if(count($infoE)){
				try {
					$this->db->query("START TRANSACTION");

					foreach($infoE as $key=>$val){
						if($val['type']=='0'){
							$passam=$val['am'];
							$passdt=$val['passdt'];

							if ($val['userlevel'] == 4) {

								$comtable=$this->get_com_sql($val['com']);
								$sql="select
									p.id as pid
									from salary s
									left join ".$comtable."salary_pay p
									on ( p.pyear='" . $this->nowy . "' and p.pmon='" . $this->nowm . "' and p.userid=s.userid )
									where
									s.rand_key='".$val['sid']."'";
								$rescom=$this->db->get_one($sql);
								$val['pid']=$rescom['pid'];

								if($val['usersta']==2){
									$passOldAm=$this->salaryClass->decryptDeal($val['passoldam']);
								}else{
									$passOldAm=$this->salaryClass->decryptDeal($val['amount']);
								}
								//throw new Exception($passOldAm.'-'.$passam.'-'.$passdt.$val['userid']);
								$passNowAm=$this->salaryClass->salaryPass($passOldAm, $passam, $passdt);

								if(date('Y-m',  strtotime($passdt))==date('Y-m')){//����ת��
									$baseNowAm = $passNowAm;
								}else{
									$baseNowAm = 0;
								}

								$this->model_salary_update($val['sid'],
										array('amount' => $passam, 'passam' => $passam, 'usersta' => '2'
											, 'passdt' => $passdt
											, 'passuserdt' => 'now()', 'passuser' => $_SESSION['USER_ID']
											, 'passnowam'=>$passNowAm
											, 'passoldam'=>$passOldAm
										     )
										, array(2, 3, 4,5));
								$this->model_pay_update($val['pid'],
										array('baseam' => $passam, 'basenowam' => $baseNowAm, 'nowamflag' => '2')
										, array(2),$comtable);
								$this->model_pay_stat($val['pid'],$comtable);
							} else {
								$sm=true;
								$this->model_salary_update($val['sid'], array('passdt' => $passdt, 'passuser' => $_SESSION['USER_ID']), array(0, 1));
							}

							$sql="update hrms set join_date='".$passdt."' where user_id='".$val['userid']."' ";
							$this->db->query_exc($sql);
						}
					}

					$this->db->query("COMMIT");
					$this->globalUtil->insertOperateLog('ת������', 'ת������', 'ת������', '�ɹ�');
				} catch (Exception $e) {
					$this->db->query("ROLLBACK");
					$responce->error = un_iconv($e->getMessage());
					$this->globalUtil->insertOperateLog('ת������', 'ת������' , 'ת������', 'ʧ��', $e->getMessage());
				}
			}
		}elseif($hrflag=='spe'){//�۳�����
			if(!in_array('����', $excelFields)||!in_array('Ա����', $excelFields)
					||!in_array('����', $excelFields)||!in_array('�Ƿ��˰', $excelFields)||!in_array('���', $excelFields)||!in_array('��ע', $excelFields))
			{
				throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
			}
			if(count($excelArr)&&!empty($excelArr)){
				$ptyarr=array_flip($this->speType);
				$ctyarr=array_flip($this->accType);
				foreach($excelArr['Ա����'] as $key=>$val ){
					$infoE[$val]['name']=$excelArr['����'][$key];
					$infoE[$val]['pty']=$ptyarr[$excelArr['����'][$key]];
					$infoE[$val]['aty']=$ctyarr[$excelArr['�Ƿ��˰'][$key]];
					$infoE[$val]['amount']=$excelArr['���'][$key];
					$infoE[$val]['remark']=$excelArr['��ע'][$key];
					$infoE[$val]['type']=1;
				}
			}

			$sql="select
				h.usercard , s.username , h.userlevel , s.userid
				from salary s
				left join hrms h on ( s.userid=h.user_id )
				where
				s.userid=h.user_id
				order by s.id
				";
			$query=$this->db->query_exc($sql);
			while($row=$this->db->fetch_array($query)){
				if(array_key_exists($row['usercard'],$infoE)){
					$infoE[$row['usercard']]['type']=0;
					$infoE[$row['usercard']]['userid']=$row['userid'];
					if($infoE[$row['usercard']]['name']!=$row['username']){
						$infoE[$row['usercard']]['type']=3;//���ֲ���
					}
				}
			}
			if(count($infoE)){
				try {
					$this->db->query("START TRANSACTION");

					foreach($infoE as $key=>$val){
						if($val['type']=='0'){
							$spekey=get_rand_key();
							$sql="insert into salary_spe
								( payyear , paymon , amount
								  , payuserid , payuserna ,remark
								  , createdt , creator , spesta ,rand_key , paytype , acctype
								)
								select
								'".$this->nowy."' , '".$this->nowm."' , '".$this->salaryClass->encryptDeal($val['amount'])."'
								, user_id , user_name , '".$val['remark']."'
								, now() , '".$_SESSION['USER_ID']."' , 1 , '".$spekey."' ,'".$val['pty']."','".$val['aty']."'
								from user where user_id='".$val['userid']."' ";
							$this->db->query_exc($sql);
							$sql="select h.userlevel,s.usercom from hrms h inner join salary s on h.user_id = s.userid where h.USER_ID = '".$val['userid']."'";
							$res=$this->db->get_one($sql);
							$flowname = $this->flowName['spe_'.$res['userlevel']];
							if($res['usercom'] == 'xs'){
								$flowname = $this->flowName['spe_xs_'.$res['userlevel']];
							}
							$info=array('flowname'=>$flowname
									,'userid'=>$val['userid']
									,'salarykey'=>$spekey
									,'changeam'=>$this->salaryClass->encryptDeal($val['amount'])
									,'remark'=>$val['remark']
								   );
							$sm[$val]=$this->model_flow_new($info);
						}
					}

					$this->db->query("COMMIT");
					$this->globalUtil->insertOperateLog('��������', '��������', '��������', '�ɹ�');
				} catch (Exception $e) {
					$this->db->query("ROLLBACK");
					$responce->error = un_iconv($e->getMessage());
					$this->globalUtil->insertOperateLog('��������', '��������' , '��������', 'ʧ��', $e->getMessage());
				}
			}
		}

	}catch(Exception $e){
		$responce->error = un_iconv($e->getMessage());
	}
	return $responce;
}
/**
 *���ս�
 */
function model_dp_yeb_xls($ckt,$hrflag='fn'){
	set_time_limit(600);
	$type=$_POST['ctr_type'];
	$manflag=$_GET['manflag'];

	$sqlCk=$type=='com'?'0':'1';
	$str='';
	$infoE=array();
	$ckarr=array(
			1=>array('min'=>18001,'max'=>19283.33)
			,2=>array('min'=>54001,'max'=>60187.5)
			,3=>array('min'=>108001,'max'=>114600)
			,4=>array('min'=>420001,'max'=>447500)
			,5=>array('min'=>660001,'max'=>706538.46)
			,6=>array('min'=>960001,'max'=>1120000)
		    );
	$ckdata=array();
	try{
		$excelfilename='attachment/xls_model/yeb/'.$ckt.".xls";
		if(empty ($_FILES["ctr_file"]["tmp_name"])){
			$str='<tr><td colspan="10">�뵼�����ս�������Ϣ��</td></tr>';
		}elseif (!move_uploaded_file( $_FILES["ctr_file"]["tmp_name"], $excelfilename) ){
			$str='<tr><td colspan="10">�ϴ�ʧ�ܣ�</td></tr>';
		}else{
			//��ȡexcel��Ϣ
			include('includes/classes/excel.php');
			$excel = Excel::getInstance();
			$excel->setFile(WEB_TOR.$excelfilename);
			$excel->Open();
			$excel->setSheet();
			$excelFields = $excel->getFields();
			$excelArr=$excel->getAllData();
			$excel->Close();
			if($manflag=='man'){
				if(!in_array('����', $excelFields)||!in_array('Ա����', $excelFields)
						||!in_array('���ս����', $excelFields)||!in_array('���', $excelFields))
				{
					throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
				}
				if(count($excelArr)&&!empty($excelArr)){
					foreach($excelArr['Ա����'] as $key=>$val ){
						$infoE[$val]['name']=$excelArr['����'][$key];
						$infoE[$val]['am']=$excelArr['���ս����'][$key];
						$infoE[$val]['type']=1;
						$infoE[$val]['nameoa']=$excelArr['����'][$key];
						$infoE[$val]['syear']=$excelArr['���'][$key];
					}
				}
			}else{
				if(!in_array('����', $excelFields)||!in_array('Ա����', $excelFields)
						||!in_array('���ս����', $excelFields))
				{
					throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
				}
				if(count($excelArr)&&!empty($excelArr)){
					foreach($excelArr['Ա����'] as $key=>$val ){
						$infoE[$val]['name']=$excelArr['����'][$key];
						$infoE[$val]['yearam']=$excelArr['���ս����'][$key];
						$infoE[$val]['type']=1;
						$infoE[$val]['nameoa']=$excelArr['����'][$key];
						$infoE[$val]['syear']=$this->yebyear;
						foreach($ckarr as $ckkey=>$ckval){
							if($excelArr['���ս����'][$key]>=$ckval['min']&&$excelArr['���ս����'][$key]<=$ckval['max']){
								$ckdata[$excelArr['����'][$key]]['am']=$excelArr['���ս����'][$key];
								$ckdata[$excelArr['����'][$key]]['min']=$ckval['min'];
								$ckdata[$excelArr['����'][$key]]['max']=$ckval['max'];
							}
						}
					}
				}
			}
			if($hrflag=='hr'){
				$sql="select
					s.oldname as username , s.userid , h.usercard as idcard
					from
					salary s
					left join hrms h on(s.userid=h.user_id)
					where h.userlevel='4' ";
			}else{
				$sql="select
					s.oldname as username , s.userid , h.usercard as idcard
					from
					salary s
					left join hrms h on(s.userid=h.user_id)
					where 1 ";
			}
			$query=$this->db->query_exc($sql);
			while($row=$this->db->fetch_array($query)){
				if(array_key_exists($row['idcard'],$infoE)){
					$infoE[$row['idcard']]['type']=0;
					$infoE[$row['idcard']]['nameoa']=$row['username'];
					if($infoE[$row['idcard']]['name']!=$row['username']){
						$infoE[$row['idcard']]['type']=3;//���ֲ���
					}
				}
			}
			/*
			   $sql="select
			   usercard , syear
			   from salary_yeb  ";
			   $query=$this->db->query_exc($sql);
			   while($row=$this->db->fetch_array($query)){
			   if(array_key_exists($row['usercard'],$infoE)&&$row['syear']==$infoE[$row['usercard']]['syear']){
			   $infoE[$row['usercard']]['type']=2;
			   }
			   }
			 *
			 */
			if(count($infoE)){
				$totalA=array('pro'=>0);
				$i=1;
				foreach($infoE as $key=>$val){
					if(empty($key)){
						continue;
					}
					if($val['type']=='0'){
						$cl='green';
						$rk='';
					}elseif($val['type']=='1'){
						$cl='#ff9900';
						$rk='Ա���Ŵ��������Ա��������ְ';
					}elseif($val['type']=='2'){
						$cl='#ff9900';
						$rk='��Ա�����ս���¼��';
					}elseif($val['type']=='3'){
						$cl='#ff9900';
						$rk='Ա�����ִ�����ȷ��'.$val['nameoa'];
					}
					if($manflag=='man'){
						$str.='<tr style="color:'.$cl.'">
							<td>'.$i.'</td>
							<td>'.$key.'</td>
							<td>'.$val['name'].'</td>
							<td>'.$val['nameoa'].'</td>
							<td>'.$val['am'].'</td>
							<td>'.$val['syear'].'</td>
							<td>'.$rk.'</td>
							</tr>';
					}else{
						$str.='<tr style="color:'.$cl.'">
							<td>'.$i.'</td>
							<td>'.$key.'</td>
							<td>'.$val['name'].'</td>
							<td>'.$val['nameoa'].'</td>
							<td>'.$val['yearam'].'</td>
							<td>'.$rk.'</td>
							</tr>';
					}
					$i++;
				}
			}
		}
	}catch(Exception $e){
		$str='<tr><td colspan="10">�������ݴ���'.$e->getMessage().'</td></tr>';
	}
	if(!empty($ckdata)){
		$str.='<tr><td colspan="10">ä������</td></tr>';
		$str.='<tr style="">
			<td>����</td>
			<td>���ս����</td>
			<td>ä����</td>
			<td>ä��ֹ</td>
			<td> </td>
			<td> </td>
			</tr>';
		foreach($ckdata as $key=>$val){
			$str.='<tr style="">
				<td>'.$key.'</td>
				<td>'.$val['am'].'</td>
				<td>'.$val['min'].'</td>
				<td>'.$val['max'].'</td>
				<td> </td>
				<td> </td>
				</tr>';
		}
	}else{
		$str.='<tr><td colspan="10">��ä������</td></tr>';
	}
	return $str;
}
/**
 * �����ʼ������
 */
function model_dp_yeb_xls_in($hrflag='fn'){
	set_time_limit(600);
	$ckt=$_POST['ckt'];
	$manflag=$_GET['manflag'];
	$excelfilename=WEB_TOR.'attachment/xls_model/yeb/'.$ckt.".xls";

	try{
		if(!file_exists($excelfilename)){
			throw new Exception('File does not exist');
		}
		include('includes/classes/excel.php');
		$excel = Excel::getInstance();
		$excel->setFile($excelfilename);
		$excel->Open();
		$excel->setSheet();
		$excelFields = $excel->getFields();
		$excelArr=$excel->getAllData();
		$excel->Close();
		if($manflag=='man'){
			if(!in_array('����', $excelFields)||!in_array('Ա����', $excelFields)
					||!in_array('���ս����', $excelFields)||!in_array('���', $excelFields))
			{
				throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
			}
			if(count($excelArr)&&!empty($excelArr)){
				foreach($excelArr['Ա����'] as $key=>$val ){
					$infoE[$val]['name']=$excelArr['����'][$key];
					$infoE[$val]['am']=$excelArr['���ս����'][$key];
					$infoE[$val]['type']=1;
					$infoE[$val]['syear']=$excelArr['���'][$key];
				}
			}
		}else{
			if(!in_array('����', $excelFields)||!in_array('Ա����', $excelFields)
					||!in_array('���ս����', $excelFields))
			{
				throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
			}
			if(count($excelArr)&&!empty($excelArr)){
				foreach($excelArr['Ա����'] as $key=>$val ){
					$infoE[$val]['name']=$excelArr['����'][$key];
					$infoE[$val]['yearam']=$excelArr['���ս����'][$key];
					$infoE[$val]['type']=1;
					$infoE[$val]['syear']=$this->yebyear;
				}
			}
		}
		if($hrflag=='hr'){
			//��Ӽ������
			$sql="select
				s.oldname as username , s.userid , h.usercard as idcard ,  p.totalam as amount  , s.cessebase
				,u.dept_id , h.expflag , p.gjjam as gjjam , p.shbam as shbam , u.company , u.salarycom , s.rand_key
				from
				salary s
				left join salary_pay p on (s.userid=p.userid and p.pyear='".$this->lastpy."' and p.pmon='".$this->lastpm."')
				left join user u on(s.userid=u.user_id)
				left join hrms h on(s.userid=h.user_id)
				where h.userlevel='4' ";
		}else{
			$sql="select
				s.oldname as username , s.userid , h.usercard as idcard ,  p.totalam as amount  , s.cessebase
				,u.dept_id , h.expflag , p.gjjam as gjjam , p.shbam as shbam , u.company , u.salarycom , s.rand_key
				from
				salary s
				left join salary_pay p on (s.userid=p.userid and p.pyear='".$this->lastpy."' and p.pmon='".$this->lastpm."')
				left join user u on(s.userid=u.user_id)
				left join hrms h on(s.userid=h.user_id)
				where 1 ";
		}
		$query=$this->db->query_exc($sql);
		while($row=$this->db->fetch_array($query)){
			if(array_key_exists($row['idcard'],$infoE)){
				$sam=$this->salaryClass->decryptDeal($row['amount']);
				$gjjam=$this->salaryClass->decryptDeal($row['gjjam']);
				$shbam=$this->salaryClass->decryptDeal($row['shbam']);
				$infoE[$row['idcard']]['type']=0;
				$infoE[$row['idcard']]['lastmonam']=round($sam-$gjjam-$shbam);
				$infoE[$row['idcard']]['cpb']=round($row['cessebase']);
				$infoE[$row['idcard']]['expflag']=$row['expflag'];
				$infoE[$row['idcard']]['com']=$row['company'];
				if(!empty($row['salarycom'])){
					$infoE[$row['idcard']]['com']=$row['salarycom'];
				}
				$infoE[$row['idcard']]['sid']=$row['rand_key'];
			}
		}
		$sql="select
			usercard , syear , id
			from salary_yeb  where syear='".$this->yebyear."'  ";
		$query=$this->db->query_exc($sql);
		while($row=$this->db->fetch_array($query)){
			if(array_key_exists($row['usercard'],$infoE)&&$row['syear']==$infoE[$row['usercard']]['syear']&&$infoE[$row['usercard']]['type']==0){
				$infoE[$row['usercard']]['type']=2;
				$infoE[$row['usercard']]['yebid']=$row['id'];
			}
		}

		if(count($infoE)){
			try {
				$this->db->query("START TRANSACTION");
				if($manflag=='man'){
					foreach($infoE as $key=>$val){
						if($val['type']=='0'&&!empty($val['lastmonam'])){
							$yearAm=round($val['am'],2);
							$payCesseAm=$this->salaryClass->cesseDealYeb($yearAm, $val['lastmonam'], $val['cpb']);
							$payAm=round($yearAm-$payCesseAm,2);
							$sql="insert into salary_yeb
								(usercard
								 , yearam , lastmonam , paycesseam
								 , payam , sta , syear
								 , inputuser , inputdt  )
								values
								( '".$key."'
								  , '".$this->salaryClass->encryptDeal($yearAm)."'
								  , '".$this->salaryClass->encryptDeal($val['lastmonam'])."'
								  , '".$this->salaryClass->encryptDeal($payCesseAm)."'
								  , '".$this->salaryClass->encryptDeal($payAm)."'
								  , '0', '".$val['syear']."'
								  , '".$_SESSION['USER_ID']."' , now() )";
							$this->db->query_exc($sql);
						}
					}
				}else{
					foreach($infoE as $key=>$val){
						$comtable=$this->get_com_sql($val['com']);
						$sql="select
							p.id as pid , p.totalam as amount , p.gjjam , p.shbam
							from salary s
							left join salary_pay p
							on ( p.pyear='".$this->lastpy."' and p.pmon='".$this->lastpm."' and p.userid=s.userid )
							where
							s.rand_key='".$val['sid']."'";
						$rescom=$this->db->get_one($sql);
						$sam=$this->salaryClass->decryptDeal($rescom['amount']);
						$gjjam=$this->salaryClass->decryptDeal($rescom['gjjam']);
						$shbam=$this->salaryClass->decryptDeal($rescom['shbam']);
						$val['lastmonam']=round($sam-$gjjam-$shbam);

						if($val['type']=='0'){

							if(false){
								$yearAm=round($val['yearam'],2);
								$sql="insert into salary_yeb
									(usercard
									 , yearam
									 , sta , syear
									 , inputuser , inputdt  )
									values
									( '".$key."'
									  , '".$this->salaryClass->encryptDeal($yearAm)."'
									  , '0', '".$val['syear']."'
									  , '".$_SESSION['USER_ID']."' , now() )";
							}else{
								$yearAm=round($val['yearam'],2);
								$payCesseAm=$this->salaryClass->cesseDealYeb($yearAm, $val['lastmonam'], $val['cpb']);
								$payAm=round($yearAm-$payCesseAm,2);
								$sql="insert into salary_yeb
									(usercard
									 , yearam , paycesseam
									 , payam , sta , syear
									 , inputuser , inputdt , realam , com )
									values
									( '".$key."'
									  , '".$this->salaryClass->encryptDeal($yearAm)."'
									  , '".$this->salaryClass->encryptDeal($payCesseAm)."'
									  , '".$this->salaryClass->encryptDeal($payAm)."'
									  , '0', '".$val['syear']."'
									  , '".$_SESSION['USER_ID']."' , now()
									  , '".$this->salaryClass->encryptDeal($val['lastmonam'])."' , '".$val['com']."' )";
							}
							$this->db->query_exc($sql);
						}elseif($val['type']=='2'){
							$yearAm=round($val['yearam'],2);
							$payCesseAm=$this->salaryClass->cesseDealYeb($yearAm, $val['lastmonam'], $val['cpb']);
							$payAm=round($yearAm-$payCesseAm,2);
							$sql="update salary_yeb set
								yearam='".$this->salaryClass->encryptDeal($yearAm)."'
								, paycesseam='".$this->salaryClass->encryptDeal($payCesseAm)."'
								, payam='".$this->salaryClass->encryptDeal($payAm)."'
								, sta='0' , inputuser='".$_SESSION['USER_ID']."' , inputdt=now()
								, realam='".$this->salaryClass->encryptDeal($val['lastmonam'])."'
								where usercard='".$key."' and syear='".$val['syear']."' and id='".$val['yebid']."' ";
							$this->db->query_exc($sql);
						}
					}
				}
				$this->db->query("COMMIT");
				$this->globalUtil->insertOperateLog('���ս�', '���ս�', '���ս�', '�ɹ�');
			} catch (Exception $e) {
				$this->db->query("ROLLBACK");
				$responce->error = un_iconv($e->getMessage());
				$this->globalUtil->insertOperateLog('���ս�', '���ս�' , '���ս�', 'ʧ��', $e->getMessage());
			}
		}
	}catch(Exception $e){
		$responce->error = un_iconv($e->getMessage());
	}
	return $responce;
}


/**
 * ���ս�
 */
function model_dp_yeb_list($sqlflag=''){
	//$this->update_salary_yeb();
	$page = $_GET['page'];
	$limit = $_GET['rows'];
	$sidx = $_GET['sidx'];
	$sord = $_GET['sord'];
	$schOper = $_GET['searchOper'];
	$schStr = $_GET['searchString'];
	$schField = $_GET['searchField'];
	$seay = empty($_GET['seay'])?$this->yebyear:$_GET['seay'];
	$seaname = $_REQUEST['seaname'];
	$seadept = $_REQUEST['seadept'];
	$seaexp = $_GET['seaexp'];
	$manflag = $_GET['manflag'];
	$sqlSch = '';
	if(!empty($seay)){
		$sqlSch.=" and y.syear = '".$seay."' ";
	}
	if(!empty($seaname)){
		$sqlSch.=" and u.user_name like '%".$seaname."%' ";
	}
	if(!empty($seadept)){
		$sqlSch.=" and d.dept_name like '%".$seadept."%' ";
	}
	if ($schOper) {
		$sqlSch .= jqgrid_sopt($schField, $schStr, $schOper);
	}
	$start = $limit * $page - $limit;
	if(empty($sqlflag)){
		//$sqlflag=" and y.inputuser='".$_SESSION['USER_ID']."'";
	}
	if(!empty($seaexp)){
		if($seaexp=='com'){
			$sqlSch.=" and h.expflag = '0' ";
		}elseif($seaexp=='exp'){
			$sqlSch.=" and h.expflag = '1' ";
		}
	}
	//$dppow=$this->model_dp_pow();
	//���� and s.floatam!='0' and s.floatam!='".$this->zero."'
	$sql = "select count(*)
		from salary_yeb y
		left join hrms h on (y.usercard=h.usercard)
		left join user u on (u.user_id=h.user_id)
		left join department d on (u.dept_id=d.dept_id)
		left join salary s on (u.user_id = s.userid)
		where y.id is not null
		$sqlflag
		$sqlSch ";
	$rs = $this->db->get_one($sql);
	$count = $rs['count(*)'];
	if ($count > 0) {
		$total_pages = ceil($count / $limit);
	} else {
		$total_pages = 0;
	}
	if ($page > $total_pages){
		$page = $total_pages;
	}
	$i = 0;
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
	$sql="select y.rand_key , y.usercard , u.user_name as username , d.dept_name as deptname
		, y.yearaveam , y.mons , y.yearam , y.sta , y.changeremark , y.syear
		, y.paycesseam , y.payam , h.expflag , y.com, s.usersta
		from salary_yeb y
		left join hrms h on (y.usercard=h.usercard)
		left join user u on (u.user_id=h.user_id)
		left join department d on (u.dept_id=d.dept_id)
		left join salary s on (u.user_id = s.userid)
		where y.id is not null
		$sqlflag
		$sqlSch
		order by y.id , $sidx $sord
		limit $start , $limit ";
	$query = $this->db->query($sql);
	if($manflag=='man'){
		while ($row = $this->db->fetch_array($query)) {
			$responce->rows[$i]['id'] = $row['rand_key'];
			$responce->rows[$i]['cell'] = un_iconv(
					array("", $row['rand_key']
						, $row['usercard']
						, $row['username']
						, $row['deptname']
						, $this->salaryClass->decryptDeal($row['yearam'])
						, $row['syear']
						, $row['changeremark']
					     )
					);
			$i++;
		}
	}else{
		while ($row = $this->db->fetch_array($query)) {
			$responce->rows[$i]['id'] = $row['rand_key'];
			$responce->rows[$i]['cell'] = un_iconv(
					array("", $row['rand_key']
						, $this->salaryCom[$row['com']]
						, $row['usercard']
						, $row['username']
						, $this->userSta[$row['usersta']]
						, $row['deptname']
						, $this->expflag[$row['expflag']]
						, $this->salaryClass->finiView($this->salaryClass->decryptDeal($row['yearaveam']))
						, $this->salaryClass->finiView($this->salaryClass->decryptDeal($row['mons']))
						, $this->salaryClass->finiView($this->salaryClass->decryptDeal($row['yearam']))
						, $this->salaryClass->finiView($this->salaryClass->decryptDeal($row['paycesseam']))
						, $this->salaryClass->finiView($this->salaryClass->decryptDeal($row['payam']))
						, $row['syear']
						, $row['changeremark']
					     )
					);
			$i++;
		}
	}
	return $responce;
}
/**
 * ���ս��޸�
 */
function model_fn_yeb_edit(){
	$key = $_POST['key'];
	$am  = $_POST['am'];
	$rmk = $_POST['rmk'];
	try{
		$sql="select
			y.rand_key , s.amount as lastmonam , s.cessebase , y.realam
			from salary_yeb y
			left join hrms h on (y.usercard = h.usercard)
			left join salary s on (h.user_id = s.userid)
			where y.rand_key ='".$key."' ";
		$res=$this->db->get_one($sql);
		if(empty($res)){
			throw new Exception('checked false');
		}
		$realam=$this->salaryClass->decryptDeal($res['realam']);
		$yearAm=round($am,2);
		$payCesseAm=$this->salaryClass->cesseDealYeb($yearAm, $realam, $res['cessebase']);
		$payAm=round($yearAm-$payCesseAm,2);
		$sql=" update salary_yeb
			set yearam='".$this->salaryClass->encryptDeal($yearAm)."'
			,paycesseam='".$this->salaryClass->encryptDeal($payCesseAm)."'
			,payam='".$this->salaryClass->encryptDeal($payAm)."'
			,changeremark ='".$rmk."'
			where rand_key = '".$key."' ";
		$this->db->query_exc($sql);
	}catch(Exception $e){
		echo $e->getMessage();
	}
	echo '1';
}
function model_fn_yeb_list(){
	//$this->update_salary_yeb();
	$page = $_GET['page'];
	$limit = $_GET['rows'];
	$sidx = $_GET['sidx'];
	$sord = $_GET['sord'];
	$schOper = $_GET['searchOper'];
	$schStr = $_GET['searchString'];
	$schField = $_GET['searchField'];
	$comflag=$_GET['comflag'];
	$seay = empty($_GET['seay'])?$this->yebyear:$_GET['seay'];
	$seaname = $_REQUEST['seaname'];
	$seadept = $_REQUEST['seadept'];
	$manflag=$_GET['manflag'];
	global $func_limit;
	$sqlSch = " and y.com in( '".str_replace(',',"','",$func_limit['�ӹ�˾'])."' )" ;
	if(!empty($seay)){
		$sqlSch.=" and y.syear = '".$seay."' ";
	}
	if(!empty($seaname)){
		$sqlSch.=" and u.user_name like '%".$seaname."%' ";
	}
	if(!empty($seadept)){
		$sqlSch.=" and d.dept_name like '%".$seadept."%' ";
	}
	if(!empty($comflag)){
		if($comflag=='com'){
			$sqlSch.=" and h.expflag = '0' ";
		}elseif($comflag=='exp'){
			$sqlSch.=" and h.expflag = '1' ";
		}
	}
	if ($schOper) {
		$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
	}
	$start = $limit * $page - $limit;
	//$dppow=$this->model_dp_pow();
	//���� and s.floatam!='0' and s.floatam!='".$this->zero."'
	$sql = "select count(*)
		from salary_yeb y
		left join hrms h on (y.usercard=h.usercard)
		left join user u on (u.user_id=h.user_id)
		left join department d on (u.dept_id=d.dept_id)
		left join salary s on (u.user_id=s.userid)
		where
		s.usersta!=3
		$sqlSch ";
	$rs = $this->db->get_one($sql);
	$count = $rs['count(*)'];
	if ($count > 0) {
		$total_pages = ceil($count / $limit);
	} else {
		$total_pages = 0;
	}
	if ($page > $total_pages){
		$page = $total_pages;
	}
	$i = 0;
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
	$sql="select y.rand_key , y.usercard , u.user_name as username , s.olddept as deptname
		, y.yearaveam , y.mons , y.yearam , y.sta , y.changeremark , y.syear , y.payam , y.paycesseam
		, s.acc , s.accbank , s.email , s.idcard
		from salary_yeb y
		left join hrms h on (y.usercard=h.usercard)
		left join user u on (u.user_id=h.user_id)
		left join department d on (u.dept_id=d.dept_id)
		left join salary s on (u.user_id=s.userid)
		where
		s.usersta!=3
		$sqlSch
		order by  y.id , $sidx $sord
		limit $start , $limit ";
	$query = $this->db->query($sql);
	while ($row = $this->db->fetch_array($query)) {
		$responce->rows[$i]['id'] = $row['rand_key'];
		$responce->rows[$i]['cell'] = un_iconv(
				array("", $row['rand_key']
					, $row['usercard']
					, $row['username']
					, $row['deptname']
					, $row['syear']
					, $this->salaryClass->finiView($this->salaryClass->decryptDeal($row['yearam']))
					, $this->salaryClass->finiView($this->salaryClass->decryptDeal($row['paycesseam']))
					, $this->salaryClass->finiView($this->salaryClass->decryptDeal($row['payam']))
					, $row['idcard']
					, $row['acc']
					, $row['accbank']
					, $row['email']
				     )
				);
		$i++;
	}
	return $responce;
}
/**
 * ����
 */
function model_yeb_update(){
	/*
	   if( strtotime(date('Y-m-d')) < strtotime('2012-01-25') ){
	   $dataArr=array();
	   $sql=" select
	   y.rand_key , y.yearam
	   , y.realam , s.amount , s.gjjam , s.shbam , s.cessebase
	   from salary_yeb y
	   left join hrms h on (y.usercard = h.usercard )
	   left join salary s on (h.user_id = s.userid )
	   where s.usersta!='3' and h.expflag='0' ";
	   $query=$this->db->query($sql);
	   while($row=$this->db->fetch_array($query)){
	   $ram=$this->salaryClass->decryptDeal($row['realam']);
	   $sam=$this->salaryClass->decryptDeal($row['amount']);
	   $gjj=$this->salaryClass->decryptDeal($row['gjjam']);
	   $shb=$this->salaryClass->decryptDeal($row['shbam']);
	   if(round($ram,2)!=round($sam-$gjj-$shb,2)){
	   $dataArr[$row['rand_key']]['yearam']=$this->salaryClass->decryptDeal($row['yearam']);
	   $dataArr[$row['rand_key']]['amount']=$sam;
	   $dataArr[$row['rand_key']]['gjjam']=$gjj;
	   $dataArr[$row['rand_key']]['shbam']=$shb;
	   $dataArr[$row['rand_key']]['cessebase']=$row['cessebase'];
	   }
	   }
	   if(!empty($dataArr)){
	   foreach($dataArr as $key=>$val){
	   $nowam=round($val['amount']-$val['gjjam']-$val['shbam'],2);
	   $paycesseam=$this->salaryClass->cesseDealYeb($val['yearam'] , $nowam , $val['cessebase']);
	   $payam=round($val['yearam']-$paycesseam,2);
	   $sql="update salary_yeb set
	   paycesseam='".$this->salaryClass->encryptDeal($paycesseam)."'
	   , payam ='".$this->salaryClass->encryptDeal($payam)."'
	   , realam='".$this->salaryClass->encryptDeal($nowam)."'
	   where rand_key='".$key."' ";
	   $this->db->query($sql);
	   }
	   }
	   }
	 *
	 */
}
/**
 * ����
 */
function model_fn_yeb_xls($flag='com'){
	set_time_limit(600);
	$xls=new includes_class_excelout('gb2312', true, 'My Test Sheet');
	$sqlstr="";
	$step=$_GET['step'];
	global $func_limit;
	if($flag=='com'){
		if($step=='1'){
			$data = array(1=> array ('���', '���', '����', '����'
						,'���ս����'
						,'����˰��','ʵ�����'
						,'�ʺ�','����','���֤��','������'));
			$xls->setStyle(array(4,5,6));
		}elseif ($step=="2") {
			$data = array(1=>array('���֤�����','���֤������','��˰������','������Ŀ'
						,'������Ŀ��Ŀ','���������ڼ䣨��','���������ڼ䣨ֹ��','����','�����걨�����:���'
						,'���涨�۳���Ŀ:��ᱣ�շ�','���涨�۳���Ŀ:ס��������','�����������ö�','˰�����ʽ'));
			$xls->setStyle(array(8,9,10,11,12));
		}elseif ($step=="3") {
			$data = array(1=>array('���','���','�տ�������','�տ��ʺ�','�տ�������','�տ��˵�ַ'
						,'�տ����ʻ�����','�ʽ���;','����','�෽Э���'));
			$xls->setStyle(array(1));
		}elseif ($step=="4") {
			$data = array(1=>array('����','�����ս��ϼ�','����˰��','ʵ�����'));
			$xls->setStyle(array(1,2,3,4,5));
		}
		$sqlstr.=" and h.expflag='0' and y.com in( '".str_replace(',',"','",$func_limit['�ӹ�˾'])."' ) ";
	}elseif($flag=='exp'){
		$data = array(1=> array ('���', '���', '����', '����'
					,'���ս�˰ǰ���','����˰��','���ս�˰����'
					,'�ʺ�','����','���֤��','������'));
		$xls->setStyle(array(4,5,6));
		$sqlstr.=" and h.expflag='1' ";
	}elseif($flag=='hr'){
		$data = array(1=> array ('���', '���','��˾','Ա��״̬','Ա������','Ա����', '����', '����'
					,'���ս����','����˰��','���ս�˰����'
					,'�ʺ�','����','���֤��','������'));
		$xls->setStyle(array(6,7,8));
		$sqlstr.=" and h.userlevel='4' ";
	}elseif($flag=='dao'){
		$data = array(1=> array ('���', '���','��˾','Ա��״̬','Ա������','Ա����', '����', '����'
					,'���ս����','����˰��','���ս�˰����'
					,'�ʺ�','����','���֤��','������'));
		$xls->setStyle(array(6,7,8));
	}elseif($flag=='email'){
		$sqlstr.=" and h.expflag='0' and y.com in( '".str_replace(',',"','",$func_limit['�ӹ�˾'])."' ) ";
	}else{
		$sqlstr.=" and h.expflag='0' and y.com in( '".str_replace(',',"','",$func_limit['�ӹ�˾'])."' ) ";
	}
	if($flag!='email'&&$flag!='hr'){
		$sqlstr.="  ";
	}
	if( $flag=='hr' || $flag=='dao' ){
		$sqlstr.="  ";
	}else{
		$sqlstr.=" and s.usersta!=3";
	}
	$sql="select
		y.syear , s.oldname , d.dept_name as olddept , y.yearam
		, s.amount , y.paycesseam , y.payam
		, s.acc , s.email , s.idcard , s.accbank
		, d.dept_name  , s.cessebase , h.usercard , y.com , h.expflag , s.usersta
		from salary_yeb y
		left join hrms h on (y.usercard = h.usercard)
		left join salary s on (h.user_id = s.userid )
		left join user u on (u.user_id=h.user_id)
		left join department d on (u.dept_id=d.dept_id)
		where y.syear='".$this->yebyear."'
		$sqlstr
		order by y.id
		";
	$query=$this->db->query($sql);
	$i=0;
	if($flag=='com'){
		if($step=='1'){
			while($row=$this->db->fetch_array($query)){
				$i++;
				$data[]=array($i,
						$row['syear'], $row['oldname'], $row['olddept']
						, $this->salaryClass->decryptDeal($row['yearam'])
						, $this->salaryClass->decryptDeal($row['paycesseam'])
						, $this->salaryClass->decryptDeal($row['payam'])
						, $row['acc'], $row['email'], $row['idcard'], $row['accbank']
					     );
			}
		}elseif($step=="2"){
			while($row=$this->db->fetch_array($query)){
				$data[]=array('', $row["idcard"],$row["oldname"],'',
						'���ս�н��',
						'',
						'',
						$row["olddept"],
						$this->salaryClass->decryptDeal($row["yearam"]),
						'',
						'',
						$row["cessebase"],
						'');
			}
		}elseif($step=="3"){
			$x=0;
			while($row=$this->db->fetch_array($query)){
				$x++;
				$data[]=array($x,
						$this->salaryClass->decryptDeal($row["payam"]),
						$row["accbank"],
						$row["acc"],
						$row["oldname"],
						'',
						'',
						'',
						'',
						'');
			}
		}elseif($step=="4"){
			$deptArr=array();
			while($row=$this->db->fetch_array($query)){
				$deptArr[$row['olddept']]['yearam']=isset($deptArr[$row['olddept']]['yearam'])?round($deptArr[$row['olddept']]['yearam']+$this->salaryClass->decryptDeal($row['yearam']),2):$this->salaryClass->decryptDeal($row['yearam']);
				$deptArr[$row['olddept']]['paycesseam']=isset($deptArr[$row['olddept']]['paycesseam'])?round($deptArr[$row['olddept']]['paycesseam']+$this->salaryClass->decryptDeal($row['paycesseam']),2):$this->salaryClass->decryptDeal($row['paycesseam']);
				$deptArr[$row['olddept']]['payam']=isset($deptArr[$row['olddept']]['payam'])?round($deptArr[$row['olddept']]['payam']+$this->salaryClass->decryptDeal($row['payam']),2):$this->salaryClass->decryptDeal($row['payam']);
			}
			foreach ($deptArr as $key=>$val) {
				$data[]=array($key,
						$val['yearam'],
						$val['paycesseam'],
						$val['payam']
					     );
			}
			$deptArr=array();
			$sql="select t.name
				, y.yearam
				, y.paycesseam as pcam
				, y.payam
				from
				salary_yeb y
				left join hrms h on (y.usercard=h.usercard)
				left join salary s on (h.user_id = s.userid )
				left join salary_user_type t on ( find_in_set(s.userid ,t.members)>0 )
				where t.type='pro'
				and y.syear='".$this->yebyear."' and s.usersta!=3
				$sqlStr ";
			$query=$this->db->query($sql);
			while($row=$this->db->fetch_array($query)){
				$deptArr[$row['name']]['yearam']=isset($deptArr[$row['name']]['yearam'])?round($deptArr[$row['name']]['yearam']+$this->salaryClass->decryptDeal($row['yearam']),2):$this->salaryClass->decryptDeal($row['yearam']);
				$deptArr[$row['name']]['pcam']=isset($deptArr[$row['name']]['pcam'])?round($deptArr[$row['name']]['pcam']+$this->salaryClass->decryptDeal($row['pcam']),2):$this->salaryClass->decryptDeal($row['pcam']);
				$deptArr[$row['name']]['payam']=isset($deptArr[$row['name']]['payam'])?round($deptArr[$row['name']]['payam']+$this->salaryClass->decryptDeal($row['payam']),2):$this->salaryClass->decryptDeal($row['payam']);
			}
			if(!empty($deptArr)){
				$data[] = array();
				$data[] = array('��Ŀ��','�����ս��ϼ�','����˰��','ʵ�����');
				foreach ($deptArr as $key=>$val) {
					$data[]=array($key,
							$val['yearam'],
							$val['pcam'],
							$val['payam']
						     );
				}
			}
		}
		$xls->addArray($data);
		$xls->generateXML('yeb'.'-'.time());
	}elseif($flag=='exp'){
		while($row=$this->db->fetch_array($query)){
			$i++;
			$data[]=array($i,
					$row['syear'], $row['oldname'], $row['olddept']
					, $this->salaryClass->decryptDeal($row['yearam'])
					, $this->salaryClass->decryptDeal($row['paycesseam'])
					, $this->salaryClass->decryptDeal($row['payam'])
					, $row['acc'], $row['email'], $row['idcard'], $row['accbank']
				     );
		}
		$xls->addArray($data);
		$xls->generateXML('yeb'.'-'.time());
	}elseif($flag=='hr'||$flag=='dao'){
		while($row=$this->db->fetch_array($query)){
			$i++;
			$data[]=array($i,$row['syear'],$this->salaryCom[$row['com']]
					, $this->userSta[$row['usersta']]
					,$this->expflag[$row['expflag']],$row['usercard']
					, $row['oldname'], $row['olddept']
					, $this->salaryClass->decryptDeal($row['yearam'])
					, $this->salaryClass->decryptDeal($row['paycesseam'])
					, $this->salaryClass->decryptDeal($row['payam'])
					, $row['acc'], $row['email'], $row['idcard'], $row['accbank']
				     );
		}
		$xls->addArray($data);
		$xls->generateXML('yeb'.'-'.time());
	}elseif($flag=='email'){
		while($row=$this->db->fetch_array($query)){
			$email[]=array(
					'���'=>$row['syear']
					,'����'=>$row['oldname']
					,'����'=>$row['dept_name']
					,'���ս����'=>$this->salaryClass->decryptDeal($row['yearam'])
					,'����˰��'=>$this->salaryClass->decryptDeal($row['paycesseam'])
					,'ʵ�����'=>$this->salaryClass->decryptDeal($row['payam'])
					,'����'=>$row['email']
				      );
		}
		foreach($email as $val){
			$str="���ã��������ս��ѷ��ţ��������������պ���գ�<br/>";
			$strTR="";
			foreach ($val as $vkey=>$vval){
				if($vkey!='����'){
					//if(is_numeric($vval)&&$vval<0){
					// $vval=0;
					//}
					$strTR.="<tr><td>$vkey</td>";
					$strTR.="<td>$vval</td></tr>";
				}
			}
			$str.="<table border='1' cellspacing='1' cellpadding='1'>$strTR</table>";
			$this->model_send_email("���ս���Ϣ",$str,$val["����"],true,true);
		}
		return '1';
	}
}
/**
 * ���ս�����
 */
function model_dp_yeb_rep(){
	global $func_limit;
	if($func_limit['���ս�����']=='1'){
		$seay=isset($_GET['seay'])?$_GET['seay']:$this->yebyear;
		$res='';
		$data=array();
		$total=array();
		$sql="select
			y.yearam , d1.dept_name as deptname , h.userlevel
			from salary_yeb y
			left join hrms h on (y.usercard = h.usercard)
			left join user u on (h.user_id = u.user_id)
			left join salary s on (u.user_id=s.userid)
			left join department d on (d.dept_id=u.dept_id)
			left join department d1 on (d1.depart_x= left(d.depart_x,2))
			where y.id is not null
			and d.dept_id=u.dept_id
			and y.syear='".$seay."' ";
		$query=$this->db->query($sql);
		$i=0;
		while($row=$this->db->fetch_array($query)){
			$tul=$row['userlevel']=='4'?'0':'1';
			if(empty($data[$row['deptname']][$tul])){
				$data[$row['deptname']][$tul]=$this->salaryClass->decryptDeal($row['yearam']);
			}else{
				$data[$row['deptname']][$tul]=round($data[$row['deptname']][$tul]+$this->salaryClass->decryptDeal($row['yearam']));
			}
			if(empty($total)){
				$total[$tul]=$this->salaryClass->decryptDeal($row['yearam']);
			}else{
				$total[$tul]=round($total[$tul]+$this->salaryClass->decryptDeal($row['yearam']));
			}
		}
		foreach($data as $key=>$val){
			$i++;
			if ($i % 2 == 0) {
				$res.='<tr style="background: #F3F3F3;">';
			} else {
				$res.='<tr style="background: #FFFFFF;">';
			}
			$res.='<td algin>'.$key.'</td>';
			$res.='<td>'.num_to_maney_format(array_sum($val)).'</td>';
			$res.='<td>'.num_to_maney_format($val['1']).'</td>';
			$res.='<td>'.num_to_maney_format($val['0']).'</td>';
			$res.='</tr>';
		}
		if ($i % 2 == 0) {
			$res.='<tr style="background: #F3F3F3;">';
		} else {
			$res.='<tr style="background: #FFFFFF;">';
		}
		$res.='<td style="color:red">�ϼ�</td>';
		$res.='<td>'.num_to_maney_format(array_sum($total)).'</td>';
		$res.='<td>'.num_to_maney_format($total['1']).'</td>';
		$res.='<td>'.num_to_maney_format($total['0']).'</td>';
		$res.='</tr>';
		return $res;
	}else{
		return '';
	}
}
/**
 * ���Ƚ�
 */
function model_dp_fla_list(){
	$page = $_GET['page'];
	$limit = $_GET['rows'];
	$sidx = $_GET['sidx'];
	$sord = $_GET['sord'];
	$schOper = $_GET['searchOper'];
	$schStr = $_GET['searchString'];
	$schField = $_GET['searchField'];
	$sqlSch = '';
	if ($schOper) {
		$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
	}
	$start = $limit * $page - $limit;
	$dppow=$this->model_dp_pow();
	//���� and s.floatam!='0' and s.floatam!='".$this->zero."'
	$sql = "select count(*)
		from salary_flow f
		left join salary s on (f.userid=s.userid)
		left join user u on (s.userid=u.user_id)
		where
		f.flowname='".$this->flowName['fla']."'
		and u.dept_id in ('".  implode("','", $dppow['1'])."')
		$sqlSch ";
	$rs = $this->db->get_one($sql);
	$count = $rs['count(*)'];
	if ($count > 0) {
		$total_pages = ceil($count / $limit);
	} else {
		$total_pages = 0;
	}
	if ($page > $total_pages){
		$page = $total_pages;
	}
	$i = 0;
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
	$sql="select f.rand_key , u.user_name as username , d.dept_name as deptname , f.salarykey , f.changeam , f.remark
		, f.sta  , month(f.createdt) as fmon
		from salary_flow f
		left join salary s on (f.userid=s.userid)
		left join user u on (s.userid=u.user_id)
		left join department d on (d.dept_id=u.dept_id)
		where
		f.flowname='".$this->flowName['fla']."'
		and u.dept_id in ('".  implode("','", $dppow['1'])."')
		$sqlSch
		order by  $sidx $sord
		limit $start , $limit ";
	$query = $this->db->query($sql);
	while ($row = $this->db->fetch_array($query)) {
		$amount=$this->salaryClass->decryptDeal($row['salarykey']);
		$floatam=$this->salaryClass->decryptDeal($row['changeam']);
		$smon=(ceil($row['fmon']/3)-1);
		if($smon==0){
			$smon=4;
		}
		$pre=$row['remark'];
		$responce->rows[$i]['id'] = $row['rand_key'];
		$responce->rows[$i]['cell'] = un_iconv(
				array("", $row['rand_key']
					, $row['username']
					, $row['deptname']
					, $amount
					, $pre
					, $floatam
					, $smon
					, $this->flowSta[$row['sta']]
				     )
				);
		$i++;
	}
	return $responce;
}
/**
 * ���Ƚ�
 */
function model_dp_fla_new_in(){
	$id = $_POST['id'];
	$sub= $_POST['sub'];
	$pes= $_POST['pes'];
	$sm=false;
	try {
		$this->db->query("START TRANSACTION");
		if($sub=='new'){
			if(!$id||!trim($id)){
				throw new Exception('no user id');
			}
			if(!$_SESSION['USER_ID']){
				throw new Exception('time out');
			}
			$tmpua=explode(',', trim($id,','));
			$tmpy=$this->nowy;
			$tmpm=(ceil($this->nowm/3)-1)*3;
			if($tmpm==0){
				$tmpy=$tmpy-1;
				$tmpm=12;
			}
			$sql="select s.userid , s.amount , p.baseam
				from
				salary s
				left join salary_pay p
				on (s.userid=p.userid and p.pyear='".$tmpy."' and p.pmon='".$tmpm."' )
				where
				s.userid in ('".implode("','", $tmpua)."')";
			$query=$this->db->query($sql);
			$tmpua=array();
			while($row=$this->db->fetch_array($query)){
				$baseam=$this->salaryClass->decryptDeal($row['baseam']);
				$amount=$this->salaryClass->decryptDeal($row['amount']);
				if(empty($baseam)||empty($row['baseam'])){
					$tmpua[$row['userid']]=$amount;
				}else{
					$tmpua[$row['userid']]=$baseam;
				}
			}
			if(!empty($tmpua)){
				foreach($tmpua as $key=>$val){
					if(empty($val)||empty($key)){
						continue;
					}
					$pesam=ceil($val/100*$pes);
					$info=array('flowname'=>$this->flowName['fla']
							,'userid'=>$key
							,'salarykey'=>$this->salaryClass->encryptDeal($val)
							,'changeam'=>$this->salaryClass->encryptDeal($pesam)
							,'remark'=>$pes
						   );
					$sm[$val]=$this->model_flow_new($info,true,true);
				}
			}
		}elseif($sub=='edit'){
			$sql="select s.userid , p.id , s.sdymeal , s.sdyother , p.sdyam , p.otheram
				from salary_sdy s
				left join salary_pay p on ( s.userid=p.userid and s.pyear=p.pyear and s.pmon=p.pmon )
				where s.rand_key='".$id."' ";
			$res=$this->db->get_one($sql);
			if(empty($res)||!$res['userid']||!$res['id']){
				throw new Exception('Data error');
			}
			$oldMeal=$this->salaryClass->decryptDeal($res['sdymeal']);
			$oldOther=$this->salaryClass->decryptDeal($res['sdyother']);
			$paySdy=$this->salaryClass->decryptDeal($res['sdyam']);
			$payOther=$this->salaryClass->decryptDeal($res['otheram']);
			$sql="update salary_sdy
				set sdymeal='".$this->salaryClass->encryptDeal($meal)."'
				, sdyother='".$this->salaryClass->encryptDeal($other)."'
				, createdt=now()
				, remark ='".$remark."'
				where rand_key='".$id."' ";
			$this->db->query_exc($sql);
			$this->model_pay_update($res['id'],
					array('sdyam'=>ceil($paySdy-$oldMeal+$meal),'otheram'=>ceil($payOther-$oldOther+$other),'remark'=>$remark)
					,array(2)
					);
			$this->model_pay_stat($res['id']);
		}elseif($sub=='del'){
			$sql="select s.userid , p.id , s.sdymeal , s.sdyother , p.sdyam , p.otheram
				from salary_sdy s
				left join salary_pay p on ( s.userid=p.userid and s.pyear=p.pyear and s.pmon=p.pmon )
				where s.rand_key='".$id."' ";
			$res=$this->db->get_one($sql);
			if(empty($res)||!$res['userid']||!$res['id']){
				throw new Exception('Data error');
			}
			$oldMeal=$this->salaryClass->decryptDeal($res['sdymeal']);
			$oldOther=$this->salaryClass->decryptDeal($res['sdyother']);
			$paySdy=$this->salaryClass->decryptDeal($res['sdyam']);
			$payOther=$this->salaryClass->decryptDeal($res['otheram']);

			$sql="delete from  salary_sdy where rand_key='".$id."' ";
			$this->db->query_exc($sql);
			$this->model_pay_update($res['id'],
					array('sdyam'=>ceil($paySdy-$oldMeal),'otheram'=>ceil($payOther-$oldOther),'remark'=>$remark)
					,array(2)
					);
			$this->model_pay_stat($res['id']);
		}elseif($sub=='xls'){
			$temparr=array();
			$sql="select
				s.userid , p.id , s.sdymeal , s.sdyother , s.rand_key , p.sdyam , p.otheram
				from salary_sdy s
				left join salary_pay p on ( s.userid=p.userid and s.pyear=p.pyear and s.pmon=p.pmon )
				where
				s.creator='".$_SESSION['USER_ID']."'
				and s.pyear='".$this->nowy."' and s.pmon='".$this->nowm."'
				and s.staflag='1' ";
			$query=$this->db->query($sql);
			while($row=$this->db->fetch_array($query)){
				$temparr[$row['rand_key']]['userid']=$row['userid'];
				$temparr[$row['rand_key']]['id']=$row['id'];
				$temparr[$row['rand_key']]['sdymeal']=$this->salaryClass->decryptDeal($row['sdymeal']);
				$temparr[$row['rand_key']]['sdyother']=$this->salaryClass->decryptDeal($row['sdyother']);
				$temparr[$row['rand_key']]['sdyam']=$this->salaryClass->decryptDeal($row['sdyam']);
				$temparr[$row['rand_key']]['otheram']=$this->salaryClass->decryptDeal($row['otheram']);
			}
			if(!empty($temparr)){
				foreach($temparr as $key=>$val){
					if(empty($val)||empty($key)){
						continue;
					}
					$sql="update salary_sdy set staflag='0' where rand_key='".$key."'";
					$this->db->query_exc($sql);
					$this->model_pay_update($val['id'],
							array('sdyam'=>ceil($val['sdymeal']+$val['sdyam']),'otheram'=>ceil($val['sdyother']+$val['otheram']),'remark'=>$remark)
							,array(2)
							);
					$this->model_pay_stat($val['id']);
				}
			}
		}
		$this->db->query("COMMIT");
		$responce->id = $id;
		$this->globalUtil->insertOperateLog('���ʹ���', $id, '����', '�ɹ�');
	} catch (Exception $e) {
		$this->db->query("ROLLBACK");
		$responce->error = $e->getMessage();
		$this->globalUtil->insertOperateLog('���ʹ���', $id, '����', 'ʧ��', $e->getMessage());
	}
	return $responce;
}
/**
 * ��Ŀ��
 */
function model_dp_pro_in(){
	$id = $_POST['id'];
	$sub= $_POST['sub'];
	$amount=$_POST['amount'];
	$remark=$_POST['remark'];
	$proname=$_POST['proname'];
	$prono=$_POST['prono'];
	$sm=false;
	try {
		$this->db->query("START TRANSACTION");
		if($sub=='new'){
			if(!$id||!trim($id)){
				throw new Exception('no user id');
			}
			if(!$_SESSION['USER_ID']){
				throw new Exception('time out');
			}
			$tmpua=explode(',', $id);
			$sql="select h.userlevel , h.user_id,s.usercom from hrms h inner join salary s on h.user_id = s.userid where user_id in ('".implode("','", $tmpua)."')";
			$query=$this->db->query($sql);
			$tmpua=array();
			while($row=$this->db->fetch_array($query)){
				$tmpua[$row['user_id']]['userlevel']=$row['userlevel'];
				$tmpua[$row['user_id']]['usercom']=$row['usercom'];
			}
			if(count($tmpua)){
				foreach($tmpua as $key=>$val){
					if(!$val['userlevel']||$val['userlevel']==''){
						continue;
					}
					$flowname = $this->flowName['pro_'.$val['userlevel']];
					if($val['usercom'] == 'xs') {
						$flowname = $this->flowName['pro_xs_'.$val['userlevel']];
					}
					$info=array('flowname'=> $flowname
							,'userid'=>$key
							,'salarykey'=>''
							,'changeam'=>$this->salaryClass->encryptDeal($amount)
							,'remark'=>$remark
							,'proname'=>$proname
							,'prono'=>$prono
						   );
					$sm[$key]=$this->model_flow_new($info,true,false);
				}
			}
		}
		$this->db->query("COMMIT");
		if(is_array($sm)){
			if(count($sm)){
				foreach($sm as $val){
					$body='���ã�<br>
						��������-��Ŀ������Ҫ����������<br>
						лл��';
					$this->model_send_email('����--��Ŀ��', $body, $val, false);
				}
			}
		}elseif($sm){
			$body='���ã�<br>
				��������-��Ŀ������Ҫ����������<br>
				лл��';
			$this->model_send_email('����--��Ŀ��', $body, $sm, false);
		}
		$responce->id = $id;
		$this->globalUtil->insertOperateLog('���ʹ���', $id, '��Ŀ��', '�ɹ�');
	} catch (Exception $e) {
		$this->db->query("ROLLBACK");
		$responce->error = $e->getMessage();
		$this->globalUtil->insertOperateLog('���ʹ���', $id, '��Ŀ��', 'ʧ��', $e->getMessage());
	}
	return $responce;
}
/**
 *����ͨ��
 * @param type $type ����
 * @param type $ckt ʱ��
 */
function model_dao_xls($type,$ckt,$act='xls'){
	set_time_limit(600);
	$sqlCk=$type=='com'?'0':'1';
	$str='';
	$infoE=array();
	$typediv=array(
			'hr_div'=>'temp/'
			,'hr_ext'=>'temp/'
		      );
	$ck=false;//�Ƿ�ִ��
	try{
		$excelfilename='attachment/xls_model/'.$typediv[$type].$ckt.".xls";
		if($act=='xls'){
			if(empty ($_FILES["ctr_file"]["tmp_name"])){
				$str='<tr><td colspan="30">�뵼�����ݱ�</td></tr>';
			}elseif (!move_uploaded_file( $_FILES["ctr_file"]["tmp_name"], $excelfilename) ){
				$str='<tr><td colspan="30">�ϴ�ʧ�ܣ�</td></tr>';
			}else{
				$ck=true;
				$excelfilename=WEB_TOR.$excelfilename;
			}
		}elseif($act=='in'){
			$excelfilename=WEB_TOR.$excelfilename;
			if(!file_exists($excelfilename)){
				throw new Exception('File does not exist');
			}else{
				$ck=true;
			}
		}
		if($ck){
			//��ȡexcel��Ϣ
			include('includes/classes/excel.php');
			$excel = Excel::getInstance();
			$excel->setFile($excelfilename);
			$excel->Open();
			$excel->setSheet();
			$excelFields = $excel->getFields();
			$excelArr=$excel->getAllData();
			$excel->Close();
			if($type=='hr_div'){
				$ckdt=true;
				$tempt='';
				//Ա����   ��н����     ���� ����  ��������    ��Ŀ����    �ڼ��ղ���   ��������    �����۳�    ��������    �¼�  ����  ��ע
				if(!in_array('Ա����', $excelFields)||!in_array('����', $excelFields)
						||!in_array('��н����', $excelFields))
				{
					throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
				}
				//��ȡ����
				if(count($excelArr)&&!empty($excelArr)){
					foreach($excelArr['Ա����'] as $key=>$val ){
						$infoE[$val]['name']=$excelArr['����'][$key];
						$infoE[$val]['dept']=$excelArr['����'][$key];
						$infoE[$val]['pym']=$excelArr['��н����'][$key].'-01';
						$infoE[$val]['bam']=$excelArr['��������'][$key];
						$infoE[$val]['proam']=$excelArr['��Ŀ����'][$key];
						$infoE[$val]['sdyam']=$excelArr['�ڼ��ղ���'][$key];
						$infoE[$val]['otheram']=$excelArr['��������'][$key];
						$infoE[$val]['spedelam']=$excelArr['�����۳�'][$key];
						$infoE[$val]['sperewam']=$excelArr['��������'][$key];
						$infoE[$val]['pdt']=$excelArr['�¼�'][$key];
						$infoE[$val]['sdt']=$excelArr['����'][$key];
						$infoE[$val]['remark']=$excelArr['��ע'][$key];
						$infoE[$val]['type']=1;//Ĭ�ϲ���Ч

						if($tempt!=$infoE[$val]['pym']&&!empty($tempt)){
							$ckdt=false;
						}
						$tempt = $infoE[$val]['pym'];
					}
				}
				$tempt=  strtotime($tempt);//תʱ���
				//��֤����
				$sql="select
					s.username , s.userid , h.usercard as idcard , s.rand_key
					from
					salary s
					left join hrms h on(s.userid=h.user_id)
					where 1 and ( s.deptid in ('". implode("','", $this->divDept) ."') )";
				$query=$this->db->query_exc($sql);
				$upi=0;//�ɸ�������
				while($row=$this->db->fetch_array($query)){
					if(array_key_exists($row['idcard'],$infoE)){
						$upi++;
						$infoE[$row['idcard']]['type']=0;
						$infoE[$row['idcard']]['userid']=$row['userid'];
						$infoE[$row['idcard']]['sid']=$row['rand_key'];
						if($infoE[$row['idcard']]['name']!=$row['username']){
							$infoE[$row['idcard']]['daork']='������������'.$row['username'];
						}
					}

				}
				//�������
				if($act=='xls'){
					$str.='<tr align="left">
						<td colspan="30">�������ѣ�����ϵͳ�����͵���������ƥ�䣻ֻҪԱ������ȷ��������Ӱ�����ݵĵ��롣
						'.($ckdt===false?'<br><font style="color:red;">���ڲ�һ�£�����!</font>':'')
						.'<br><font style="color:green;">�ɸ������ݣ�'.$upi.' ��</font><font style="color:red;">���ɸ������ݣ�'.(count($infoE)-$upi).'</font>'.'
						</td>
						</tr>';
					if(count($infoE)){
						$totalA=array('pro'=>0);
						foreach($infoE as $key=>$val){
							if($val['type']=='0'){
								$cl='green';
							}elseif($val['type']=='1'){
								$cl='red';
							}
							$totalA['pro']=$totalA['pro']+$val['pro'];
							$tempt=  strtotime($val['pym']);
							$str.='<tr style="color:'.$cl.'">
								<td>'.$key.'</td>
								<td>'.(date('Y-m', $tempt )).'</td>
								<td>'.$val['name'].'</td>
								<td>'.$val['dept'].'</td>
								<td>'.$val['bam'].'</td>
								<td>'.$val['proam'].'</td>
								<td>'.$val['sdyam'].'</td>
								<td>'.$val['otheram'].'</td>
								<td>'.$val['spedelam'].'</td>
								<td>'.$val['sperewam'].'</td>
								<td>'.$val['pdt'].'</td>
								<td>'.$val['sdt'].'</td>
								<td>'.$val['remark'].'</td>
								<td>'.($val['type']=='1'?'Ա���Ų���ȷ��Ա��������ר����Ա':'��Ч'.$val['daork']).'</td>
								</tr>';
						}
					}
				}elseif($act=='in'){
					if(count($infoE)){
						foreach($infoE as $key=>$val){
							if($val['type']=='0'){
								$tempt=  strtotime($val['pym']);
								//Ŀǰֻ���벹������
								$oldarr=array(
										'sdyam'=>round($val['sdyam'],2)
										,'otheram'=>round($val['otheram'],2)
										,'remark'=>''
									     );
								//��ȡ��Ч�Ĳ���
								$sql="
									select
									s.sdymeal , s.sdyother , s.remark
									from salary_sdy s
									left join salary_flow f on (f.salarykey=s.rand_key )
									where
									s.pyear='".(date('Y',$tempt))."' and s.pmon='".(date('n',$tempt))."'
									and s.userid='".$val['userid']."'
									and f.sta='2' ";
								$query=$this->db->query_exc($sql);
								while($row=$this->db->fetch_array($query)){
									$oldarr['sdyam']=round($oldarr['sdyam']+$this->salaryClass->decryptDeal($row['sdymeal']),2);
									$oldarr['otheram']=round($oldarr['otheram']+$this->salaryClass->decryptDeal($row['sdyother']),2);
									$val['remark'].=$row['remark'];
								}
								$pid=$this->model_get_payid($val['sid'], date('Y',$tempt), date('n',$tempt));
								//��������
								$this->model_salary_update($val['sid'],
										array('amount' => $val['bam']
										     )
										, array());
								$this->model_pay_update($pid['id'],
										array(
											'PerHolsDays' => $val['pdt']
											,'SickHolsDays' => $val['sdt']
											,'remark' => $val['remark']
											,'baseam' => $val['bam']
											,'ProAm' => $val['proam']
											,'SdyAm' => $oldarr['sdyam']
											,'OtherAm' => $oldarr['otheram']
											,'SpeRewAm' => $val['sperewam']
											,'SpeDelAm' => $val['spedelam']
										     )
										, array(0,1,2),'',false);
								$this->model_pay_stat($pid['id']);
							}//type=0
						}//foreach
					}//infoE is not null
				}//$act is in
			}elseif($type=='hr_ext'){//���⵼��
				$ckdt=true;
				$tempt='';
				//Ա����   ��н����     ���� ����  ��������    ��Ŀ����    �ڼ��ղ���   ��������    �����۳�    ��������    �¼�  ����  ��ע
				if(!in_array('����', $excelFields))
				{
					throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
				}
				//��ȡ����
				if(count($excelArr)&&!empty($excelArr)){
					foreach($excelArr['����'] as $key=>$val ){
						$infoE[$val]['name']=$excelArr['����'][$key];
						$infoE[$val]['jfcom']=$excelArr['������'][$key];
						$infoE[$val]['dept']=$excelArr['����'][$key];
						$infoE[$val]['usercom']=$excelArr['���ѷ�'][$key];
						$infoE[$val]['baseam']=$excelArr['��������'][$key];
						$infoE[$val]['gjjam']=$excelArr['������'][$key];
						$infoE[$val]['shbam']=$excelArr['�籣��'][$key];
						$infoE[$val]['cogjjam']=$excelArr['��ҵ������'][$key];
						$infoE[$val]['coshbam']=$excelArr['��ҵ�籣'][$key];
						$infoE[$val]['PrepareAm']=$excelArr['�����'][$key];
						$infoE[$val]['HandicapAm']=$excelArr['���Ϸ�'][$key];
						$infoE[$val]['ManageAm']=$excelArr['�����'][$key];
						$infoE[$val]['acc']=$excelArr['�˺�'][$key];
						$infoE[$val]['accbank']=$excelArr['������'][$key];
						$infoE[$val]['idcard']=$excelArr['���֤'][$key];
						$infoE[$val]['remark']=$excelArr['��ע'][$key];
						$infoE[$val]['type']=1;//Ĭ�ϲ���Ч
					}
				}
				//��֤����
				//�������
				if($act=='xls'){
					$str.='<tr align="left">
						<td colspan="30">�������ѣ�����ϵͳ�����͵���������ƥ�䣻ֻҪԱ������ȷ��������Ӱ�����ݵĵ��롣
						'.($ckdt===false?'<br><font style="color:red;">���ڲ�һ�£�����!</font>':'')
						.'<br><font style="color:green;">�ɸ������ݣ�'.$upi.' ��</font><font style="color:red;">���ɸ������ݣ�'.(count($infoE)-$upi).'</font>'.'
						</td>
						</tr>';
					if(count($infoE)){
						$totalA=array('pro'=>0);
						foreach($infoE as $key=>$val){
							if($val['type']=='0'){
								$cl='green';
							}elseif($val['type']=='1'){
								$cl='red';
							}
							$totalA['pro']=$totalA['pro']+$val['pro'];
							$tempt=  strtotime($val['pym']);
							$str.='<tr style="color:'.$cl.'">
								<td>'.$key.'</td>
								<td>'.(date('Y-m', $tempt )).'</td>
								<td>'.$val['name'].'</td>
								<td>'.$val['dept'].'</td>
								<td>'.$val['bam'].'</td>
								<td>'.$val['proam'].'</td>
								<td>'.$val['sdyam'].'</td>
								<td>'.$val['otheram'].'</td>
								<td>'.$val['spedelam'].'</td>
								<td>'.$val['sperewam'].'</td>
								<td>'.$val['pdt'].'</td>
								<td>'.$val['sdt'].'</td>
								<td>'.$val['remark'].'</td>
								<td>'.($val['type']=='1'?'Ա���Ų���ȷ��Ա��������ר����Ա':'��Ч'.$val['daork']).'</td>
								</tr>';
						}
					}
				}elseif($act=='in'){
					if(count($infoE)){
						foreach($infoE as $key=>$val){
							if($val['type']=='0'){
								$tempt=  strtotime($val['pym']);
								//Ŀǰֻ���벹������
								$oldarr=array(
										'sdyam'=>round($val['sdyam'],2)
										,'otheram'=>round($val['otheram'],2)
										,'remark'=>''
									     );
								//��ȡ��Ч�Ĳ���
								$sql="
									select
									s.sdymeal , s.sdyother , s.remark
									from salary_sdy s
									left join salary_flow f on (f.salarykey=s.rand_key )
									where
									s.pyear='".(date('Y',$tempt))."' and s.pmon='".(date('n',$tempt))."'
									and s.userid='".$val['userid']."'
									and f.sta='2' ";
								$query=$this->db->query_exc($sql);
								while($row=$this->db->fetch_array($query)){
									$oldarr['sdyam']=round($oldarr['sdyam']+$this->salaryClass->decryptDeal($row['sdymeal']),2);
									$oldarr['otheram']=round($oldarr['otheram']+$this->salaryClass->decryptDeal($row['sdyother']),2);
									$val['remark'].=$row['remark'];
								}
								$pid=$this->model_get_payid($val['sid'], date('Y',$tempt), date('n',$tempt));
								//��������
								$this->model_salary_update($val['sid'],
										array('amount' => $val['bam']
										     )
										, array());
								$this->model_pay_update($pid['id'],
										array(
											'PerHolsDays' => $val['pdt']
											,'SickHolsDays' => $val['sdt']
											,'remark' => $val['remark']
											,'baseam' => $val['bam']
											,'ProAm' => $val['proam']
											,'SdyAm' => $oldarr['sdyam']
											,'OtherAm' => $oldarr['otheram']
											,'SpeRewAm' => $val['sperewam']
											,'SpeDelAm' => $val['spedelam']
										     )
										, array(0,1,2),'',false);
								$this->model_pay_stat($pid['id']);
							}//type=0
						}//foreach
					}//infoE is not null
				}//$act is in
			}
		}
	}catch(Exception $e){
		if($act=='xls'){
			$str='<tr><td colspan="30">�������ݴ���'.$e->getMessage().'</td></tr>';
		}else{
			$str['error']='���ݲ�ѯʧ�ܣ�';
		}
	}
	return $str;
}

/**
 *
 */
function model_dp_pro_xls($ckt){
	set_time_limit(600);
	$type=$_POST['ctr_type'];
	$sqlCk=$type=='com'?'0':'1';
	$str='';
	$infoE=array();
	try{
		$sql="delete from salary_temp where code = 'amount' and creator='".$_SESSION['USER_ID']."' ";
		$this->db->query_exc($sql);
		$excelfilename='attachment/xls_model/pro/'.$ckt.".xls";
		if(empty ($_FILES["ctr_file"]["tmp_name"])){
			$str='<tr><td colspan="10">�뵼����Ŀ�������ݱ�</td></tr>';
		}elseif (!move_uploaded_file( $_FILES["ctr_file"]["tmp_name"], $excelfilename) ){
			$str='<tr><td colspan="10">�ϴ�ʧ�ܣ�</td></tr>';
		}else{
			//��ȡexcel��Ϣ
			include('includes/classes/excel.php');
			$excel = Excel::getInstance();
			$excel->setFile(WEB_TOR.$excelfilename);
			$excel->Open();
			$excel->setSheet();
			$excelFields = $excel->getFields();
			$excelArr=$excel->getAllData();
			$excel->Close();
			if(!in_array('Ա��', $excelFields)||!in_array('Ա����', $excelFields)
					||!in_array('��Ŀ����', $excelFields)||!in_array('��ע', $excelFields)
					||!in_array('��Ŀ���', $excelFields)||!in_array('��Ŀ����', $excelFields))
			{
				throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
			}
			if(count($excelArr)&&!empty($excelArr)){
				foreach($excelArr['Ա����'] as $key=>$val ){
					$infoE[$val]['name']=$excelArr['Ա��'][$key];
					$infoE[$val]['pro']=$excelArr['��Ŀ����'][$key];
					$infoE[$val]['prono']=$excelArr['��Ŀ���'][$key];
					$infoE[$val]['proname']=$excelArr['��Ŀ����'][$key];
					$infoE[$val]['remark']=$excelArr['��ע'][$key];
				}
			}
			$sql="select
				s.username , s.userid , h.usercard as idcard
				from
				salary s
				left join hrms h on(s.userid=h.user_id)
				where 1 ";
			$query=$this->db->query_exc($sql);
			while($row=$this->db->fetch_array($query)){
				$infoA[]=$row['idcard'];
				if(array_key_exists($row['idcard'],$infoE)){
					$infoE[$row['idcard']]['type']=0;
				}
			}
			if(count($infoE)){
				foreach($infoE as $key=>$val){
					if(!in_array($key,$infoA)){
						$infoE[$row['idcard']]['type']=1;
					}
				}
			}
			if(count($infoE)){
				$totalA=array('pro'=>0);
				foreach($infoE as $key=>$val){
					if($val['type']=='0'){
						$cl='green';
					}elseif($val['type']=='1'){
						$cl='red';
					}
					$totalA['pro']=$totalA['pro']+$val['pro'];
					$str.='<tr style="color:'.$cl.'">
						<td>'.$key.'</td>
						<td>'.$val['name'].'</td>
						<td>'.$val['pro'].'</td>
						<td>'.$val['prono'].'</td>
						<td>'.$val['proname'].'</td>
						<td>'.$val['remark'].'</td>
						</tr>';
				}
			}
			$str.='<tr style="color:red">
				<td></td>
				<td>�ϼƣ�</td>
				<td>'.$totalA['pro'].'</td>
				<td></td>
				<td></td>
				<td></td>
				</tr>';
		}
	}catch(Exception $e){
		$str='<tr><td colspan="10">�������ݴ���'.$e->getMessage().'</td></tr>';
	}
	return $str;
}
/**
 * �����ʼ������
 */
function model_dp_pro_xls_in(){
	set_time_limit(600);
	$ckt=$_POST['ckt'];
	$excelfilename=WEB_TOR.'attachment/xls_model/pro/'.$ckt.".xls";
	try{
		if(!file_exists($excelfilename)){
			throw new Exception('File does not exist');
		}
		include('includes/classes/excel.php');
		$excel = Excel::getInstance();
		$excel->setFile($excelfilename);
		$excel->Open();
		$excel->setSheet();
		$excelFields = $excel->getFields();
		$excelArr=$excel->getAllData();
		$excel->Close();
		if(!in_array('Ա��', $excelFields)||!in_array('Ա����', $excelFields)
				||!in_array('��Ŀ����', $excelFields)||!in_array('��ע', $excelFields)
				||!in_array('��Ŀ���', $excelFields)||!in_array('��Ŀ����', $excelFields))
		{
			throw new Exception('Update failed');
		}
		if(count($excelArr)&&!empty($excelArr)){
			foreach($excelArr['Ա����'] as $key=>$val ){
				$infoE[$val]['name']=$excelArr['Ա��'][$key];
				$infoE[$val]['pro']=$excelArr['��Ŀ����'][$key];
				$infoE[$val]['prono']=$excelArr['��Ŀ���'][$key];
				$infoE[$val]['proname']=$excelArr['��Ŀ����'][$key];
				$infoE[$val]['remark']=$excelArr['��ע'][$key];
			}
		}
		if(count($infoE)){
			foreach($infoE as $key=>$val){
				$sql="select s.rand_key , p.id as pid , s.userid, h.userlevel, s.usercom from salary s
					left join salary_pay p on (s.userid=p.userid and p.pyear='".$this->nowy."' and pmon='".$this->nowm."')
					left join hrms h on (s.userid=h.user_id)
					where h.usercard='".$key."'   ";
				$res=$this->db->get_one($sql);
				if(!empty($res)){
					$flowname = $this->flowName['pro_'.$res['userlevel']];
					if($res['usercom'] == 'xs') {
						$flowname = $this->flowName['pro_'.$res['userlevel']];
					}
					$info=array('flowname'=>$flowname
							,'userid'=>$res['userid']
							,'salarykey'=>''
							,'changeam'=>$this->salaryClass->encryptDeal($val['pro'])
							,'remark'=>$val['remark']
							,'prono'=>$val['prono']
							,'proname'=>$val['proname']
						   );
					$sm[$key]=$this->model_flow_new($info,true,false);
				}
			}
		}
		if(is_array($sm)){
			if(count($sm)){
				foreach($sm as $val){
					$body='���ã�<br>
						��������-��Ŀ������Ҫ����������<br>
						лл��';
					$this->model_send_email('����--��Ŀ��', $body, $val, false);
				}
			}
		}
	}catch(Exception $e){
		$responce->error = un_iconv($e->getMessage());
	}
	return $responce;
}
/**
 * ������Ϣ
 */
function model_hr_user_ext($outtype='list'){
	$page = $_GET['page'];
	$limit = $_GET['rows'];
	$sidx = $_GET['sidx'];
	$sord = $_GET['sord'];
	$schOper = $_GET['searchOper'];
	$schStr = $_GET['searchString'];
	$schField = $_GET['searchField'];
	$seapy = $_GET['seapy']?$_GET['seapy']:$this->nowy;
	$seapm = $_GET['seapm']?$_GET['seapm']:$this->nowm;
	$seadept = $_REQUEST['seadept'];
	$seaname = $_REQUEST['seaname'];
	$seausersta = $_REQUEST['seausersta'];

	$sqlSch = '';
	$fnArr=array();
	if ($schOper) {
		$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
	}
	if($seapy&&$seapy!='-'){
		$paysql.=" and p.pyear='".$seapy."' ";
	}
	if($seapm&&$seapm!='-'){
		$paysql.=" and p.pmon='".$seapm."' ";
	}
	if($seadept){
		$sqlSch.=" and p.salarydept like '%".$seadept."%' ";
	}
	if($seaname){
		$sqlSch.=" and ( s.username like '%".$seaname."%' ) ";
	}
	if($seausersta=='��Ч'){
		$sqlSch.=" and p.id is not null ";
	}elseif($seausersta=='�ر�'){
		$sqlSch.=" and p.id is null ";
	}
	//�жϵ��£������޸� ��ʱ��ͨ
	$outck=0;
	if(true){
		$outck=1;
	}
	//��ҳ
	$start = $limit * $page - $limit;
	//ͳһ�����ݶ�ȡԴ
	$mailSql="select
		s.rand_key as sid , s.oldname as username , p.salarydept as deptname , p.deptid
		,  p.gjjam , p.shbam
		, s.acc , s.accbank , s.idcard , p.remark , s.email , s.usersta , p.baseam , p.floatam , p.proam , p.otheram
		, p.bonusam , p.othdelam , p.perholsdays , p.sickholsdays , p.paycesse , p.paytotal , p.sperewam ,p.spedelam
		, p.pyear , p.pmon
		, p.sdyam , p.cessebase , p.id as pid , p.expflag
		, p.cogjjam , p.coshbam , p.prepaream , p.handicapam , p.manageam
		, p.jfcom , p.totalam , p.accrewam , p.accdelam , p.holsdelam
		, p.comflag , p.usercom , p.accrewam , p.ffcom
		from  salary s
		left join salary_pay p on ( s.userid=p.userid and s.comflag=0  $paysql )
		where s.userid=p.userid and s.comflag=0 and s.comflag=0  $sqlSch ";
	if($outtype=='list'){
		$sql = "select count(*)
			from  salary s
			left join salary_pay p on ( s.userid=p.userid $paysql )
			where s.userid=p.userid and s.comflag=0 and s.comflag=0 $sqlSch ";
		$rs = $this->db->get_one($sql);

		$count = $rs['count(*)'];
		if ($count > 0) {
			$total_pages = ceil($count / $limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages)
			$page = $total_pages;
		//��ҳ
		$sql = $mailSql."
			order by p.id desc ,  $sidx $sord
			limit $start , $limit ";
		$query = $this->db->query($sql);
		$i = 0;
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		while ($row = $this->db->fetch_array($query)) {

			$totalarr['gjj']+=$this->salaryClass->decryptDeal($row['gjjam']);
			$totalarr['shb']+=$this->salaryClass->decryptDeal($row['shbam']);
			$tmp=array($row['sid'],'-',$row['username']
					, (empty($row['pid'])?'�ر�':'��Ч')
					, $this->salaryCom[$row['usercom']]
					, $this->salaryCom[$row['jfcom']]
					, $row['deptname'], $row['ffcom'],$row['pyear'].'-'.$row['pmon']
					, $this->salaryClass->decryptDeal($row['baseam'])
					, $this->salaryClass->decryptDeal($row['gjjam'])
					, $this->salaryClass->decryptDeal($row['shbam'])
					, $this->salaryClass->decryptDeal($row['cogjjam']), $this->salaryClass->decryptDeal($row['coshbam'])
					, $this->salaryClass->decryptDeal($row['prepaream']), $this->salaryClass->decryptDeal($row['handicapam'])
					, $this->salaryClass->decryptDeal($row['manageam'])
					, $this->salaryClass->decryptDeal($row['sperewam']), $this->salaryClass->decryptDeal($row['spedelam'])
					, $this->salaryClass->decryptDeal($row['sdyam']), $this->salaryClass->decryptDeal($row['otheram'])
					, $this->salaryClass->decryptDeal($row['bonusam'])
					, $this->salaryClass->decryptDeal($row['accrewam'])
					, $this->salaryClass->decryptDeal($row['paycesse'])
					, $this->salaryClass->decryptDeal($row['paytotal'])
					, $row['acc'], $row['accbank'], $row['idcard'], $row['remark']
					, $row['pid'],$outck,$row['usercom'],$row['jfcom'],$row['deptid'],$seapy,$seapm

				  );
			$responce->rows[$i]['id'] = $row['userid'];
			$responce->rows[$i]['cell'] = un_iconv($tmp);
			$i++;
		}
		if($fnsta==false&&$dpsta==false){
			$responce->userdata['amount'] = 'total:';
			$responce->userdata['gjjam'] = $this->salaryClass->cfv($totalarr['gjj']);
			$responce->userdata['shbam'] = $this->salaryClass->cfv($totalarr['shb']);
		}
		$this->globalUtil->insertOperateLog('�������¹���', 'salary', '��ʾ���⹤����Ϣ', '�ɹ�', $sql);
		return $responce;
	}elseif($outtype=='xls'){
		$res=array();
		$sql = $mailSql;
		$query = $this->db->query($sql);
		while ($row = $this->db->fetch_array($query)) {
			$total=$this->salaryClass->decryptDeal($row['totalam']);
			$shb=$this->salaryClass->decryptDeal($row['shbam']);
			$gjj=$this->salaryClass->decryptDeal($row['gjjam']);
			$coshb=$this->salaryClass->decryptDeal($row['coshbam']);
			$cogjj=$this->salaryClass->decryptDeal($row['cogjjam']);
			$pre=$this->salaryClass->decryptDeal($row['prepaream']);
			$han=$this->salaryClass->decryptDeal($row['handicapam']);
			$man=$this->salaryClass->decryptDeal($row['manageam']);
			$res[]=un_iconv(array(
						$row['pyear'],$row['pmon']
						,$row['username']
						, $this->salaryCom[$row['usercom']]
						, $this->salaryCom[$row['jfcom']]
						, $row['deptname'], $row['ffcom']
						, $this->salaryClass->decryptDeal($row['baseam'])
						, $this->salaryClass->decryptDeal($row['gjjam'])
						, $this->salaryClass->decryptDeal($row['shbam'])
						, $this->salaryClass->decryptDeal($row['cogjjam']), $this->salaryClass->decryptDeal($row['coshbam'])
						, $this->salaryClass->decryptDeal($row['prepaream']), $this->salaryClass->decryptDeal($row['handicapam'])
						, $this->salaryClass->decryptDeal($row['manageam'])
						, $this->salaryClass->decryptDeal($row['sperewam']), $this->salaryClass->decryptDeal($row['spedelam'])
						, $this->salaryClass->decryptDeal($row['sdyam']), $this->salaryClass->decryptDeal($row['otheram'])
						, $this->salaryClass->decryptDeal($row['bonusam'])
						, $this->salaryClass->decryptDeal($row['accrewam'])
						, $this->salaryClass->decryptDeal($row['paycesse'])
						, $this->salaryClass->decryptDeal($row['paytotal'])
						, $row['acc'], $row['accbank'], $row['idcard'], $row['remark']
					     ));
		}

	}
	return $res;
}
/**
 * �������
 */
function model_hr_user_ext_in(){
	try {
		$this->db->query("START TRANSACTION");

		$skey=$_POST['id'];
		$pid=$_POST['pid'];
		$subtype=$_POST['subtype'];
		$subpy=$_POST['subpy'];
		$subpm=$_POST['subpm'];

		$amount=round($_POST['amount'],2);
		$gjjam=round($_POST['gjjam'],2);
		$shbam=round($_POST['shbam'],2);
		$cogjjam=round($_POST['cogjjam'],2);
		$coshbam=round($_POST['coshbam'],2);
		$prepaream=round($_POST['prepaream'],2);
		$handicapam=round($_POST['handicapam'],2);
		$manageam=round($_POST['manageam'],2);
		$sperewam=round($_POST['sperewam'],2);
		$spedelam=round($_POST['spedelam'],2);
		$accrewam=round($_POST['accrewam'],2);

		$sdyam=round($_POST['sdyam'],2);
		$otheram=round($_POST['otheram'],2);
		$bonusam=round($_POST['bonusam'],2);

		$usercom=$_POST['usercom'];
		$jfcom=$_POST['jfcom'];

		$ffcom=$_POST['ffcom'];
		$userdept=$_POST['userdept'];
		$username=$_POST['username'];
		$usersta=$_POST['usersta'];
		$acc=$_POST['acc'];
		$accbank=$_POST['accbank'];
		$idcard=$_POST['idcard'];
		$remark=$_POST['remark'];
		//��ȡ��������
		$sql = "select d.dept_name
			from department d
			where d.dept_id='$userdept' ";
		$resdept = $this->db->get_one($sql);
		$userdeptname=$resdept['dept_name'];

		$update=false;
		$userid='';
		if($subtype=='edit'){
			$sql = "select
				s.userid , s.usersta , s.jfcom as usercom
				from salary s
				where
				s.rand_key='$skey' ";
			$res = $this->db->get_one($sql);
			if(empty($res['userid'])){
				throw new Exception('No data query');
			}
			$userid=$res['userid'];
			if($usersta=='��Ч'){
				if($pid){//�޸�

				}else{//����
					$sql="insert into
						salary_pay
						( `UserId` ,  `PYear`,  `PMon` , comflag )
						values ( '".$res['userid']."' ,'".$subpy."' ,'".$subpm."' , 0 ) ";
					$this->db->query_exc($sql);
					$pid=$this->db->insert_id();
				}
				$update=true;
			}elseif($usersta=='�ر�'){

				$this->model_salary_update($skey,
						array('usersta'=>3)
						, array(0)
						);
				if($pid){
					$sql=" delete  from salary_pay
						where id='".$pid."' and comflag=0 ";
					$this->db->query_exc($sql);
				}
			}
		}elseif($subtype=='new'){
			$skey=get_rand_key();
			$sql="insert into
				salary
				( rand_key , comflag )
				values ( '".$skey."' , 0) ";
			$this->db->query_exc($sql);
			$userid=$this->db->insert_id();

			$sql="insert into
				salary_pay
				( `UserId` ,  `PYear`,  `PMon` , comflag )
				values ( '".$userid."' ,'".$subpy."' ,'".$subpm."' , 0 ) ";
			$this->db->query_exc($sql);
			$pid=$this->db->insert_id();
			$update=true;
		}
		if($update){
			$sup=array(
					'username'=>$username
					,'oldname'=>$username
					,'usercom'=>$usercom
					,'jfcom'=>$jfcom
					,'ffcom' => $ffcom
					,'deptid'=>$userdept
					,'olddept'=>$userdeptname
					,'usersta'=>2
					,'acc'=>$acc
					,'accbank'=>$accbank
					,'idcard'=>$idcard
					,'userid'=>$userid
					,'lpy'=>empty($accrewam)?0:$subpy
					,'lpm'=>empty($accrewam)?0:$subpm

					,'amount'=>$amount
					,'gjjam'=>$gjjam
					,'shbam'=>$shbam
					,'cogjjam'=>$cogjjam
					,'coshbam'=>$coshbam
					,'prepaream'=>$prepaream
					,'handicapam'=>$handicapam
					,'manageam'=>$manageam
					);
			$pup=array(
					'usercom'=> $usercom
					,'jfcom'=>$jfcom
					,'ffcom'=>$ffcom
					,'deptid'=>$userdept
					,'SalaryDept'=>$userdeptname
					,'remark'=>$remark
					,'nowamflag'=>empty($accrewam)?0:3

					,'baseam'=>$amount
					,'gjjam'=>$gjjam
					,'shbam'=>$shbam
					,'cogjjam'=>$cogjjam
					,'coshbam'=>$coshbam
					,'prepaream'=>$prepaream
					,'handicapam'=>$handicapam
					,'manageam'=>$manageam
					,'sperewam'=>$sperewam
					,'spedelam'=>$spedelam
					,'accrewam'=>$accrewam
					,'sdyam'=>$sdyam
					,'otheram'=>$otheram
					,'bonusam'=>$bonusam
					);
			$this->model_salary_update($skey,
					$sup
					, array(0,1,2,3,4,5,6,7,8,9,10,11,12)
					);
			$this->model_pay_update($pid,
					$pup
					, array(0,1,2,3,4,5), '' ,0
					);
			if(round($amount)!=0){
				$this->model_pay_stat($pid);
			}
		}
		$this->db->query("COMMIT");
		$responce->id = $id;
		$this->globalUtil->insertOperateLog('���ʹ���', $id, '���⹤����Ϣ', '�ɹ�',$msg);
	} catch (Exception $e) {
		$this->db->query("ROLLBACK");
		$responce->error = $e->getMessage();
		$this->globalUtil->insertOperateLog('���ʹ���', $id, '���⹤����Ϣ', 'ʧ��',$e->getMessage().$msg);
	}
	return $responce;
}
/**
 * ר������
 */
function model_hr_user_div($outtype='list'){
	//ר������
	$sqlflag=" and ( p.deptid in ('". implode("','", $this->divDept) ."') ) ";
	if($outtype=='list'){
		return $this->model_hr_user(false,$sqlflag);
	}elseif($outtype=='xls'){
		return $this->model_hr_user(false,$sqlflag,false,false,'xls','hr_div');
	}
}
/**
 *����Ա����Ϣ
 * @return <type>
 */
function model_dp_user($outtype='list'){
	global $func_limit;
	$dppow=$this->model_dp_pow();
	$sqlflag=$this->getSqlParam($func_limit['�������'],$dppow);
	return $this->model_hr_user(false,$sqlflag,true,true,$outtype,'dp_detail');
}
/**
 * Ա����Ϣ����
 */
function model_dp_user_typel(){
	$page = $_GET['page'];
	$limit = $_GET['rows'];
	$sidx = $_GET['sidx'];
	$sord = $_GET['sord'];
	$schOper = $_GET['searchOper'];
	$schStr = $_GET['searchString'];
	$schField = $_GET['searchField'];
	$sqlSch = '';
	if ($schOper) {
		$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
	}
	if($flag==false){
		$sqlSch.=$sqlflag;
	}
	$start = $limit * $page - $limit;
	//����
	$sql = "select count(*)
		from salary_user_type t
		where
		1
		$sqlSch ";
	$rs = $this->db->get_one($sql);
	$count = $rs['count(*)'];
	if ($count > 0) {
		$total_pages = ceil($count / $limit);
	} else {
		$total_pages = 0;
	}
	if ($page > $total_pages){
		$page = $total_pages;
	}
	$i = 0;
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
	$sql="select
		t.rand_key , t.name , t.members , t.membersn , t.remark
		from salary_user_type t
		where
		1
		$sqlSch
		order by $sidx $sord
		limit $start , $limit ";
	$query = $this->db->query($sql);
	while ($row = $this->db->fetch_array($query)) {
		$responce->rows[$i]['id'] = $row['userid'];
		$responce->rows[$i]['cell'] = un_iconv(
				array("", $row['rand_key'], $row['name'],$row['members'],$row['membersn']
					, $row['remark']
				     )
				);
		$i++;
	}
	return $responce;
}
function model_dp_user_typen(){
	$namet=$_POST['namet'];
	$remarkt=$_POST['remarkt'];
	$memberst=$_POST['memberst'];
	$membersnt=$_POST['membersnt'];
	$sub=$_POST['sub'];
	$id=$_POST['id'];
	try{
		if($sub=='new'){
			$sql="insert into salary_user_type (name , type , members , membersn , remark )
				values ('".$namet."','pro', '".$memberst."', '".$membersnt."' , '".$remarkt."')";
			$this->db->query($sql);
		}elseif($sub=='edit'){
			$sql="update salary_user_type set name='".$namet."' , members ='".$memberst."'
				, membersn ='".$membersnt."' , remark ='".$remarkt."'
				where rand_key='".$id."' ";
			$this->db->query($sql);
		}elseif($sub=='del'){
			$sql="delete from salary_user_type where rand_key='".$id."' ";
			$this->db->query($sql);
		}
		$responce->id = $namet;
	}catch(Exception $e){
		$responce->error = $e->getMessage();
		$this->globalUtil->insertOperateLog('���ʹ���', $id, 'Ա����Ŀ����', 'ʧ��', $e->getMessage());
	}
	return $responce;
}
/**
 *
 */
function  model_fin_user(){
	$sqlflag='';
	$seacompt = $_GET['seacompt']?$_GET['seacompt']:'0';
	if($seacompt!='-'){
		$sqlflag=" and p.expflag='".$seacompt."'  ";
	}
	global $func_limit;
	if(empty($_REQUEST['seacom'])&&!empty($func_limit['���񷢷Ź�˾'])){
		$_REQUEST['seacom'] = $func_limit['���񷢷Ź�˾'];
	}else{
		$_REQUEST['seacom'] = '_';
	}
	return $this->model_hr_user(false,$sqlflag,true);
}
/**
 * �������
 */
function model_fn_user(){
	$sqlflag='';
	$seacompt = $_GET['seacompt']?$_GET['seacompt']:'0';
	if($seacompt!='-'){
		$sqlflag=" and p.expflag=".$seacompt."  ";
	}
	global $func_limit;
	if(empty($_REQUEST['seacom'])&&!empty($func_limit['���񷢷Ź�˾'])){
		$_REQUEST['seacom'] = $func_limit['���񷢷Ź�˾'];
	}
	return $this->model_hr_user(false,$sqlflag,true);
}
/**
 *
 */
function model_ck_idcard(){
	$id = $_POST['id'];
	$idcard=$_POST['idcard'];
	$flag = $_POST['flag'];
	$scom = $_POST['scom'];
	$comtable=$this->get_com_sql($scom);
	if($flag=='stat'){
		$sql="select count(*) as cm from salary where idcard='".$idcard."'
			and userid not in ( select userid from salary_pay where id='".$id."')
			and usersta!=3 and comflag=1 ";
	}else{
		$sql="select count(*) as cm from salary where idcard='".$idcard."' and rand_key<>'$id' and usersta!=3 and comflag=1 ";
	}
	$res = $this->db->get_one($sql);
	if(empty($res['cm'])){
		return '1';
	}else{
		return '0';
	}
}
/**
 *�û���Ϣ�޸�
 * @return <type>
 */
function model_fn_info_in(){
	$id = $_POST['id'];
	$cb = $_POST['cb'];
	$flag = $_POST['flag'];
	try {
		$this->db->query("START TRANSACTION");
		if(empty($flag)){
			$sql = "select
				s.userid , s.usersta , p.id as pid
				from salary s
				left join salary_pay p on ( s.userid=p.userid and p.pyear='".$this->nowy."' and p.pmon='".$this->nowm."' )
				where
				s.rand_key='$id' and s.usersta!='3'  ";
			$res = $this->db->get_one($sql);
			if(!$res['userid']){
				throw new Exception('No data query');
			}
			$this->model_salary_update($id,
					array('cessebase'=>$cb
					     )
					, array(0));
			if(!empty($res['pid'])){
				$this->model_pay_update($res['pid'],
						array('cessebase' => $cb)
						, array(0));
				$this->model_pay_stat($res['pid']);
			}
		}elseif($flag=='stat'){//����
			$username=$_POST['username'];
			$amount=round($_POST['amount'],2);
			$gjjam=round($_POST['gjjam'],2);
			$shbam=round($_POST['shbam'],2);
			$floatam=round($_POST['floatam'],2);
			$sperewam=round($_POST['sperewam'],2);
			$spedelam=round($_POST['spedelam'],2);
			$proam=round($_POST['proam'],2);
			$otheram=round($_POST['otheram'],2);
			$bonusam=round($_POST['bonusam'],2);
			$othdelam=round($_POST['othdelam'],2);
			$cessebase=round($_POST['cessebase'],2);
			$comedt=$_POST['comedt'];
			$oldarea=$_POST['oldarea'];
			$acc=$_POST['acc'];
			$accbank=$_POST['accbank'];
			$idcard=$_POST['idcard'];
			$email=$_POST['email'];
			$scom=$_POST['scom'];
			//$comtable=$this->get_com_sql($scom);
			$sql = "select
				s.userid , s.usersta , s.rand_key , p.id as pid
				from salary s
				left join salary_pay p on ( s.userid=p.userid )
				where
				p.id='$id' ";
			$res = $this->db->get_one($sql);
			if(!$res['userid']){
				throw new Exception('No data query');
			}
			if(!empty($res['rand_key'])){
				$salaryData=array('amount'=>$amount,'floatam'=>$floatam,'gjjam'=>$gjjam
						,'shbam'=>$shbam,'cessebase'=>$cessebase,'comedt'=>$comedt
						,'oldarea'=>$oldarea,'acc'=>$acc,'accbank'=>$accbank,'idcard'=>$idcard
						,'email'=>$email,'oldname'=>$username,'username'=>$username
						);
				$this->model_salary_update($res['rand_key'],
						$salaryData
						, array(4,5,6,7,8,9,10,11,12));
			}
			if(!empty($res['pid'])){
				$payData=array('cessebase'=>$cessebase,'baseam'=>$amount,'floatam'=>$floatam,'gjjam'=>$gjjam,'shbam'=>$shbam
						,'sperewam'=>$sperewam,'spedelam'=>$spedelam,'proam'=>$proam,'otheram'=>$otheram
						,'bonusam'=>$bonusam,'othdelam'=>$othdelam
					      );
				$this->model_pay_update($res['pid'],
						$payData
						, array(0));
				$this->model_pay_stat($res['pid']);
			}
		}elseif($flag=='hr'){
			$amount=round($_POST['amount'],2);
			$gjjam=round($_POST['gjjam'],2);
			$shbam=round($_POST['shbam'],2);
			$cogjjam=round($_POST['cogjjam'],2);
			$coshbam=round($_POST['coshbam'],2);
			$prepaream=round($_POST['prepaream'],2);
			$handicapam=round($_POST['handicapam'],2);
			$manageam=round($_POST['manageam'],2);
			$id=$_POST['id'];
			$leaveflag=$_POST['leaveflag'];
			$leavedt=$_POST['leavedt'];
			$sql = "select
				s.userid , s.usersta , s.rand_key , p.id as pid
				, s.comedt , p.pyear , p.pmon
				from salary s
				left join salary_pay p on ( s.userid=p.userid )
				where
				p.id='$id' ";
			$res = $this->db->get_one($sql);
			if(!$res['userid']){
				throw new Exception('No data query');
			}
			if(!empty($res['rand_key'])){
				if($leaveflag=='1'){
					$salaryData=array('amount'=>$amount,'usersta'=>'3'
							);
				}else{
					$salaryData=array('amount'=>$amount
							);
				}
				if(!empty($leavedt)){
					$salaryData['leavedt']=$leavedt;
				}
				$this->model_salary_update($res['rand_key'],
						$salaryData
						, array(1));
			}
			if(!empty($res['pid'])){
				if(!empty($leavedt)){
					$baseNow = $this->salaryClass->salaryDealLeave($res['comedt'],$leavedt, $amount);
					$payData=array('baseam'=>$amount,'leaveflag'=>$leaveflag,'basenowam'=>$baseNow
							,'gjjam'=>$gjjam,'shbam'=>$shbam, 'cogjjam'=>$cogjjam , 'coshbam'=>$coshbam
							,'prepaream'=>$prepaream, 'handicapam'=>$handicapam,'manageam'=>$manageam
						      );
				}else{
					$tempComeDT=strtotime($res['comedt']);
					if(date('Y',$tempComeDT)==$res['pyear']&&date('n',$tempComeDT)==$res['pmon']){
						$baseNow = $this->salaryClass->salaryDeal($res['comedt'], $amount);
					}else{
						$baseNow = 0;
					}
					$payData=array('baseam'=>$amount,'leaveflag'=>$leaveflag,'basenowam'=>$baseNow
							,'gjjam'=>$gjjam,'shbam'=>$shbam, 'cogjjam'=>$cogjjam , 'coshbam'=>$coshbam
							,'prepaream'=>$prepaream, 'handicapam'=>$handicapam,'manageam'=>$manageam
						      );
				}
				$this->model_pay_update($res['pid'],
						$payData
						, array(1));
				$this->model_pay_stat($res['pid']);
			}
			//var_dump($payData);
		}
		$this->db->query("COMMIT");
		$responce->id = $id;
		$msg='������Ϣ��'.print_r($salaryData,true).'���½ɷѣ�'.print_r($payData,true);
		$this->globalUtil->insertOperateLog('���ʹ���', $id, '�޸Ĺ�����Ϣ', '�ɹ�',$msg);
	} catch (Exception $e) {
		$this->db->query("ROLLBACK");
		$responce->error = $e->getMessage();
		$this->globalUtil->insertOperateLog('���ʹ���', $id, '�޸Ĺ�����Ϣ', 'ʧ��',$e->getMessage().$msg);
	}
	return $responce;
}
function model_fn_xls(){
	set_time_limit(600);
	global $func_limit;
	$syear=$_REQUEST["sy"];
	$smon=$_REQUEST["sm"];
	$stype=$_REQUEST['ty'];
	$ck=$_REQUEST['ck'];
	$fn_exp=$_REQUEST['fn_exp'];
	$seacom = $_REQUEST['seacom'];
	if(empty($seacom)&&!empty($func_limit['���񷢷Ź�˾'])){
		$seacom = $func_limit['���񷢷Ź�˾'];
	}
	if(empty($seacom)){
		$seacom = '_';
	}
	$comtable = $this->get_com_sql($seacom);
	$xls=new includes_class_excelout('gb2312', true, 'My Test Sheet');
	try {
		if(!$syear||!$smon||!$stype){
			throw new Exception('�Ƿ����ݣ�');
		}
		if($stype=="1"){
			if($ck=='subcom'){
				if($_SESSION['USER_COM']=='sy'||$func_limit['���񷢷Ź�˾']=='sy'){
					$data = array(1=> array ('���', '��ְʱ��', '��н����', '����','ֱ������', '����'
								, '����', '��������','��λ����','��Ч����', '������ְ����', '��������', '��Ŀ���𼰲Ͳ�', '��������'
								,'����','ͨ�Ž���','�۳�','����','�¼�','����','����ٹ���','�ܹ��ʺϼ�','�籣��'
								,'������','С��','˰��','Ӧ��˰���ö�','Ӧ��˰���','˰��۳�','ʵ������','��˾�籣��','��˾������'
								,'�����','���Ϸ�','�����'
								,'�ʺ�','����','���֤��','������','��ע'));
					$xls->setStyle(array(7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34));
					$xls->setID(array(7=>'s95',8=>'s95',9=>'s95',10=>'s95'
								,11=>'s95',12=>'s95',13=>'s95'
								,16=>'s95',17=>'s95',18=>'s95',19=>'s95',20=>'s95'
								,23=>'s95',24=>'s95',25=>'s95',26=>'s95',27=>'s95',28=>'s95',29=>'s95',30=>'s95'
								,31=>'s95',32=>'s95',33=>'s95',34=>'s95'));
				}else{
					$data = array(1=> array ('���', '��ְʱ��', '��н����', '����','ֱ������', '����'
								, '����', '��������','��λ����','��Ч����', '������ְ����', '��������', '��Ŀ���𼰲Ͳ�', '��������'
								,'����','ͨ�Ž���','�۳�','����','�¼�','����','����ٹ���','�ܹ��ʺϼ�','�籣��'
								,'������','�۳���','����˰��','˰��۳�','ʵ������','��˾�籣��','��˾������'
								,'�����','���Ϸ�','�����'
								,'�ʺ�','����','���֤��','������','��ע'));
					$xls->setStyle(array(7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32));
					$xls->setID(array(7=>'s95',8=>'s95',9=>'s95',10=>'s95'
								,11=>'s95',12=>'s95',13=>'s95'
								,16=>'s95',17=>'s95',18=>'s95',19=>'s95',20=>'s95'
								,21=>'s95',22=>'s95',23=>'s95',24=>'s95',25=>'s95',26=>'s95',27=>'s95',28=>'s95'
								,29=>'s95',30=>'s95',31=>'s95',32=>'s95' ));
				}
			}else{
				$data = array(1=> array ('���', '��ְʱ��', '��н����', '����','ֱ������', '����'
							, '����', '��������','��λ����','��Ч����', '������ְ����', '��������', '��Ŀ���𼰲Ͳ�', '��������'
							,'����','ͨ�Ž���','�۳�','����','�¼�','����','����ٹ���','�ܹ��ʺϼ�','�籣��'
							,'������','�۳���','����˰��','˰��۳�','ʵ������','��˾�籣��','��˾������'
							,'�����','���Ϸ�','�����'
							,'�ʺ�','����','���֤��','������','��ע'));
				$xls->setStyle(array(7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33));
				$xls->setID(array(7=>'s95',8=>'s95',9=>'s95',10=>'s95'
							,11=>'s95',12=>'s95',13=>'s95'
							,16=>'s95',17=>'s95',18=>'s95',19=>'s95',20=>'s95'
							,21=>'s95',22=>'s95',23=>'s95',24=>'s95',25=>'s95',26=>'s95',27=>'s95',28=>'s95'
							,29=>'s95',30=>'s95',31=>'s95' ,32=>'s95',33=>'s95' ));
			}

		}elseif ($stype=="2") {
			$data = array(1=>array('���֤�����','���֤������','��˰������','������Ŀ'
						,'������Ŀ��Ŀ','���������ڼ䣨��','���������ڼ䣨ֹ��','����','�����걨�����:���'
						,'���涨�۳���Ŀ:��ᱣ�շ�','���涨�۳���Ŀ:ס��������','�����������ö�','˰�����ʽ'));
			$xls->setStyle(array(8,9,10,11,12));
			$xls->setID(array(8=>'s95',9=>'s95',10=>'s95',11=>'s95',12=>'s95'));
		}elseif ($stype=="3") {
			//                $data = array(1=>array('���','���','�տ�������','�տ��ʺ�','�տ�������','�տ��˵�ַ'
			//                    ,'�տ����ʻ�����','�ʽ���;','����','�෽Э���'));
			$data = array(1=>array('���','ת���˺�','ת������','���','ת����ʡ��','֤������'
						,'֤������','��ע','�����ʶ'));
			$xls->setStyle(array(3));
			$xls->setID(array(3=>'s95'));
		}elseif ($stype=="4") {
			$data = array(1=>array('ֱ������','����','��������','��Ŀ��/����','����','��������','�۳�'
						,'�ܹ��ʺϼ�','��˾�籣��','��˾������','����˰��','����۳��籣��������','˰��۳�','ʵ������','��������'));
			$xls->setStyle(array(2,3,4,5,6,7,8,9,10,11,12,13,14,15));
		}
		elseif ($stype=="6") {
			$data = array(1=>array('����','�Ӳ���','�����ܼ�','�籣���ܼ�','�������ܼ�','����˰���ܼ�','ʵ�������ܼ�'
						,'һ���ܹ��ʺϼ�','һ���籣��','һ�¹�����','һ�½���˰��','һ��ʵ������'
						,'�����ܹ��ʺϼ�','�����籣��','���¹�����','���½���˰��','����ʵ������'
						,'�����ܹ��ʺϼ�','�����籣��','���¹�����','���½���˰��','����ʵ������'
						,'�����ܹ��ʺϼ�','�����籣��','���¹�����','���½���˰��','����ʵ������'
						,'�����ܹ��ʺϼ�','�����籣��','���¹�����','���½���˰��','����ʵ������'
						,'�����ܹ��ʺϼ�','�����籣��','���¹�����','���½���˰��','����ʵ������'
						,'�����ܹ��ʺϼ�','�����籣��','���¹�����','���½���˰��','����ʵ������'
						,'�����ܹ��ʺϼ�','�����籣��','���¹�����','���½���˰��','����ʵ������'
						,'�����ܹ��ʺϼ�','�����籣��','���¹�����','���½���˰��','����ʵ������'
						,'ʮ���ܹ��ʺϼ�','ʮ���籣��','ʮ�¹�����','ʮ�½���˰��','ʮ��ʵ������'
						,'ʮһ���ܹ��ʺϼ�','ʮһ���籣��','ʮһ�¹�����','ʮһ�½���˰��','ʮһ��ʵ������'
						,'ʮ�����ܹ��ʺϼ�','ʮ�����籣��','ʮ���¹�����','ʮ���½���˰��','ʮ����ʵ������'));
			$xls->setStyle(array(1,2,3,4,5,6,7,8,9,10
						,11,12,13,14,15 ,16,17,18,19,20
						,21,22,23,24,25,26,27,28,29,30
						,31,32,33,34,35,36,37,38,39,40
						,41,42,43,44,45,46,47,48,49,50
						,51,52,53,54,55,56,57,58,59,60
						,61,61,62,63,64,65));
			$xls->setID(array(1=>'s95',2=>'s95',3=>'s95',4=>'s95',5=>'s95',6=>'s95',7=>'s95',8=>'s95',9=>'s95',10=>'s95'
						,11=>'s95',12=>'s95',13=>'s95',14=>'s95',15=>'s95' ,16=>'s95',17=>'s95',18=>'s95',19=>'s95',20=>'s95'
						,21=>'s95',22=>'s95',23=>'s95',24=>'s95',25=>'s95',26=>'s95',27=>'s95',28=>'s95',29=>'s95',30=>'s95'
						,31=>'s95',32=>'s95',33=>'s95',34=>'s95',35=>'s95',36=>'s95',37=>'s95',38=>'s95',39=>'s95',40=>'s95'
						,41=>'s95',42=>'s95',43=>'s95',44=>'s95',45=>'s95',46=>'s95',47=>'s95',48=>'s95',49=>'s95',50=>'s95'
						,51=>'s95',52=>'s95',53=>'s95',54=>'s95',55=>'s95',56=>'s95',57=>'s95',58=>'s95',59=>'s95',60=>'s95'
						,61=>'s95',61=>'s95',62=>'s95',63=>'s95',64=>'s95',65=>'s95'));
		}elseif($stype=="7"){
			$data = array(1=> array ('���','Ա������', '��ְʱ��', '��н����', '����', '�ϼ�����', '����'
						, '����', '��������', '������ְ����', '��������', '��Ŀ���𼰲Ͳ�', '��������'
						,'����','�۳�','����','�¼�','����','����ٹ���','�ܹ��ʺϼ�','�籣��'
						,'������','�۳���','����˰��','ʵ������','���ս���','���ս�˰��','����ʵ������'));
			$xls->setStyle(array(6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26));
			$xls->setID(array(6=>'s95',7=>'s95',8=>'s95',9=>'s95',10=>'s95'
						,11=>'s95',12=>'s95',13=>'s95'
						,16=>'s95',17=>'s95',18=>'s95',19=>'s95',20=>'s95'
						,21=>'s95',22=>'s95',23=>'s95',24=>'s95',25=>'s95',26=>'s95'));
		}elseif($stype=="hr"){
			$data = array(1=> array ('���','Ա������','Ա�����','���ʼ���', '��ְʱ��', '��н����', '����', '����'
						, '����', '��������', '������ְ����', '��������', '��Ŀ���𼰲Ͳ�', '��������'
						,'����','�۳�','����','�¼�','����','����ٹ���','�ܹ��ʺϼ�','�籣��'
						,'������','�۳���','����˰��','ʵ������','���ս���','���ս�˰��','����ʵ������'));
			$xls->setStyle(array(6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28));
			$xls->setID(array(6=>'s95',7=>'s95',8=>'s95',9=>'s95',10=>'s95'
						,11=>'s95',12=>'s95',13=>'s95'
						,16=>'s95',17=>'s95',18=>'s95',19=>'s95',20=>'s95'
						,21=>'s95',22=>'s95',23=>'s95',24=>'s95',25=>'s95',26=>'s95',27=>'s95',28=>'s95'));
		}elseif($stype=="pro"){

		}
		if(isset($syear)&&trim($syear)!="-1"&&trim($syear)!="-"){
			$sqlStr.=" and p.pyear = '".($syear)."' ";
		}
		if(isset($smon)&&trim($smon)!="-1"&&trim($smon)!="-"&&$stype!="6"&&$stype!="7"&&$stype!="hr"){
			$sqlStr.=" and p.pmon  = '".($smon)."' ";
		}
		if($stype=="7"&&$this->nowy==$syear){
			$sqlStr.=" and p.pmon < ".($this->nowm)."  ";
		}
		if($stype=='7'){//���ͳ��
			$sqlStr.="  ";
		}elseif($stype=='hr'){
			$sqlStr.=" and h.userlevel='4' ";
		}else{//������ְ����ʾ
			if($fn_exp==='0'){
				$sqlStr.=" and p.expflag='0' ";
			}elseif($fn_exp==='1'){
				$sqlStr.=" and p.expflag='1' ";
			}elseif($fn_exp!='-'){
				$sqlStr.=" and p.expflag='0' ";
			}
			$sqlStr.=" and ( (p.nowamflag!=3 and p.nowamflag!=4) or p.nowamflag is null ) ";
		}
		if($stype!=5){
			$sqlStr.=" and p.userid<>'eric.ye' ";
		}
		if( $seacom ){
			$sqlStr.=" and p.usercom = '".$seacom."'  ";
		}else{
			$sqlStr.=" and p.usercom = '_'  ";
		}
		if($stype!='pro'){
			$sql="select
				s.id , p.id as pid , s.userid , u.user_name as username , s.oldname
				, s.accbank as bank, if(p.comflag=1,s.comedt,'������Ա') as comedt , d.dept_name , if(p.salarydept is null , s.olddept , p.salarydept ) as olddept
				, s.oldarea , s.email , p.area , p.pyear ,p.pmon , p.baseam
				, p.basenowam , p.floatam , p.proam , p.otheram , p.bonusam
				, p.perholsdays , p.sickholsdays, p.holsdelam , p.totalam
				, p.gjjam , p.shbam , p.cessebase , p.paycesse , p.paytotal
				, p.othdelam , s.acc , h.address , s.sta ,s.idcard , h.card_no
				, p.sperewam , p.cogjjam ,p.coshbam ,p.prepaream ,p.handicapam
				, p.manageam , p.sdyam , p.spedelam
				, h.usercard , p.expflag , h.userlevel , p.remark
				, p.cogjjam , p.coshbam , u.company , p.accdelam , p.accrewam
				, u.dept_id , d.pdeptname, p.comflag , p.nowamflag
				, p.gwam , p.jxam , p.txjt
				, d.Depart_x  , p.ccxs , p.khxs , p.jjam , p.gljtam , p.qtjtam , p.jxzcam, p.lszsam,oah.salaryAreaCode
				from
				salary_pay p
				left join salary s on ( s.userid=p.userid )
				left join hrms h on (s.userid=h.user_id)
				left join department d on (p.deptid=d.dept_id)
				left join user u on (s.userid=u.user_id )
				left join oa_hr_personnel oah on(h.user_id=oah.userAccount) where s.userid=p.userid  and p.leaveflag='0'
				and ( p.comflag=1 or p.baseam not in ('mKyYBwAYs6OhZVIyCcao0A==','rayq0Lssv8erWaEbiLsxCg==')  )
				$sqlStr group by p.id order by s.comflag desc , s.id ";
			//echo $sql;
			//die();
			$query=$this->db->query($sql);
		}

		/**
		 * $row["cessebase"],
		 $this->salaryClass->decryptDeal($row["paycesse"]),
		 $this->salaryClass->decryptDeal($row["paytotal"]),
		 *
		 *
		 * $totalam=$this->salaryClass->decryptDeal($row["totalam"]);
		 $shbam=$this->salaryClass->decryptDeal($row["shbam"]);
		 $gjjam=$this->salaryClass->decryptDeal($row["gjjam"]);
		 $cessebase=$row["cessebase"]==2000?3000:$row["cessebase"];
		 $cesseam=round($totalam-$shbam-$gjjam,2);
		 $paycesse=$this->salaryClass->cesseDealNew($cesseam , $cessebase);
		 $payam=$this->salaryClass->getFinanceValue($cesseam - $paycesse);
		 *  $cessebase,
		 $paycesse,
		 $payam,
		 */
		if($stype=="1"){//����
			if($ck=='subcom'){
				if($_SESSION['USER_COM']=='sy'||$func_limit['���񷢷Ź�˾']=='sy'){
					while($row=$this->db->fetch_array($query)){
						$tmpt=$this->salaryClass->decryptDeal($row["totalam"]);
						$tmpshb=$this->salaryClass->decryptDeal($row["shbam"]);
						$tmpgjj=$this->salaryClass->decryptDeal($row["gjjam"]);
						$tmpyks=$tmpt-$tmpshb-$tmpgjj-$row["cessebase"];
						if($tmpyks<0){
							$tmpyks=0;
						}
						$tmpsl=$this->salaryClass->getCesseDeal($tmpt-$tmpshb-$tmpgjj);
						$data[]=array($row["id"],
								$row["comedt"],
								$row["pyear"]."-".$row["pmon"],
								$row["oldname"],
								$row["pdeptname"],
								$row["olddept"],
								$row["oldarea"],
								$this->salaryClass->decryptDeal($row["baseam"]),
								$this->salaryClass->decryptDeal($row["gwam"]),
								$this->salaryClass->decryptDeal($row["jxam"]),
								$this->salaryClass->decryptDeal($row["basenowam"]),
								$this->salaryClass->decryptDeal($row["floatam"]),
								$this->salaryClass->decryptDeal($row["proam"])+$this->salaryClass->decryptDeal($row["sdyam"]),
								$this->salaryClass->decryptDeal($row["otheram"]),
								$this->salaryClass->decryptDeal($row["bonusam"]),
								$this->salaryClass->decryptDeal($row["txjt"]),
								$this->salaryClass->decryptDeal($row["othdelam"])+$this->salaryClass->decryptDeal($row["spedelam"]),
								$this->salaryClass->decryptDeal($row["sperewam"]),
								$row["perholsdays"],
								$row["sickholsdays"],
								$this->salaryClass->decryptDeal($row["holsdelam"]),
								$tmpt,
								$tmpshb,
								$tmpgjj,
								$tmpshb+$tmpgjj,
								$tmpsl,
								$tmpyks,
								$this->salaryClass->decryptDeal($row["paycesse"]),
								$this->salaryClass->decryptDeal($row["accdelam"]),
								$this->salaryClass->decryptDeal($row["paytotal"]),
								$this->salaryClass->decryptDeal($row["coshbam"]),
								$this->salaryClass->decryptDeal($row["cogjjam"]),
								$this->salaryClass->decryptDeal($row["prepaream"]),
								$this->salaryClass->decryptDeal($row["handicapam"]),
								$this->salaryClass->decryptDeal($row["manageam"]),
								$row["acc"],
								$row["email"],
								$row["idcard"],
								$row["bank"],
								$row["remark"]);
					}
				}else{
					while($row=$this->db->fetch_array($query)){
						$data[]=array($row["id"],
								$row["comedt"],
								$row["pyear"]."-".$row["pmon"],
								$row["oldname"],
								$row["pdeptname"],
								$row["olddept"],
								$row["oldarea"],
								$this->salaryClass->decryptDeal($row["baseam"]),
								$this->salaryClass->decryptDeal($row["gwam"]),
								$this->salaryClass->decryptDeal($row["jxam"]),
								$this->salaryClass->decryptDeal($row["basenowam"]),
								$this->salaryClass->decryptDeal($row["floatam"]),
								$this->salaryClass->decryptDeal($row["proam"])+$this->salaryClass->decryptDeal($row["sdyam"]),
								$this->salaryClass->decryptDeal($row["otheram"]),
								$this->salaryClass->decryptDeal($row["bonusam"]),
								$this->salaryClass->decryptDeal($row["txjt"]),
								$this->salaryClass->decryptDeal($row["othdelam"])+$this->salaryClass->decryptDeal($row["spedelam"]),
								$this->salaryClass->decryptDeal($row["sperewam"]),
								$row["perholsdays"],
								$row["sickholsdays"],
								$this->salaryClass->decryptDeal($row["holsdelam"]),
								$this->salaryClass->decryptDeal($row["totalam"]),
								$this->salaryClass->decryptDeal($row["shbam"]),
								$this->salaryClass->decryptDeal($row["gjjam"]),
								$row["cessebase"],
								$this->salaryClass->decryptDeal($row["paycesse"]),
								$this->salaryClass->decryptDeal($row["accdelam"]),
								$this->salaryClass->decryptDeal($row["paytotal"]),
								$this->salaryClass->decryptDeal($row["coshbam"]),
								$this->salaryClass->decryptDeal($row["cogjjam"]),
								$this->salaryClass->decryptDeal($row["prepaream"]),
								$this->salaryClass->decryptDeal($row["handicapam"]),
								$this->salaryClass->decryptDeal($row["manageam"]),
								$row["acc"],
								$row["email"],
								$row["idcard"],
								$row["bank"],
								$row["remark"]);
					}
				}
			}else{
				while($row=$this->db->fetch_array($query)){
					$data[]=array($row["id"],
							$row["comedt"],
							$row["pyear"]."-".$row["pmon"],
							$row["oldname"],
							$row["pdeptname"],
							$row["olddept"],
							$row["oldarea"],
							$this->salaryClass->decryptDeal($row["baseam"]),
							$this->salaryClass->decryptDeal($row["gwam"]),
							$this->salaryClass->decryptDeal($row["jxam"]),
							$this->salaryClass->decryptDeal($row["basenowam"]),
							$this->salaryClass->decryptDeal($row["floatam"]),
							$this->salaryClass->decryptDeal($row["proam"])+$this->salaryClass->decryptDeal($row["sdyam"]),
							$this->salaryClass->decryptDeal($row["otheram"]),
							$this->salaryClass->decryptDeal($row["bonusam"]),
							$this->salaryClass->decryptDeal($row["txjt"]),
							$this->salaryClass->decryptDeal($row["othdelam"])+$this->salaryClass->decryptDeal($row["spedelam"]),
							$this->salaryClass->decryptDeal($row["sperewam"]),
							$row["perholsdays"],
							$row["sickholsdays"],
							$this->salaryClass->decryptDeal($row["holsdelam"]),
							$this->salaryClass->decryptDeal($row["totalam"]),
							$this->salaryClass->decryptDeal($row["shbam"]),
							$this->salaryClass->decryptDeal($row["gjjam"]),
							$row["cessebase"],
							$this->salaryClass->decryptDeal($row["paycesse"]),
							$this->salaryClass->decryptDeal($row["accdelam"]),
							$this->salaryClass->decryptDeal($row["paytotal"]),
							$this->salaryClass->decryptDeal($row["coshbam"]),
							$this->salaryClass->decryptDeal($row["cogjjam"]),
							$this->salaryClass->decryptDeal($row["prepaream"]),
							$this->salaryClass->decryptDeal($row["handicapam"]),
							$this->salaryClass->decryptDeal($row["manageam"]),
							$row["acc"],
							$row["email"],
							$row["idcard"],
							$row["bank"],
							$row["remark"]);
				}
			}
		}elseif($stype=="2"){//��˰
			while($row=$this->db->fetch_array($query)){
				if($row["comflag"]=='0'&&round($this->salaryClass->decryptDeal($row["totalam"]))==0){//���˶�����Ա���ý���˰
					continue;
				}
				$data[]=array('', $row["idcard"],$row["oldname"],'',
						'�¶ȹ���н��',
						$row["pyear"]."-".$row["pmon"].'-01',
						$row["pyear"]."-".$row["pmon"].'-'.date('t',strtotime($row["pyear"]."-".$row["pmon"].'-01')),
						$row["olddept"],
						$this->salaryClass->decryptDeal($row["totalam"]),
						$this->salaryClass->decryptDeal($row["shbam"]),
						$this->salaryClass->decryptDeal($row["gjjam"]),
						$row["cessebase"],
						'');
			}
		}elseif($stype=="3"){//����
			$x=0;
			while($row=$this->db->fetch_array($query)){
				if($row["comflag"]=='0'&&round($this->salaryClass->decryptDeal($row["paytotal"]))==0){//���˶�����Ա���ø���
					continue;
				}
				$x++;
				$data[]=array($x,
						//                    $this->salaryClass->decryptDeal($row["paytotal"]),
						//                    $row["bank"],
						//                    $row["acc"],
						//                    $row["oldname"],
						$row["acc"],
						$row["oldname"],
						$this->salaryClass->decryptDeal($row["paytotal"]),
						$row["salaryAreaCode"],
						'',
						'',
						'',
						0);
			}
		}elseif($stype=="4"){

			//'����','�ܹ��ʺϼ�','�籣��','������','����˰��','����۳��籣��������','˰��۳�','ʵ������','��������'
			$deptArr=array();
			while($row=$this->db->fetch_array($query)){
				$tam=$this->salaryClass->decryptDeal($row['totalam']);
				$sam=$this->salaryClass->decryptDeal($row['coshbam']);
				$gam=$this->salaryClass->decryptDeal($row['cogjjam']);
				$aam=$this->salaryClass->decryptDeal($row["accdelam"]);
				//����
				$jb=$this->salaryClass->decryptDeal($row['basenowam']);
				if(empty($jb)||round($jb)==0||$jb==0){
					$jb=round($this->salaryClass->decryptDeal($row['baseam'])
							+$this->salaryClass->decryptDeal($row['gwam'])
							+$this->salaryClass->decryptDeal($row['jxam'])
							,2);
				}
				//��������=��������+˰ǰ��������+˰�󲹷�����
				$jb=round($jb+$this->salaryClass->decryptDeal($row['sperewam'])
						+$this->salaryClass->decryptDeal($row['accrewam']),2);
				$xm=round($this->salaryClass->decryptDeal($row['proam'])
						+$this->salaryClass->decryptDeal($row['bonusam'])
						+$this->salaryClass->decryptDeal($row['floatam']),2);
				//�������ڼ��ղ������ɲͲ��� ����������������������������
				$bt=round($this->salaryClass->decryptDeal($row['sdyam']),2);
				$fl=round($this->salaryClass->decryptDeal($row['otheram']),2);
				$kc=round($this->salaryClass->decryptDeal($row['holsdelam'])
						+$this->salaryClass->decryptDeal($row['othdelam'])
						+$this->salaryClass->decryptDeal($row['spedelam'])
						+$this->salaryClass->decryptDeal($row['accdelam']),2);

				$tempam=round($tam-$sam-$gam,2);
				if($tempam<0){
					$tempam=abs($tempam);
				}else{
					$tempam=0;
				}
				$deptArr[$row['olddept']]['totalam']=isset($deptArr[$row['olddept']]['totalam'])?round($deptArr[$row['olddept']]['totalam']+$tam,2):$tam;
				$deptArr[$row['olddept']]['shbam']=isset($deptArr[$row['olddept']]['shbam'])?round($deptArr[$row['olddept']]['shbam']+$sam,2):$sam;
				$deptArr[$row['olddept']]['gjjam']=isset($deptArr[$row['olddept']]['gjjam'])?round($deptArr[$row['olddept']]['gjjam']+$gam,2):$gam;
				$deptArr[$row['olddept']]['paycesse']=isset($deptArr[$row['olddept']]['paycesse'])?round($deptArr[$row['olddept']]['paycesse']+$this->salaryClass->decryptDeal($row['paycesse']),2):$this->salaryClass->decryptDeal($row['paycesse']);
				$deptArr[$row['olddept']]['paytotal']=isset($deptArr[$row['olddept']]['paytotal'])?round($deptArr[$row['olddept']]['paytotal']+$this->salaryClass->decryptDeal($row['paytotal']),2):$this->salaryClass->decryptDeal($row['paytotal']);
				$deptArr[$row['olddept']]['count']=isset($deptArr[$row['olddept']]['count'])?$deptArr[$row['olddept']]['count']+1:1;
				$deptArr[$row['olddept']]['accdelam']=isset($deptArr[$row['olddept']]['accdelam'])?$deptArr[$row['olddept']]['accdelam']+$aam:$aam;
				$deptArr[$row['olddept']]['tempam']=isset($deptArr[$row['olddept']]['tempam'])?$deptArr[$row['olddept']]['tempam']+$tempam:$tempam;
				$deptArr[$row['olddept']]['pdeptname']=$row['pdeptname'];

				$deptArr[$row['olddept']]['jb']=isset($deptArr[$row['olddept']]['jb'])?round($deptArr[$row['olddept']]['jb']+$jb,2):$jb;
				$deptArr[$row['olddept']]['xm']=isset($deptArr[$row['olddept']]['xm'])?round($deptArr[$row['olddept']]['xm']+$xm,2):$xm;
				$deptArr[$row['olddept']]['bt']=isset($deptArr[$row['olddept']]['bt'])?round($deptArr[$row['olddept']]['bt']+$bt,2):$bt;
				$deptArr[$row['olddept']]['fl']=isset($deptArr[$row['olddept']]['fl'])?round($deptArr[$row['olddept']]['fl']+$fl,2):$fl;
				$deptArr[$row['olddept']]['kc']=isset($deptArr[$row['olddept']]['kc'])?round($deptArr[$row['olddept']]['kc']+$kc,2):$kc;
			}
			foreach ($deptArr as $key=>$val) {
				$data[]=array($val['pdeptname'],$key,
						$val['jb'],
						$val['xm'],
						$val['bt'],
						$val['fl'],
						$val['kc'],
						$val['totalam'],
						$val['shbam'],
						$val['gjjam'],
						$val['paycesse'],
						$val['tempam'],
						$val['accdelam'],
						$val['paytotal'],
						$val['count']
					     );
			}

		}elseif($stype=='pro'){


		}elseif($stype=='6'){
			$deptArr=array();
			$deptCh=array();
			while($row=$this->db->fetch_array($query)){
				$deptCh[$row['dept_id']]=1;
				$deptArr[$row['dept_id']][$row['pmon']]['totalam']=
					isset($deptArr[$row['dept_id']][$row['pmon']]['totalam'])?
					round($deptArr[$row['dept_id']][$row['pmon']]['totalam']+$this->salaryClass->decryptDeal($row['totalam']),2):
					$this->salaryClass->decryptDeal($row['totalam']);
				$deptArr[$row['dept_id']][$row['pmon']]['shbam']=
					isset($deptArr[$row['dept_id']][$row['pmon']]['shbam'])?
					round($deptArr[$row['dept_id']][$row['pmon']]['shbam']+$this->salaryClass->decryptDeal($row['shbam']),2):
					$this->salaryClass->decryptDeal($row['shbam']);
				$deptArr[$row['dept_id']][$row['pmon']]['gjjam']=
					isset($deptArr[$row['dept_id']][$row['pmon']]['gjjam'])?
					round($deptArr[$row['dept_id']][$row['pmon']]['gjjam']+$this->salaryClass->decryptDeal($row['gjjam']),2):
					$this->salaryClass->decryptDeal($row['gjjam']);
				$deptArr[$row['dept_id']][$row['pmon']]['paycesse']=
					isset($deptArr[$row['dept_id']][$row['pmon']]['paycesse'])?
					round($deptArr[$row['dept_id']][$row['pmon']]['paycesse']+$this->salaryClass->decryptDeal($row['paycesse']),2):
					$this->salaryClass->decryptDeal($row['paycesse']);
				$deptArr[$row['dept_id']][$row['pmon']]['paytotal']=
					isset($deptArr[$row['dept_id']][$row['pmon']]['paytotal'])?
					round($deptArr[$row['dept_id']][$row['pmon']]['paytotal']+$this->salaryClass->decryptDeal($row['paytotal']),2):
					$this->salaryClass->decryptDeal($row['paytotal']);
			}
			if(!empty($deptCh)){
				$sql="SELECT d.dept_name,d.dept_id , df.dept_name as df_dept_name  FROM department d
					left join department df on ( left(d.depart_x,2)=df.depart_x )
					where d.dept_id in ('".implode("','", array_keys($deptCh))."')  group by d.dept_id order by df.dept_name ";
				$query=$this->db->query($sql);
				$deptCh=array();
				while($row=$this->db->fetch_array($query)){
					$deptCh[$row['dept_id']]['df']=$row['df_dept_name'];
					$deptCh[$row['dept_id']]['dn']=$row['dept_name'];
				}
			}
			foreach ($deptCh as $key=>$val) {
				$tam=round( $deptArr[$key]['1']['totalam']+$deptArr[$key]['2']['totalam']+$deptArr[$key]['3']['totalam']
						+$deptArr[$key]['4']['totalam']+$deptArr[$key]['5']['totalam']+$deptArr[$key]['6']['totalam']
						+$deptArr[$key]['7']['totalam']+$deptArr[$key]['8']['totalam']+$deptArr[$key]['9']['totalam']
						+$deptArr[$key]['10']['totalam']+$deptArr[$key]['11']['totalam']+$deptArr[$key]['12']['totalam'],2);
				$shbam=round( $deptArr[$key]['1']['shbam']+$deptArr[$key]['2']['shbam']+$deptArr[$key]['3']['shbam']
						+$deptArr[$key]['4']['shbam']+$deptArr[$key]['5']['shbam']+$deptArr[$key]['6']['shbam']
						+$deptArr[$key]['7']['shbam']+$deptArr[$key]['8']['shbam']+$deptArr[$key]['9']['shbam']
						+$deptArr[$key]['10']['shbam']+$deptArr[$key]['11']['shbam']+$deptArr[$key]['12']['shbam'],2);
				$gjjam=round( $deptArr[$key]['1']['gjjam']+$deptArr[$key]['2']['gjjam']+$deptArr[$key]['3']['gjjam']
						+$deptArr[$key]['4']['gjjam']+$deptArr[$key]['5']['gjjam']+$deptArr[$key]['6']['gjjam']
						+$deptArr[$key]['7']['gjjam']+$deptArr[$key]['8']['gjjam']+$deptArr[$key]['9']['gjjam']
						+$deptArr[$key]['10']['gjjam']+$deptArr[$key]['11']['gjjam']+$deptArr[$key]['12']['gjjam'],2);
				$paycesse=round( $deptArr[$key]['1']['paycesse']+$deptArr[$key]['2']['paycesse']+$deptArr[$key]['3']['paycesse']
						+$deptArr[$key]['4']['paycesse']+$deptArr[$key]['5']['paycesse']+$deptArr[$key]['6']['paycesse']
						+$deptArr[$key]['7']['paycesse']+$deptArr[$key]['8']['paycesse']+$deptArr[$key]['9']['paycesse']
						+$deptArr[$key]['10']['paycesse']+$deptArr[$key]['11']['paycesse']+$deptArr[$key]['12']['paycesse'],2);
				$paytotal=round( $deptArr[$key]['1']['paytotal']+$deptArr[$key]['2']['paytotal']+$deptArr[$key]['3']['paytotal']
						+$deptArr[$key]['4']['paytotal']+$deptArr[$key]['5']['paytotal']+$deptArr[$key]['6']['paytotal']
						+$deptArr[$key]['7']['paytotal']+$deptArr[$key]['8']['paytotal']+$deptArr[$key]['9']['paytotal']
						+$deptArr[$key]['10']['paytotal']+$deptArr[$key]['11']['paytotal']+$deptArr[$key]['12']['paytotal'],2);
				$data[]=array($val['df'],$val['dn']
						,$tam,$shbam,$gjjam,$paycesse,$paytotal
						,$deptArr[$key]['1']['totalam'],$deptArr[$key]['1']['shbam'],$deptArr[$key]['1']['gjjam'],$deptArr[$key]['1']['paycesse'],$deptArr[$key]['1']['paytotal']
						,$deptArr[$key]['2']['totalam'],$deptArr[$key]['2']['shbam'],$deptArr[$key]['2']['gjjam'],$deptArr[$key]['2']['paycesse'],$deptArr[$key]['2']['paytotal']
						,$deptArr[$key]['3']['totalam'],$deptArr[$key]['3']['shbam'],$deptArr[$key]['3']['gjjam'],$deptArr[$key]['3']['paycesse'],$deptArr[$key]['3']['paytotal']
						,$deptArr[$key]['4']['totalam'],$deptArr[$key]['4']['shbam'],$deptArr[$key]['4']['gjjam'],$deptArr[$key]['4']['paycesse'],$deptArr[$key]['4']['paytotal']
						,$deptArr[$key]['5']['totalam'],$deptArr[$key]['5']['shbam'],$deptArr[$key]['5']['gjjam'],$deptArr[$key]['5']['paycesse'],$deptArr[$key]['5']['paytotal']
						,$deptArr[$key]['6']['totalam'],$deptArr[$key]['6']['shbam'],$deptArr[$key]['6']['gjjam'],$deptArr[$key]['6']['paycesse'],$deptArr[$key]['6']['paytotal']
						,$deptArr[$key]['7']['totalam'],$deptArr[$key]['7']['shbam'],$deptArr[$key]['7']['gjjam'],$deptArr[$key]['7']['paycesse'],$deptArr[$key]['7']['paytotal']
						,$deptArr[$key]['8']['totalam'],$deptArr[$key]['8']['shbam'],$deptArr[$key]['8']['gjjam'],$deptArr[$key]['8']['paycesse'],$deptArr[$key]['8']['paytotal']
						,$deptArr[$key]['9']['totalam'],$deptArr[$key]['9']['shbam'],$deptArr[$key]['9']['gjjam'],$deptArr[$key]['9']['paycesse'],$deptArr[$key]['9']['paytotal']
						,$deptArr[$key]['10']['totalam'],$deptArr[$key]['10']['shbam'],$deptArr[$key]['10']['gjjam'],$deptArr[$key]['10']['paycesse'],$deptArr[$key]['10']['paytotal']
						,$deptArr[$key]['11']['totalam'],$deptArr[$key]['11']['shbam'],$deptArr[$key]['11']['gjjam'],$deptArr[$key]['11']['paycesse'],$deptArr[$key]['11']['paytotal']
						,$deptArr[$key]['12']['totalam'],$deptArr[$key]['12']['shbam'],$deptArr[$key]['12']['gjjam'],$deptArr[$key]['12']['paycesse'],$deptArr[$key]['12']['paytotal']
					     );
			}
		}elseif($stype=="7"||$stype=="hr"){
			$userData=array();
			while($row=$this->db->fetch_array($query)){
				$userData[$row['id']]=array(
						'id'=>$row["id"],
						'comedt'=>$row["comedt"],
						'pyear'=>$row["pyear"],
						'name'=>$row["oldname"],
						'pdept'=>$row["pdeptname"],
						'dept'=>$row["olddept"],
						'area'=>$row["oldarea"],
						'baseam'=>round($this->salaryClass->decryptDeal($row["baseam"])+$userData[$row['id']]['baseam'],2),
						'basenowam'=>round($this->salaryClass->decryptDeal($row["basenowam"])+$userData[$row['id']]['basenowam'],2),
						'floatam'=>round($this->salaryClass->decryptDeal($row["floatam"])+$userData[$row['id']]['floatam'],2),
						'ps'=>round($this->salaryClass->decryptDeal($row["proam"])+$this->salaryClass->decryptDeal($row["sdyam"])+$userData[$row['id']]['ps'],2),
						'otheram'=>round($this->salaryClass->decryptDeal($row["otheram"])+$userData[$row['id']]['otheram'],2),
						'bonusam'=>round($this->salaryClass->decryptDeal($row["bonusam"])+$userData[$row['id']]['bonusam'],2),
						'os'=>round($this->salaryClass->decryptDeal($row["othdelam"])+$this->salaryClass->decryptDeal($row["spedelam"])+$userData[$row['id']]['os'],2),
						'sperewam'=>round($this->salaryClass->decryptDeal($row["sperewam"])+$userData[$row['id']]['sperewam'],2),
						'perholsdays'=>round($row["perholsdays"]+$userData[$row['id']]['perholsdays']),
						'sickholsdays'=>round($row["sickholsdays"]+$userData[$row['id']]['sickholsdays']),
						'holsdelam'=>round($this->salaryClass->decryptDeal($row["holsdelam"])+$userData[$row['id']]['holsdelam'],2),
						'totalam'=>round($this->salaryClass->decryptDeal($row["totalam"])+$userData[$row['id']]['totalam'],2),
						'shbam'=>round($this->salaryClass->decryptDeal($row["shbam"])+$userData[$row['id']]['shbam'],2),
						'gjjam'=>round($this->salaryClass->decryptDeal($row["gjjam"])+$userData[$row['id']]['gjjam'],2),
						'cessebase'=>$row["cessebase"],
						'paycesse'=>round($this->salaryClass->decryptDeal($row["paycesse"])+$userData[$row['id']]['paycesse'],2),
						'paytotal'=>round($this->salaryClass->decryptDeal($row["paytotal"])+$userData[$row['id']]['paytotal'],2),
						'acc'=>$row["acc"],
						'email'=>$row["email"],
						'idcard'=>$row["idcard"],
						'bank'=>$row["bank"],
						'expflag'=>$this->expflag[$row["expflag"]],
						'usercard'=>$row["usercard"],
						'userlevel'=>$this->userLevel[$row["userlevel"]]
							);
			}
			/**
			 * ���ս�����
			 */
			$sql="select
				y.yearam , y.payam , y.paycesseam , s.id
				from salary_yeb y
				left join hrms h on (y.usercard=h.usercard)
				left join salary s on (h.user_id=s.userid)
				where
				y.syear='".$syear."' and s.id is not null  ";
			$query=$this->db->query($sql);
			while($row=$this->db->fetch_array($query) ){
				if(!empty($userData[$row['id']])){
					$userData[$row['id']]['yam']=$this->salaryClass->decryptDeal($row["yearam"]);
					$userData[$row['id']]['pceam']=$this->salaryClass->decryptDeal($row["paycesseam"]);
					$userData[$row['id']]['payam']=$this->salaryClass->decryptDeal($row["payam"]);
				}
			}
			if($stype=='7'){
				foreach($userData as $key=>$val){
					$data[]=array($val['id'],
							$val["expflag"],
							$val["comedt"],
							$val["pyear"],
							$val["name"],
							$val["pdept"],
							$val["dept"],
							$val["area"],
							$val["baseam"],
							$val["basenowam"],
							$val["floatam"],
							$val["ps"],
							$val["otheram"],
							$val["bonusam"],
							$val["os"],
							$val["sperewam"],
							$val["perholsdays"],
							$val["sickholsdays"],
							$val["holsdelam"],
							$val["totalam"],
							$val["shbam"],
							$val["gjjam"],
							$val["cessebase"],
							$val["paycesse"],
							$val["paytotal"],
							$val["yam"],
							$val["pceam"],
							$val["payam"]);
				}
			}elseif($stype=="hr"){
				foreach($userData as $key=>$val){
					$data[]=array($val['id'],
							$val['usercard'],
							$val['userlevel'],
							$val["expflag"],
							$val["comedt"],
							$val["pyear"],
							$val["name"],
							$val["dept"],
							$val["area"],
							$val["baseam"],
							$val["basenowam"],
							$val["floatam"],
							$val["ps"],
							$val["otheram"],
							$val["bonusam"],
							$val["os"],
							$val["sperewam"],
							$val["perholsdays"],
							$val["sickholsdays"],
							$val["holsdelam"],
							$val["totalam"],
							$val["shbam"],
							$val["gjjam"],
							$val["cessebase"],
							$val["paycesse"],
							$val["paytotal"],
							$val["yam"],
							$val["pceam"],
							$val["payam"]);
				}
			}
		}
		if($stype=='5'){
			$data=array();
			$mastoData=array('��нʱ��','����','Ա����','��������','��λ����','��Ч����'
					,'�ܹ��ʺϼ�','�籣��','������','����˰��','ʵ������');
			$mastoDataP=array('��нʱ��','����','Ա����','��������','��λ����','��Ч����'
					,'����ϵ��','����ϵ��','��Ŀ��Ч����','��Ŀ������','��Ŀ���Բ���','��Ч����','��Ŀͨ�Ų���'
					,'�ܹ��ʺϼ�','�籣��','������','����˰��','ʵ������');
			//��������ʾ�Ĳ��ţ�ͨ�ŷ�����ҵ������ķ���ִ�в���1��~��8�������ܲ�Ʒ�����Ŷӡ�����ר������ķ��񲿡�����ר�����񲿣�
			$arr=array("1602","1702","1802","1902","2002","2102","2201","2302");
			while($row=$this->db->fetch_array($query)){
				if($row["nowamflag"]=='4'){//���˶�����Ա
					continue;
				}
				$nowam=$this->salaryClass->decryptDeal($row["basenowam"]);
				if(($nowam==0||$nowam=='')&&$row['company']!='dl' ){
					$nowam=$this->salaryClass->decryptDeal($row["baseam"]);
				}

				if(in_array($row["Depart_x"],$arr)){
					$data[]=array(
							'��нʱ��'=>$row["pyear"]."-".$row["pmon"],
							'����'=>$row["oldname"],
							'Ա����'=>$row["usercard"],
							'��������'=>$this->salaryClass->decryptDeal($row["baseam"]),
							'��λ����'=>$this->salaryClass->decryptDeal($row["gwam"]),
							'��Ч����'=>$this->salaryClass->decryptDeal($row["jxam"]),
							'���¹���'=>$nowam,
							'��������'=>$this->salaryClass->decryptDeal($row["floatam"]),
							'����ϵ��'=>$row["ccxs"],
							'����ϵ��'=>$row["khxs"],
							'��Ŀ��Ч����'=>$this->salaryClass->decryptDeal($row["jjam"]),
							'��Ŀ������'=>$this->salaryClass->decryptDeal($row["gljtam"]),
							'��Ŀ���Բ���'=>$this->salaryClass->decryptDeal($row["qtjtam"]),
							'��Ч����'=>$this->salaryClass->decryptDeal($row["jxzcam"]),
							'��Ŀס�޲���'=>$this->salaryClass->decryptDeal($row["lszsam"]),
							'��Ŀͨ�Ų���'=>$this->salaryClass->decryptDeal($row["txjt"]),

							'�ڼ��ղ���'=>$this->salaryClass->decryptDeal($row["sdyam"]),
							'��������'=>$this->salaryClass->decryptDeal($row["otheram"]),

							'����'=>$this->salaryClass->decryptDeal($row["sperewam"]),
							'�۳�'=>$this->salaryClass->decryptDeal($row["spedelam"]),
							'�¼�'=>$row["perholsdays"],'����'=>$row["sickholsdays"],
							'����ٹ���'=>$this->salaryClass->decryptDeal($row["holsdelam"]),
							'�ܹ��ʺϼ�'=>$this->salaryClass->decryptDeal($row["totalam"]),
							'�籣��'=>$this->salaryClass->decryptDeal($row["shbam"]),
							'������'=>$this->salaryClass->decryptDeal($row["gjjam"]),
							'����˰��'=>$this->salaryClass->decryptDeal($row["paycesse"]),
							'˰��ۿ�'=>$this->salaryClass->decryptDeal($row["accdelam"]),
							'˰����'=>$this->salaryClass->decryptDeal($row["accrewam"]),
							'ʵ������'=>$this->salaryClass->decryptDeal($row["paytotal"]),
							'��ע'=>$row["remark"],
							'���֤'=>$row["idcard"],
							'����'=>$row["email"],
							'Depart_x'=>$row["Depart_x"]
								);
				}else{
					$data[]=array(
							'��нʱ��'=>$row["pyear"]."-".$row["pmon"],
							'����'=>$row["oldname"],
							'Ա����'=>$row["usercard"],
							'��������'=>$this->salaryClass->decryptDeal($row["baseam"]),
							'��λ����'=>$this->salaryClass->decryptDeal($row["gwam"]),
							'��Ч����'=>$this->salaryClass->decryptDeal($row["jxam"]),
							'���¹���'=>$nowam,
							'��������'=>$this->salaryClass->decryptDeal($row["floatam"]),
							'��Ŀ����'=>$this->salaryClass->decryptDeal($row["proam"]),
							'�ڼ��ղ���'=>$this->salaryClass->decryptDeal($row["sdyam"]),
							'��������'=>$this->salaryClass->decryptDeal($row["otheram"]),
							'����'=>$this->salaryClass->decryptDeal($row["bonusam"]),
							'��Ч����'=>$this->salaryClass->decryptDeal($row["jxzcam"]),
							'ͨ�Ž���'=>$this->salaryClass->decryptDeal($row["txjt"]),
							'����'=>$this->salaryClass->decryptDeal($row["sperewam"]),
							'�۳�'=>$this->salaryClass->decryptDeal($row["spedelam"]),
							'�¼�'=>$row["perholsdays"],'����'=>$row["sickholsdays"],
							'����ٹ���'=>$this->salaryClass->decryptDeal($row["holsdelam"]),
							'�ܹ��ʺϼ�'=>$this->salaryClass->decryptDeal($row["totalam"]),
							'�籣��'=>$this->salaryClass->decryptDeal($row["shbam"]),
							'������'=>$this->salaryClass->decryptDeal($row["gjjam"]),
							'����˰��'=>$this->salaryClass->decryptDeal($row["paycesse"]),
							'˰��ۿ�'=>$this->salaryClass->decryptDeal($row["accdelam"]),
							'˰����'=>$this->salaryClass->decryptDeal($row["accrewam"]),
							'ʵ������'=>$this->salaryClass->decryptDeal($row["paytotal"]),
							'��ע'=>$row["remark"],
							'���֤'=>$row["idcard"],
							'����'=>$row["email"],
							'Depart_x'=>$row["Depart_x"]
								);
				}

			}
			$csd=false;
			foreach($data as $val){
				/* if($val["����"]!='jianwu2.quan@dinglicom.com'){
				   continue;
				   }

				   if($val["����"]=='guiling.li@dinglicom.com'){
				   continue;
				   }
				   if($val["����"]=='keqin.liang@dinglicom.com'){
				   $csd=true;
				   continue;
				   }
				   if($csd==false){
				   continue;
				   }*/


				if(empty($val["����"]) || $val["ʵ������"] == 0 || $val["ʵ������"] == "0"){//���˿�����-������Ա
					continue;
				}
				$str="���ã����Ĺ������ύ��ͨ����ˣ��������������պ���չ��ʣ�<br/>";
				$strTR="";
				//$mastoDataT = ( $val["Depart_x"]==58 || $val["Depart_x"]==59 ) ? $mastoDataP : $mastoData ;
				if(in_array($val["Depart_x"],$arr)){
					$mastoDataT=$mastoDataP;
				}else{
					$mastoDataT=$mastoData;
				}

				foreach ($val as $vkey=>$vval){
					if($vkey!='����'&&$vkey!='Depart_x'){
						if(in_array($vkey,$mastoDataT)||($vval!='0'&&$vval!='')){
							$strTR.="<tr><td>$vkey</td>";
							$strTR.="<td>
								$vval
								</td></tr>";
						}
					}
				}
				$str.="<table border='1' cellspacing='1' cellpadding='1'>$strTR</table>";
				$str.="<div style='margin-top:20px;'>˵����<br/>
					1�����ʼ��漰����н����Ϣ��������⹫����<br/>
					2��������Թ�����Ϣ�������ʣ���������ϸ��������㣬�������ʼ�����������<br/>�������ַ��hr-dept@dinglicom.com����������Դ�������յ����2�����������������ɣ�����֪Ϥ��лл��</div>";
				$this->model_send_email("������Ϣ",$str,$val["����"],true,true);
			}
			echo '1';
		}else{
			$xls->addArray($data);
			$xls->generateXML('salary'.'-'.$syear.'-'.$smon);
		}

	} catch (Exception $e) {
		echo $e->getMessage();
	}
}
/**
 * �������ɹ�����
 */
function model_hr_email_exp(){
	set_time_limit(600);
	$seapy=$_POST['seapy'];
	$seapm=$_POST['seapm'];
	$seaty=$_POST['seaty'];
	if($seaty=='ymd'){
		$currentYear = date('Y');//���

		$sql="select
			s.username  , s.olddept  , s.amount , s.email
			, s.gwam , s.jxam
			from salary_flow f
			left join salary s on (f.userid=s.userid)
			where
			f.createuser='".$_SESSION['USER_ID']."'
			and f.flowname in ( '��ȵ�н' )
			and f.pyear='".$currentYear."'
			and f.sta='2'
			group by s.userid
			order by s.username desc";
		$query=$this->db->query($sql);
		$data=array();
		while($row=$this->db->fetch_array($query)){
			$data[]=array(
					'name'=>$row["username"],
					'dept'=>$row["olddept"],
					'amount'=>$this->salaryClass->decryptDeal($row["amount"]),
					'gwam'=>$this->salaryClass->decryptDeal($row["gwam"]),
					'jxam'=>$this->salaryClass->decryptDeal($row["jxam"]),
					'email'=>$row["email"]
				     );
		}
		foreach($data as $val){
			$str='';
			if(!empty($val)){
				$str=<<<EOD
					<div style='font-size:10pt;'>
					{$val['dept']}  {$val['name']}<br/>
				<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;�����г���ԭ���빫˾��չ����Ӧ��ԭ�򣬹�˾���ݲ�ͬԱ���Ĺ���ְ����ְ�������г�н�����ݼ�����ȼ�Ч���˽�����Բ��ָ�λ�Ļ����������˲�ͬ�̶ȵĵ�����<br/><br/>
					&nbsp;&nbsp;&nbsp;&nbsp;��{$currentYear}��4�������Ļ������ʵ���Ϊ��{$val['amount']}����λ���ʣ�{$val['gwam']}����Ч���ʣ�{$val['jxam']}<br/><br/>
					&nbsp;&nbsp;&nbsp;&nbsp;���ϸ��ܸ��˹�����Ϣ�����Ͻ���̽��͸¶��˾�κ��˵Ĺ�����Ϣ��Υ���Խ���Ͷ���ͬ����<br/><br/>
					&nbsp;&nbsp;&nbsp;&nbsp;������֮���������������ܼ��������Դ���ܼ���ѯ��<br/>
					<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;�������ݣ�����֪Ϥ��лл<br/><br/>
					<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�麣���Ͷ���ͨ�ſƼ��ɷ����޹�˾<br/><br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$currentYear}��4��<br/>
					</div>
					EOD;
				$this->model_send_email("��н֪ͨ",$str, $val['email'],true,true);
			}
		}
	}elseif(!empty($seapy)&&!empty($seapm)){
		$sql="select
			s.id , p.id as pid , s.userid , u.user_name as username , s.oldname
			, s.accbank as bank, s.comedt , d.dept_name , if(p.salarydept is null , s.olddept , p.salarydept ) as olddept
			, s.oldarea , s.email , p.area , p.pyear ,p.pmon , p.baseam
			, p.basenowam , p.floatam , p.proam , p.otheram , p.bonusam
			, p.perholsdays , p.sickholsdays, p.holsdelam , p.totalam
			, p.gjjam , p.shbam , p.cessebase , p.paycesse , p.paytotal
			, p.othdelam , s.acc , h.address , s.sta ,s.idcard , h.card_no
			, p.sperewam , p.cogjjam ,p.coshbam ,p.prepaream ,p.handicapam
			, p.manageam , p.sdyam , p.spedelam
			, h.usercard , h.expflag , h.userlevel , p.remark
			from
			salary_pay p
			left join salary s on ( s.userid=p.userid )
			left join hrms h on (s.userid=h.user_id)
			left join department d on (s.deptid=d.dept_id)
			left join user u on (s.userid=u.user_id )
			where s.userid=p.userid  and p.leaveflag='0' and h.expflag='1'
			and p.pyear='".$seapy."' and p.pmon='".$seapm."' group by p.id order by s.id ";
		$query=$this->db->query($sql);
		$data=array();
		$mastoData=array('��нʱ��','����','Ա����','��������','�ܹ��ʺϼ�','�籣��','������','����˰��','ʵ������');
		while($row=$this->db->fetch_array($query)){
			$data[]=array(
					'��нʱ��'=>$row["pyear"]."-".$row["pmon"],
					'����'=>$row["oldname"],
					'Ա����'=>$row["usercard"],
					'��������'=>$this->salaryClass->decryptDeal($row["baseam"]),
					'������ְ����'=>$this->salaryClass->decryptDeal($row["basenowam"]),
					'��������'=>$this->salaryClass->decryptDeal($row["floatam"]),
					'��Ŀ����'=>$this->salaryClass->decryptDeal($row["proam"]),
					'�Ͳ�'=>$this->salaryClass->decryptDeal($row["sdyam"]),
					'��������'=>$this->salaryClass->decryptDeal($row["otheram"]),
					'����'=>$this->salaryClass->decryptDeal($row["bonusam"]),
					'����'=>$this->salaryClass->decryptDeal($row["sperewam"]),
					'�۳�'=>$this->salaryClass->decryptDeal($row["spedelam"]),
					'�¼�'=>$row["perholsdays"],'����'=>$row["sickholsdays"],
					'����ٹ���'=>$this->salaryClass->decryptDeal($row["holsdelam"]),
					'�ܹ��ʺϼ�'=>$this->salaryClass->decryptDeal($row["totalam"]),
					'�籣��'=>$this->salaryClass->decryptDeal($row["shbam"]),
					'������'=>$this->salaryClass->decryptDeal($row["gjjam"]),
					'����˰��'=>$this->salaryClass->decryptDeal($row["paycesse"]),
					'ʵ������'=>$this->salaryClass->decryptDeal($row["paytotal"]),
					'��ע'=>$row["remark"],
					'����'=>$row["email"]
						);
		}
		$csd=false;
		foreach($data as $val){
			$str="���ã����Ĺ�����Ϣ���£���֪����<br/>";
			$strTR="";
			foreach ($val as $vkey=>$vval){
				if($vkey!='����'){
					if(in_array($vkey,$mastoData)||($vval!='0'&&$vval!='')){
						//if(is_numeric($vval)&&$vval<0){
						// $vval=0;
						//}
						$strTR.="<tr><td>$vkey</td>";
						$strTR.="<td>$vval</td></tr>";
					}
				}
			}
			$str.="<table border='1' cellspacing='1' cellpadding='1'>$strTR</table>";
			$this->model_send_email("������Ϣ",$str,$val["����"],true,true);
		}
	}
	echo '1';
}
/**
 * ����
 */
function model_dp_sdy_new_in(){
	$id = $_POST['id'];
	$sub= $_POST['sub'];
	$meal=$_POST['meal'];
	$other=$_POST['other'];
	$remark=$_POST['remark'];
	$sm=false;
	try {
		$this->db->query("START TRANSACTION");
		if($sub=='new'){
			if(!$id||!trim($id)){
				throw new Exception('no user id');
			}
			if(!$_SESSION['USER_ID']){
				throw new Exception('time out');
			}
			$tmpua=explode(',', $id);
			$sql="select p.id , p.userid , h.userlevel , p.sdyam , p.otheram
				from
				salary_pay p
				left join hrms h on (p.userid=h.user_id)
				where
				p.pyear='".$this->nowy."' and p.pmon='".$this->nowm."'
				and p.userid in ('".implode("','", $tmpua)."')";
			$query=$this->db->query($sql);
			$tmpua=array();
			while($row=$this->db->fetch_array($query)){
				$tmpua[$row['userid']]['pid']=$row['id'];
				$tmpua[$row['userid']]['sdyam']=$this->salaryClass->decryptDeal($row['sdyam']);
				$tmpua[$row['userid']]['otheram']=$this->salaryClass->decryptDeal($row['otheram']);
			}
			if(!empty($tmpua)){
				foreach($tmpua as $key=>$val){
					if(empty($val)||empty($key)){
						continue;
					}
					$sql="insert into salary_sdy
						(userid , sdymeal , sdyother
						 , creator , createdt
						 , pyear , pmon , remark , rand_key )
						values
						('".$key."','".$this->salaryClass->encryptDeal($meal) ."','".$this->salaryClass->encryptDeal($other) ."'
						 , '".$_SESSION['USER_ID']."' , now()
						 , '".$this->nowy."', '".$this->nowm."' , '".$remark."' ,'".get_rand_key()."')  ";
					$this->db->query_exc($sql);
					$this->model_pay_update($val['pid'],
							array('sdyam'=>ceil($meal+$val['sdyam']),'otheram'=>ceil($other+$val['otheram']),'remark'=>$remark)
							,array(2)
							);
					$this->model_pay_stat($val['pid']);
				}
			}
		}elseif($sub=='edit'){
			$sql="select s.userid , p.id , s.sdymeal , s.sdyother , p.sdyam , p.otheram
				from salary_sdy s
				left join salary_pay p on ( s.userid=p.userid and s.pyear=p.pyear and s.pmon=p.pmon )
				where s.rand_key='".$id."' ";
			$res=$this->db->get_one($sql);
			if(empty($res)||!$res['userid']||!$res['id']){
				throw new Exception('Data error');
			}
			$oldMeal=$this->salaryClass->decryptDeal($res['sdymeal']);
			$oldOther=$this->salaryClass->decryptDeal($res['sdyother']);
			$paySdy=$this->salaryClass->decryptDeal($res['sdyam']);
			$payOther=$this->salaryClass->decryptDeal($res['otheram']);
			$sql="update salary_sdy
				set sdymeal='".$this->salaryClass->encryptDeal($meal)."'
				, sdyother='".$this->salaryClass->encryptDeal($other)."'
				, createdt=now()
				, remark ='".$remark."'
				where rand_key='".$id."' ";
			$this->db->query_exc($sql);
			$this->model_pay_update($res['id'],
					array('sdyam'=>ceil($paySdy-$oldMeal+$meal),'otheram'=>ceil($payOther-$oldOther+$other),'remark'=>$remark)
					,array(2)
					);
			$this->model_pay_stat($res['id']);
		}elseif($sub=='del'){
			$sql="select s.userid , p.id , s.sdymeal , s.sdyother , p.sdyam , p.otheram
				from salary_sdy s
				left join salary_pay p on ( s.userid=p.userid and s.pyear=p.pyear and s.pmon=p.pmon )
				where s.rand_key='".$id."' ";
			$res=$this->db->get_one($sql);
			if(empty($res)||!$res['userid']||!$res['id']){
				throw new Exception('Data error');
			}
			$oldMeal=$this->salaryClass->decryptDeal($res['sdymeal']);
			$oldOther=$this->salaryClass->decryptDeal($res['sdyother']);
			$paySdy=$this->salaryClass->decryptDeal($res['sdyam']);
			$payOther=$this->salaryClass->decryptDeal($res['otheram']);

			$sql="delete from  salary_sdy where rand_key='".$id."' ";
			$this->db->query_exc($sql);
			$this->model_pay_update($res['id'],
					array('sdyam'=>ceil($paySdy-$oldMeal),'otheram'=>ceil($payOther-$oldOther),'remark'=>$remark)
					,array(2)
					);
			$this->model_pay_stat($res['id']);
		}elseif($sub=='xls'){
			$temparr=array();
			$sql="select
				s.userid , p.id , s.sdymeal , s.sdyother , s.rand_key , p.sdyam , p.otheram
				from salary_sdy s
				left join salary_pay p on ( s.userid=p.userid and s.pyear=p.pyear and s.pmon=p.pmon )
				where
				s.creator='".$_SESSION['USER_ID']."'
				and s.pyear='".$this->nowy."' and s.pmon='".$this->nowm."'
				and s.staflag='1' ";
			$query=$this->db->query($sql);
			while($row=$this->db->fetch_array($query)){
				$temparr[$row['rand_key']]['userid']=$row['userid'];
				$temparr[$row['rand_key']]['id']=$row['id'];
				$temparr[$row['rand_key']]['sdymeal']=$this->salaryClass->decryptDeal($row['sdymeal']);
				$temparr[$row['rand_key']]['sdyother']=$this->salaryClass->decryptDeal($row['sdyother']);
				$temparr[$row['rand_key']]['sdyam']=$this->salaryClass->decryptDeal($row['sdyam']);
				$temparr[$row['rand_key']]['otheram']=$this->salaryClass->decryptDeal($row['otheram']);
			}
			if(!empty($temparr)){
				foreach($temparr as $key=>$val){
					if(empty($val)||empty($key)){
						continue;
					}
					$sql="update salary_sdy set staflag='0' where rand_key='".$key."'";
					$this->db->query_exc($sql);
					$this->model_pay_update($val['id'],
							array('sdyam'=>ceil($val['sdymeal']+$val['sdyam']),'otheram'=>ceil($val['sdyother']+$val['otheram']),'remark'=>$remark)
							,array(2)
							);
					$this->model_pay_stat($val['id']);
				}
			}
		}
		$this->db->query("COMMIT");
		$responce->id = $id;
		$this->globalUtil->insertOperateLog('���ʹ���', $id, '����', '�ɹ�');
	} catch (Exception $e) {
		$this->db->query("ROLLBACK");
		$responce->error = $e->getMessage();
		$this->globalUtil->insertOperateLog('���ʹ���', $id, '����', 'ʧ��', $e->getMessage());
	}
	return $responce;
}
/**
 * �����б�
 */
function model_dp_sdy_list(){
	$page = $_GET['page'];
	$limit = $_GET['rows'];
	$sidx = $_GET['sidx'];
	$sord = $_GET['sord'];
	$schOper = $_GET['searchOper'];
	$schStr = $_GET['searchString'];
	$schField = $_GET['searchField'];
	$sqlSch = '';
	if ($schOper) {
		$sqlSch = jqgrid_sopt($schField, $schStr, $schOper);
	}
	$start = $limit * $page - $limit;
	//����
	$sql = "select count(*)
		from salary_sdy y
		left join user u on (y.userid=u.user_id)
		left join department d on (u.dept_id=d.dept_id)
		where
		y.staflag='0' and y.flaflag='0' and  y.creator='".$_SESSION['USER_ID']."' ";
	$rs = $this->db->get_one($sql);
	$count = $rs['count(*)'];
	if ($count > 0) {
		$total_pages = ceil($count / $limit);
	} else {
		$total_pages = 0;
	}
	if ($page > $total_pages){
		$page = $total_pages;
	}
	$i = 0;
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
	$sql="select
		y.rand_key , u.user_name  , d.dept_name , y.sdymeal , y.sdyother ,  y.pyear , y.pmon , y.createdt ,y.remark
		from salary_sdy y
		left join user u on (y.userid=u.user_id)
		left join department d on (u.dept_id=d.dept_id)
		where
		y.staflag='0' and y.flaflag='0' and y.creator='".$_SESSION['USER_ID']."'
		order by y.pyear desc , y.pmon desc , y.id desc , $sidx $sord
		limit $start , $limit ";
	$query = $this->db->query($sql);
	while ($row = $this->db->fetch_array($query)) {
		if($row['pyear']==$this->nowy&&$row['pmon']==$this->nowm){
			$sta='0';
		}else{
			$sta='1';
		}
		$responce->rows[$i]['id'] = $row['rand_key'];
		$responce->rows[$i]['cell'] = un_iconv(
				array("", $row['rand_key']
					, $row['user_name']
					, $row['dept_name']
					, $this->salaryClass->decryptDeal($row['sdymeal'])
					, $this->salaryClass->decryptDeal($row['sdyother'])
					, $row['pyear'].'-'.$row['pmon']
					, $row['remark']
					, $row['createdt']
					, $sta
				     )
				);
		$i++;
	}
	return $responce;
}
/**
 *��������
 * @return string $flaflag 1 �������룻 0 ��������
 */
function model_dp_sdy_xls($flaflag='0'){
	set_time_limit(600);
	$type=$_POST['ctr_type'];
	$sqlCk=$type=='com'?'0':'1';
	$str='';
	$ckt=time();
	$infoE=array();
	try{
		$sql="delete from salary_sdy where staflag = '1' and creator='".$_SESSION['USER_ID']."' ";
		$this->db->query_exc($sql);
		$excelfilename='attachment/xls_model/dp_nym/'.$ckt.".xls";
		if(empty ($_FILES["ctr_file"]["tmp_name"])){
			$str='<tr><td colspan="5">�뵼�벹�����ݱ�</td></tr>';
		}elseif (!move_uploaded_file( $_FILES["ctr_file"]["tmp_name"], $excelfilename) ){
			$str='<tr><td colspan="5">�ϴ�ʧ�ܣ�</td></tr>';
		}else{
			//��ȡexcel��Ϣ
			include('includes/classes/excel.php');
			$excel = Excel::getInstance();
			$excel->setFile(WEB_TOR.$excelfilename);
			$excel->Open();
			$excel->setSheet();
			$excelFields = $excel->getFields();
			$excelArr=$excel->getAllData();
			$excel->Close();
			if(!in_array('Ա��', $excelFields)||!in_array('Ա����', $excelFields)
					||!in_array('�ڼ��ղ���', $excelFields)||!in_array('��������', $excelFields)||!in_array('��ע', $excelFields)){
				throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
			}
			if(count($excelArr)){
				foreach($excelArr['Ա����'] as $key=>$val ){
					$infoE[$val]['name']=$excelArr['Ա��'][$key];
					$infoE[$val]['meal']=$excelArr['�ڼ��ղ���'][$key];
					$infoE[$val]['other']=$excelArr['��������'][$key];
					$infoE[$val]['remark']=$excelArr['��ע'][$key];
				}
			}
			$sql="select
				s.username , s.userid , h.usercard as idcard
				from
				salary s
				left join hrms h on(s.userid=h.user_id)
				where 1 ";
			$query=$this->db->query_exc($sql);
			while($row=$this->db->fetch_array($query)){
				$infoA[]=$row['idcard'];
				if(array_key_exists($row['idcard'],$infoE)){
					$infoE[$row['idcard']]['type']=0;
					$infoE[$row['idcard']]['userid']=$row['userid'];
					$infoE[$row['idcard']]['name']=$row['username'];
				}
			}
			if(count($infoE)){
				foreach($infoE as $key=>$val){
					if(!in_array($key,$infoA)){
						$infoE[$row['idcard']]['type']=1;
					}
				}
			}
			$this->db->query("START TRANSACTION");
			if(count($infoE)){
				foreach($infoE as $key=>$val){
					if($val['type']=='0'){
						$cl='green';
					}elseif($val['type']=='1'){
						$cl='#FF9900';
					}
					$str.='<tr style="color:'.$cl.'">
						<td>'.$key.'</td>
						<td>'.$val['name'].'</td>
						<td>'.$val['meal'].'</td>
						<td>'.$val['other'].'</td>
						<td>'.$val['remark'].'</td>
						</tr>';
					if($val['type']=='0'&&$key){
						if($flaflag=='1'){
							$sql="insert into salary_sdy
								( userid , sdymeal , sdyother
								  , creator , createdt
								  , pyear , pmon , remark , rand_key , staflag , flaflag )
								values
								('".$val['userid']."','".$this->salaryClass->encryptDeal($val['meal']) ."','".$this->salaryClass->encryptDeal($val['other']) ."'
								 , '".$_SESSION['USER_ID']."' , now()
								 , '".$this->nowy."', '".$this->nowm."' , '".$val['remark']."' ,'".get_rand_key()."' ,'1' , '1' )  ";
							$this->db->query_exc($sql);
						}else{
							$sql="insert into salary_sdy
								( userid , sdymeal , sdyother
								  , creator , createdt
								  , pyear , pmon , remark , rand_key , staflag )
								values
								('".$val['userid']."','".$this->salaryClass->encryptDeal($val['meal']) ."','".$this->salaryClass->encryptDeal($val['other']) ."'
								 , '".$_SESSION['USER_ID']."' , now()
								 , '".$this->nowy."', '".$this->nowm."' , '".$val['remark']."' ,'".get_rand_key()."' ,'1' )  ";
							$this->db->query_exc($sql);
						}
					}
				}
			}
			$this->db->query("COMMIT");
		}
	}catch(Exception $e){
		$this->db->query("ROLLBACK");
		$str='<tr><td colspan="5">�������ݴ���'.$e->getMessage().'</td></tr>';
	}
	return $str;
}

/**
 *��Ŀ��ϸ
 *
 */
function model_dp_prod_xls(){
	set_time_limit(600);
	$type=$_POST['ctr_type'];
	$sqlCk=$type=='com'?'0':'1';
	$str='';
	$ckt=time();
	$infoE=array();
	try{
		$sql="delete from salary_prod where staflag = '1' and creator='".$_SESSION['USER_ID']."' ";
		$this->db->query_exc($sql);
		$excelfilename='attachment/xls_model/temp/'.$ckt.".xls";
		if(empty ($_FILES["ctr_file"]["tmp_name"])){
			$str='<tr><td colspan="10">�뵼�����ݱ�</td></tr>';
		}elseif (!move_uploaded_file( $_FILES["ctr_file"]["tmp_name"], $excelfilename) ){
			$str='<tr><td colspan="10">�ϴ�ʧ�ܣ�</td></tr>';
		}else{
			//��ȡexcel��Ϣ
			include('includes/classes/excel.php');
			$excel = Excel::getInstance();
			$excel->setFile(WEB_TOR.$excelfilename);
			$excel->Open();
			$excel->setSheet();
			$excelFields = $excel->getFields();
			$excelArr=$excel->getAllData();
			$excel->Close();
			if(!in_array('Ա��', $excelFields)||!in_array('Ա����', $excelFields)
					||!in_array('����ϵ��', $excelFields)||!in_array('����ϵ��', $excelFields)
					||!in_array('��Ŀ��Ч', $excelFields)||!in_array('��Ŀ������', $excelFields)
					||!in_array('��Ŀ���Բ���', $excelFields)||!in_array('��Ч����', $excelFields)||!in_array('��Ŀס�޲���', $excelFields)
			  ){
				throw new Exception('�������ݱ�ͷ����ȷ����˶��Ƿ��ģ��һ�£�');
			}
			if(count($excelArr)){
				foreach($excelArr['Ա����'] as $key=>$val ){
					$infoE[$val]['name']=$excelArr['Ա��'][$key];
					$infoE[$val]['ccxs']=$excelArr['����ϵ��'][$key];
					$infoE[$val]['khxs']=$excelArr['����ϵ��'][$key];

					$infoE[$val]['jjam']=$excelArr['��Ŀ��Ч'][$key];
					$infoE[$val]['gljtam']=$excelArr['��Ŀ������'][$key];

					$infoE[$val]['qtjtam']=$excelArr['��Ŀ���Բ���'][$key];
					$infoE[$val]['jxzcam']=$excelArr['��Ч����'][$key];
					$infoE[$val]['lszsam']=$excelArr['��Ŀס�޲���'][$key];
					$infoE[$val]['remark']=$excelArr['��ע'][$key];
				}
			}
			$sql="select
				s.username , s.userid , h.usercard as idcard
				from
				salary s
				left join hrms h on(s.userid=h.user_id)
				where 1 ";
			$query=$this->db->query_exc($sql);
			while($row=$this->db->fetch_array($query)){
				$infoA[]=$row['idcard'];
				if(array_key_exists($row['idcard'],$infoE)){
					$infoE[$row['idcard']]['type']=0;
					$infoE[$row['idcard']]['userid']=$row['userid'];
					$infoE[$row['idcard']]['name']=$row['username'];
				}
			}
			if(count($infoE)){
				foreach($infoE as $key=>$val){
					if(!in_array($key,$infoA)){
						$infoE[$row['idcard']]['type']=1;
					}
				}
			}
			$this->db->query("START TRANSACTION");
			if(count($infoE)){
				foreach($infoE as $key=>$val){
					if($val['type']=='0'){
						$cl='green';
					}elseif($val['type']=='1'){
						$cl='#FF9900';
					}
					$str.='<tr style="color:'.$cl.'">
						<td>'.$key.'</td>
						<td>'.$val['name'].'</td>
						<td>'.$val['ccxs'].'</td>
						<td>'.$val['khxs'].'</td>
						<td>'.$val['jjam'].'</td>
						<td>'.$val['gljtam'].'</td>
						<td>'.$val['qtjtam'].'</td>
						<td>'.$val['jxzcam'].'</td> <td>'.$val['lszsam'].'</td>


						<td>'.$val['remark'].'</td>
						</tr>';
					if($val['type']=='0'&&$key){
						$sql="insert into salary_prod
							( userid , ccxs , khxs
							  ,jjam,gljtam
							  , qtjtam,jxzcam,lszsam
							  , creator , createdt
							  , pyear , pmon , remark , rand_key , staflag , flaflag )
							values
							('".$val['userid']."'
							 ,'".$val['ccxs'] ."' ,'".$val['khxs'] ."'
							 ,'".$val['jjam'] ."' ,'".$val['gljtam'] ."'
							 ,'".$val['qtjtam'] ."' ,'".$val['jxzcam'] ."','".$val['lszsam'] ."'
							 , '".$_SESSION['USER_ID']."' , now()
							 , '".$this->nowy."', '".$this->nowm."' , '".$val['remark']."' ,'".get_rand_key()."' ,'1' , '1' )  ";
						$this->db->query_exc($sql);
					}
				}
			}
			$this->db->query("COMMIT");
		}
	}catch(Exception $e){
		$this->db->query("ROLLBACK");
		$str='<tr><td colspan="5">�������ݴ���'.$e->getMessage().'</td></tr>';
	}
	return $str;
}

//����������
/**
 * ���ʻ��������޸�
 * @param <type> $k �޸Ķ�Ӧ��rand_key
 * @param <type> $v ����ṹ key=�ֶ�����val=��ֵ
 * @param <type> $e ����ת��������
 */
function model_salary_update($k, $v, $e=array()) {
	if (!is_array($v) || !$k) {
		throw new Exception('Transfer data error '.$k);
	}
	if (!$this->salaryClass->numberCheck($v)) {
		throw new Exception('salary update db has non-num');
	}
	$v = $this->salaryClass->dataCript($v, 'encode', $e);
	$sqlt = '';
	foreach ($v as $key => $val) {
		if ($val == 'now()') {
			$sqlt.="$key=$val ,";
		} elseif(is_null($val)) {
			$sqlt.="$key = null ,";
		} else {
			$sqlt.="$key='$val' ,";
		}
	}
	$sqlt = trim($sqlt, ',');
	if (!$sqlt) {
		throw new Exception('salary update db error');
	}
	$sql = "update salary
		set $sqlt
		where rand_key='$k' ";
	$this->db->query_exc($sql);
}

/**
 ** ����ʵʱ�����޸�
 * @param <type> $k salary_pay��id
 * @param <type> $v ����ṹ key=�ֶ�����val=��ֵ
 * @param array $e ���˼���
 * @param type $sqltabcom ��˾���ݿ�
 * @param type $mkflag ��ע���� true ���� false ֱ�Ӵ���
 * @throws Exception
 */
function model_pay_update($k, $v, $e=array(),$sqltabcom='',$mkflag=true) {

	if(empty($e)){
		$e=array();
	}
	if (!is_array($v) || !$k) {
		throw new Exception('Transfer Data Error '.$k);
	}
	if (!$this->salaryClass->numberCheck($v)) {
		throw new Exception('salary update db has non-num');
	}
	$sqlt = '';
	$tmpv=$v;
	$v = $this->salaryClass->dataCript($v, 'encode', $e);
	foreach ($v as $key => $val) {
		if ($val == 'now()') {
			$sqlt.="$key=$val ,";
		}elseif($key=='remark'&&$mkflag){
			$sqlt.=" remark =CONCAT_WS(' | ',remark , '".$tmpv['remark']."' ) ,";
		}elseif(is_null($val)) {
			$sqlt.="$key = null ,";
		}else {
			$sqlt.="$key='$val' ,";
		}
	}
	$sqlt = trim($sqlt, ',');
	if (!$sqlt) {
		throw new Exception('salary update db error');
	}
	$sql = "update ".$sqltabcom."salary_pay
		set $sqlt
		where id='$k' ";
	$this->db->query_exc($sql);
}
function c_testjiami(){
	// 45.105
	//219.3
	//2350
	//-900
	//-250
	//-200
	//-100
	echo $this->salaryClass->encryptDeal(1306.7);
}

function c_batchEncrypt2(){
	$sql="select * from testTable";
	$query = $this->db->query($sql);
	while (($row = $this->db->fetch_array($query)) != false) {
		echo $this->salaryClass->encryptDeal($row['money'])."</br>";
	}


}

function c_batchEncrypt(){
	$sql="select * from testTable";
	$query = $this->db->query($sql);
	while (($row = $this->db->fetch_array($query)) != false) {
		$this->model_pay_stat($row['id']);
	}


}

function c_testpay(){
	//      $sql="select id from salary_pay where pmon='8' and pyear='2014' and SalaryDept='����ҵ�񷽰�'";
	//      $query = $this->db->query($sql);
	//       while (($row = $this->db->fetch_array($query)) != false) {
	//
	//           $this->model_pay_stat($row['id']);
	//       }

	$this->model_pay_stat('100668');
	echo 'success';
}

/**
 * ���㹤�����ݣ���������Ϣ��
 * @param <type> $k salary ��ӦID
 */
function model_pay_stat($k,$sqltab='') {
	$sql = "select
		baseam , basenowam ,floatam ,proam
		,otheram ,bonusam ,holsdelam
		,othdelam , shbam ,gjjam ,sperewam ,spedelam
		,sdyam
		,cessebase
		,perholsdays ,sickholsdays
		,accrewam ,accdelam , gwam ,  jxam
		, pyear , pmon
		, txjt
		from  salary_pay
		where id='$k'";
	$query = $this->db->get_one($sql);
	$res = $this->salaryClass->dataCript($query, 'decode');
	//ȡ��ȥ�� 20130628 ����Ĵ���ʽ
	$ckpaydt=date('Y-m-d',strtotime($query['pyear'].'-'.$query['pmon'].'-01'));
	//���Ӹ�λ�ͼ�Ч
	$holsdelAm = $this->salaryClass->holsDeal($query['perholsdays'], $query['sickholsdays']
			, round( $res['baseam'] + $res['gwam'] + $res['jxam']  , 2)
			,$ckpaydt);
	$totalAm = 0;
	$payCesse = 0;
	$payTotal = 0;
	if ($res['basenowam'] == 0 || $res['basenowam'] == $this->zero || $res['basenowam'] == '') {
		$totalAm = round($res['baseam'] + $res['floatam'] + $res['gwam'] + $res['jxam']
				+ $res['proam'] + $res['sdyam'] + $res['otheram'] + $res['bonusam']
				- $holsdelAm - $res['othdelam'] - $res['spedelam'] + $res['sperewam'], 2);

	} else {//��λ��Ч���ü���
		$totalAm = round($res['basenowam'] + $res['floatam']
				+ $res['proam'] + $res['sdyam'] + $res['otheram'] + $res['bonusam']
				- $holsdelAm - $res['othdelam'] - $res['spedelam'] + $res['sperewam'], 2);
	}
	//ͨ�Ž���
	$totalAm = round($totalAm+$res['txjt'] ,2);

	$cesse = round($totalAm - $res['gjjam'] - $res['shbam'], 2);
	$payCesse = $this->salaryClass->cesseDeal($cesse, $query['cessebase']);
	$payTotal = $this->salaryClass->getFinanceValue($cesse - $payCesse + $res['accrewam'] - $res['accdelam']);
	$res = array('holsdelam' => $holsdelAm, 'totalam' => $totalAm, 'paycesse' => $payCesse, 'paytotal' => $payTotal);
	$this->model_pay_update($k, $res,'',$sqltab);
}

/**
 * ��ȡ����ʵʱ��Ϣ
 * @param <type> id
 * @param <type> ���� val=�ֶ���
 * @return <type>
 */
function model_get_pay($k, $v) {
	if(is_array($k)){
		foreach($k as $kkey=>$vval){
			$sql.=" and ".$kkey." = '".$vval."' ";
		}
		$sql = "select
			" . implode(' , ', $v) . "
			from salary_pay where 1 ".$sql;

	}else{
		$sql = "select
			" . implode(' , ', $v) . "
			from salary_pay where id='$k' ";

	}
	$res = $this->db->get_one($sql);
	return $res;
}

/**
 * ͨ��salary rand_key ��ȡpay id
 * @param <type> $k
 * @return <type>
 */
function model_get_payid($k,$py='',$pm='') {
	if(empty($py)){
		$py=$this->nowy;
	}
	if(empty($pm)){
		$pm=$this->nowm;
	}
	$sql = "select p.id
		from
		salary_pay p , salary s
		where
		p.pyear='" . $py . "' and p.pmon='" . $pm . "' and p.userid=s.userid
		and s.rand_key='$k' ";
	$res = $this->db->get_one($sql);
	return $res;
}

/**
 * ��ȡ���ʻ�����Ϣ
 * @param <type> id
 * @param <type> ���� val=�ֶ���
 * @return <type>
 */
function model_get_salary($k, $v) {
	$sql = "select
		" . implode(' , ', $v) . "
		from salary where rand_key='$k' ";
	$res = $this->db->get_one($sql);
	return $res;
}
function model_get_data(){
	$sql="select max(pyear) as mpy , max(pmon) as mpm from salary_pay where pyear='".date('Y')."' ";
	$res=$this->db->get_one($sql);
	if(!empty($res['mpy'])){
		$this->nowy=$res['mpy'];
	}else{
		$this->nowy=date('Y');
	}
	if(!empty($res['mpm'])){
		$this->nowm=$res['mpm'];
	}else{
		$this->nowm=date('m');
	}
	if($this->nowy<date('Y')){
		$this->nowy=date('Y');
	}
	if($this->nowm<date('m')){
		$this->nowm=date('m');
	}
	//��ȡ����
	if( ($this->nowm-1) ==0 ){
		$this->lastpm = 12;
		$this->lastpy = $this->nowy - 1 ;
	}else{
		$this->lastpm = $this->nowm -1 ;
		$this->lastpy = $this->nowy  ;
	}
}
/**
 * ��ʼ����δ�������¹�����Ϣ��Ա��
 */
function model_salary_ini($flag=false) {
	if($flag){
		$monthp = mktime(0, 0, 0, date("m"), date("d")+10,   date("Y"));
		$this->nowy=date('Y',$monthp);
		$this->nowm=date('m',$monthp);
	}
	//���������ְģ��  �����˱�Ѷ �����
	//��ʼ��������Ա����Ϣ ���� �˺����Ϳ��� userType  1Ϊ��ʽԱ����2Ϊ��ƸԱ����3Ϊ����Ա��
	//��ȡ���¹�����Ϣ
	//$personnnelDao=new model_hr_personnel_personnel();
	// $personnnelDao->getPersonInfoByUserId($userId);

	$sql = "insert into
		salary
		( userid , deptid , comedt , username , olddept
		  , acc , idcard , email , oldarea
		  , amount , floatam , gjjam
		  , shbam , cogjjam , coshbam
		  , prepaream , handicapam
		  , manageam , cessebase ,rand_key , oldname , usercom , jfcom )
		select
		h.user_id , u.dept_id , replace(h.come_date,'-','') as comedt  , u.user_name , d.dept_name
		, h.account , h.card_no , u.email , a.name as area
		, '" . $this->zero . "' , '" . $this->zero . "' , '" . $this->zero . "'
		, '" . $this->zero . "' , '" .$this->salaryClass->encryptDeal($this->salaryClass->coGjjBase) . "'
		, '" . $this->salaryClass->encryptDeal($this->salaryClass->coShbBase) . "'
		, '" . $this->salaryClass->encryptDeal($this->salaryClass->prepareAm) . "'
		, '" . $this->salaryClass->encryptDeal($this->salaryClass->handicapAm) . "'
		, '" . $this->salaryClass->encryptDeal($this->salaryClass->manageAm) . "'
		, '" . $this->salaryClass->cesseProvideBase . "'
		, md5(concat('" . get_rand_key() . "',rand()))
		, u.user_name, u.company as usercom , u.company as jfcom
		from
		hrms h
		left join user u on (h.user_id=u.user_id)
		left join area a on (u.area=a.id)
		left join department d on (u.dept_id=d.dept_id)
		left join oa_hr_personnel oah on (h.user_id=oah.userAccount)
		where
		(  (u.del='0' and u.has_left='0'  )  or ( to_days(h.come_date) >=to_days('" . $this->nowy . "-" . $this->nowm . "-1')  ) )
		and u.usertype='1'
		and h.user_id not in (select userid from salary )
		and u.dept_id !='120' group by u.user_id ";//2015-11-19 modify by zengq ����Ƹ�Ŷ������е�ʵϰ�������빤��ϵͳ
		try {
			$this->db->query_exc($sql);
		} catch (Exception $e) {
			$this->globalUtil->insertOperateLog('������Ϣ', 'salary', '��ʼ��������Ա��������Ϣ', 'ʧ��', $e->getMessage());
			echo '������Ա�����ݳ�ʼʧ�ܣ�����ϵ����Ա��';
			exit();
		}
	//������Ŀ�� ȡ�� 5-29 xgq
	//        if($this->nowm==1||$this->nowm==4||$this->nowm==7||$this->nowm==10){
	//            $sql="update salary set floatam='".$this->zero."' , floatflag='1' where floatflag='0' ";
	//            $this->db->query_exc($sql);
	//        }else{
	//            $sql="update salary set floatflag='0' where floatflag='1' ";
	//            $this->db->query_exc($sql);
	//        }
	//���²��Ź�˾��Ϣ-ͳһ ���µ�����Ϣ
	$sql="update
		salary s
		left join user u on (s.userid=u.user_id)
		left join department d on (u.dept_id=d.dept_id )
		left join area a on (u.area=a.id )
		left join salary_pay p on (s.userid=p.userid and pyear='" . date('Y') . "'
				and pmon='" . date('m') . "' )
		set  s.olddept = d.dept_name , s.deptid=u.dept_id
		, p.salarydept = d.dept_name , p.deptid=u.dept_id
		, s.oldarea= CONVERT(a.name USING 'gbk') , p.area= CONVERT(a.name USING 'gbk')
		, s.usercom = u.company , p.usercom = u.company
		where
		s.userid=u.user_id and s.userid not in ('bin.chang')
		and u.dept_id=d.dept_id
		and ( s.deptid != u.dept_id  or s.usercom != u.company  )";
	$this->db->query_exc($sql);


	//��ʼ�����¹�����Ϣ
	$sqlcom = " and s.userid not in
		(select userid
		 from salary_pay
		 where pyear='" . $this->nowy . "'
		 and pmon='" . $this->nowm . "') ";

	//�����˱�Ѷ �����
	$sql = "select
		s.userid ,u.dept_id , s.oldarea as area
		,s.amount , s.floatam
		,s.gjjam , s.shbam , s.newflag , s.cogjjam , s.coshbam
		,s.prepaream , s.handicapam , s.manageam , s.cessebase
		,s.olddept , s.usersta , u.company , u.salarycom
		,h.expflag , date_format(leavedt , '%Y%m') as ckldt
		,s.jfcom
		,s.gwam , s.jxam
		from salary s
		left join hrms h on (s.userid=h.user_id)
		left join user u on (s.userid=u.user_id)
		left join area a on (u.area=a.id)
		where
		(s.usersta!='3'
		 or
		 ( date_format(leavedt , '%Y%m')>=".date('Ym',  strtotime($this->nowy.'-'.$this->nowm.'-1'))."
		   and s.usersta=3 )
		)
		and u.user_id is not null
		$sqlcom ";
	$query = $this->db->query($sql);
	try {
		$this->db->query("START TRANSACTION");
		$updataarr=array();
		while (($row = $this->db->fetch_array($query)) != false) {
			$updataarr[]=$row;
		}
		if(!empty($updataarr)){
			foreach ($updataarr as $row) {
				//��ְ
				if($row['usersta']==3&&$row['ckldt']==date('Ym',  strtotime($this->nowy.'-'.$this->nowm.'-1'))){
					$nowamflag=3;//������ְ״̬
				}else{
					$nowamflag=0;
				}
				//��ְ
				//��λ��Ч 20140217
				$leaveflag=$row['usersta']=='0'?'1':'0';
				$chk = true;
				$baseAm = $this->salaryClass->decryptDeal($row['amount']);
				$gjjAm = $this->salaryClass->decryptDeal($row['gjjam']);
				$shbAm = $this->salaryClass->decryptDeal($row['shbam']);
				$floatAm = $this->salaryClass->decryptDeal($row['floatam']);
				$gwAm = $this->salaryClass->decryptDeal($row['gwam']);
				$jxAm = $this->salaryClass->decryptDeal($row['jxam']);
				$totalAm = $this->salaryClass->cfv($baseAm + $floatAm+$jxAm +$gwAm );
				$cesseAm = $this->salaryClass->cfv($totalAm - $gjjAm - $shbAm);
				$payCesse = $this->salaryClass->cesseDeal($cesseAm, $row['cessebase']);
				$payTotal = $this->salaryClass->cfv($cesseAm - $payCesse);
				$sql = "insert into
					salary_pay
					set
					userid='" . $row['userid'] . "'
					, deptid='" . $row['dept_id'] . "'
					, area='" . $row['area'] . "'
					, salarydept='" . $row['olddept'] . "'
					, pyear='" . $this->nowy . "'
					, pmon='" . $this->nowm . "'
					, baseam='" . $row['amount'] . "'
					, gwam='" . $row['gwam'] . "'
					, jxam='" . $row['jxam'] . "'
					, floatam='" . $row['floatam'] . "'
					, gjjam='" . $row['gjjam'] . "'
					, shbam='" . $row['shbam'] . "'
					, totalam='" . $this->salaryClass->encryptDeal($totalAm) . "'
					, cesseam='" . $this->salaryClass->encryptDeal($cesseAm) . "'
					, paycesse='" . $this->salaryClass->encryptDeal($payCesse) . "'
					, paytotal='" . $this->salaryClass->encryptDeal($payTotal) . "'
					, cogjjam='" . $row['cogjjam'] . "'
					, coshbam='" . $row['coshbam'] . "'
					, prepaream='" . $row['prepaream'] . "'
					, handicapam='" . $row['handicapam'] . "'
					, manageam='" . $row['manageam'] . "'
					, cessebase='".$row['cessebase']."'
					, createdt=now()
					, leaveflag='".$leaveflag."'
					, expflag='".$row['expflag']."'
					, nowamflag ='".$nowamflag."'
					, usercom ='".$row['company']."'
					, jfcom ='".$row['jfcom']."' ";
				$this->db->query_exc($sql);
			}
		}
		$this->db->query("COMMIT");
		if ($chk) {
			$this->globalUtil->insertOperateLog('������Ϣ', 'salary_pay', '��ʼ�����¹�����Ϣ', '�ɹ�');
		}
	} catch (Exception $e) {
		$this->db->query("ROLLBACK");
		$this->globalUtil->insertOperateLog('������Ϣ', 'salary_pay', '��ʼ�����¹�����Ϣ', 'ʧ��', $e->getMessage());
		echo '�������ݳ�ʼʧ�ܣ�����ϵ����Ա��';
		exit();
	}
	//������Ա
	$sql="SELECT  s.usercom , s.jfcom , s.userid , s.deptid, s.olddept
		, s.userid , s.oldarea as area
		,s.amount , s.floatam
		,s.gjjam , s.shbam , s.newflag , s.cogjjam , s.coshbam
		,s.prepaream , s.handicapam , s.manageam , s.cessebase
		,s.olddept , s.usersta
		FROM salary s where comflag='0' and s.usersta=2 ".$sqlcom;
	$query = $this->db->query($sql);
	try {
		$this->db->query("START TRANSACTION");
		$updataarr=array();
		while (($row = $this->db->fetch_array($query)) != false) {
			$updataarr[]=$row;
		}
		if(!empty($updataarr)){
			foreach ($updataarr as $row) {
				$chk = true;
				$baseAm = $this->salaryClass->decryptDeal($row['amount']);
				$gjjAm = $this->salaryClass->decryptDeal($row['gjjam']);
				$shbAm = $this->salaryClass->decryptDeal($row['shbam']);
				$floatAm = $this->salaryClass->decryptDeal($row['floatam']);
				$totalAm = $this->salaryClass->cfv($baseAm + $floatAm);
				$cesseAm = $this->salaryClass->cfv($totalAm - $gjjAm - $shbAm);
				$payCesse = $this->salaryClass->cesseDeal($cesseAm, $row['cessebase']);
				$payTotal = $this->salaryClass->cfv($cesseAm - $payCesse);
				$sql = "insert into
					salary_pay
					set
					userid='" . $row['userid'] . "'
					, deptid='" . $row['deptid'] . "'
					, area='" . $row['area'] . "'
					, salarydept='" . $row['olddept'] . "'
					, pyear='" . $this->nowy . "'
					, pmon='" . $this->nowm . "'
					, baseam='" . $row['amount'] . "'
					, floatam='" . $row['floatam'] . "'
					, gjjam='" . $row['gjjam'] . "'
					, shbam='" . $row['shbam'] . "'
					, totalam='" . $this->salaryClass->encryptDeal($totalAm) . "'
					, cesseam='" . $this->salaryClass->encryptDeal($cesseAm) . "'
					, paycesse='" . $this->salaryClass->encryptDeal($payCesse) . "'
					, paytotal='" . $this->salaryClass->encryptDeal($payTotal) . "'
					, cogjjam='" . $row['cogjjam'] . "'
					, coshbam='" . $row['coshbam'] . "'
					, prepaream='" . $row['prepaream'] . "'
					, handicapam='" . $row['handicapam'] . "'
					, manageam='" . $row['manageam'] . "'
					, cessebase='".$row['cessebase']."'
					, usercom='".$row['usercom']."'
					, createdt=now()
					, comflag=0
					, jfcom ='".$row['jfcom']."' ";
				$this->db->query_exc($sql);
			}
		}
		$this->db->query("COMMIT");
	} catch (Exception $e) {
		$this->db->query("ROLLBACK");
		$this->globalUtil->insertOperateLog('������Ϣ', 'salary_pay', '��ʼ����������Ա������Ϣ', 'ʧ��', $e->getMessage());
		echo '��ʼ����������Ա������Ϣʧ�ܣ�����ϵ����Ա��';
		exit();
	}
}
/**
 * ��ʱ����˰������2011-02-23
 */
function model_cesse_chg(){
	return false;
	try{
		$this->db->query("START TRANSACTION");
		$chg=array();
		$sql="select id , totalam , gjjam , shbam , cessebase , paycesse , paytotal
			from salary_pay
			where pyear='".$this->nowy."'
			and pmon='".$this->nowm."' ";
		$query=$this->db->query($sql);
		while($row=$this->db->fetch_array($query)){
			$chg[$row['id']]['cessebase']=$row['cessebase'];
			$chg[$row['id']]['totalam']=$this->salaryClass->decryptDeal($row['totalam']);
			$chg[$row['id']]['gjjam']=$this->salaryClass->decryptDeal($row['gjjam']);
			$chg[$row['id']]['shbam']=$this->salaryClass->decryptDeal($row['shbam']);
			$chg[$row['id']]['paycesse']=$this->salaryClass->decryptDeal($row['paycesse']);
			$chg[$row['id']]['paytotal']=$this->salaryClass->decryptDeal($row['paytotal']);
		}
		$i='';
		if(!empty($chg)){
			foreach($chg as $key=>$val){
				$cesse = round($val['totalam'] - $val['gjjam'] - $val['shbam'], 2);
				$payCesse = $this->salaryClass->cesseDeal($cesse, $val['cessebase']);
				$payTotal = $this->salaryClass->getFinanceValue($cesse - $payCesse);
				if($payCesse!=$val['paycesse']||$payTotal!=$val['paytotal']){
					$this->model_pay_update($key, array('paycesse' => $payCesse, 'paytotal' => $payTotal));
					$i.=$key.'-'.$payCesse.'='.$val['paycesse'].','.$payTotal.'='.$val['paytotal'].'|';
				}
			}
		}
		$this->db->query("COMMIT");
		$this->globalUtil->insertOperateLog('������Ϣ', '��ʱ����˰������', '����', '�ɹ�', $i.'good');
	}catch (Exception $e) {
		$this->db->query("ROLLBACK");
		$this->globalUtil->insertOperateLog('������Ϣ', '��ʱ����˰������', '����', 'ʧ��', $i.$e->getMessage());
	}
}
/**
 * ��ʱ���¼��Ƚ����Ѳ���
 */
function model_float_chg(){
	//return false;
	try {
		$this->db->query("START TRANSACTION");
		$chg=array();
		$sql="SELECT p.userid  , p.floatam as pf , p1.floatam as pf1 , p.id as pid
			FROM salary_pay p
			left join salary_pay p1 on (p.userid=p1.userid and p1.pmon='8' and p1.pyear='2011')
			where p.pmon='9'
			and p.pyear='2011'
			and p.floatam in ('0','mKyYBwAYs6OhZVIyCcao0A==')
			and p1.floatam not in ('0','mKyYBwAYs6OhZVIyCcao0A==')
			and p.chgflag='0'
			and p.userid not in ('xinping.gou','siyu.chen','honghui.liu','quanzhou.luo' )";
		$query=$this->db->query($sql);
		while($row=$this->db->fetch_array($query)){
			$chg[$row['userid']]['pid']=$row['pid'];
			$chg[$row['userid']]['pf']=$this->salaryClass->decryptDeal($row['pf']);
			$chg[$row['userid']]['pf1']=$this->salaryClass->decryptDeal($row['pf1']);
		}
		if(!empty($chg)){
			foreach($chg as $key=>$val){
				if($val['pf']=='0'&&$val['pf1']!='0'){
					$payinfo=array('chgflag'=>'1','floatam'=>$val['pf1']);
					$this->model_pay_update($val['pid'],$payinfo,array(0));
					$this->model_pay_stat($val['pid']);
				}
			}
		}
		$this->db->query("COMMIT");
		$this->globalUtil->insertOperateLog('������Ϣ', '���������޸�', '����', '�ɹ�', 'good');
	} catch (Exception $e) {
		$this->db->query("ROLLBACK");
		$this->globalUtil->insertOperateLog('������Ϣ', '���������޸�', '����', 'ʧ��', $e->getMessage());
	}
}
/**
 * ���ʷ����ʼ�֪ͨ
 * @param <type> $title
 * @param <type> $body
 * @param <type> $emaildb add: ���������� | user : xgq,xiaohuang,
 * @param <type> $flag ���ͣ�true ��ַ������false ��Ա����
 */
function model_send_email($title, $body, $emaildb,$flag=true,$sflag=false) {
	if($sflag){
		try {
			if($flag){
				$emailadd=$emaildb;
			}elseif($emaildb){
				$emailadd=array();
				$sql="select
					u.email
					from
					user u
					where
					u.user_id in ('".str_replace(',', "','", trim($emaildb,','))."') ";
				$query=$this->db->query($sql);
				while($row=$this->db->fetch_array($query)){
					$emailadd[]=$row['email'];
				}
			}
			$this->emailClass ->send($title, $body, $emailadd);
		} catch (Exception $e) {
			$this->globalUtil->insertOperateLog('�����ʼ�', $emailadd, $body, 'ʧ��', $e->getMessage());
		}
	}
}

/**
 *
 * @param <array> $info ��Ϣ����
 * array(
 *      flowname , userid , salarykey , changeam , remark
 * );
 * @param <type> $flag
 * $rcov true �������Ƽ�� false ����key���
 */
function model_flow_new($info=array(), $flag=true , $rcov=true) {
	$resdb='';
	$info['proname']=$info['proname']?$info['proname']:'';
	$info['prono']=$info['prono']?$info['prono']:'';
	if ($flag) {
		//����
		if( $info['flowname'] != $this->flowName['spe'] && $info['flowname'] != $this->flowName['spe_3'] && $info['flowname'] != $this->flowName['spe_5'] && $info['flowname'] != $this->flowName['spe_1'] && $info['flowname'] != $this->flowName['spe_0'] 
				&& $info['flowname'] != $this->flowName['spe_xs_3'] && $info['flowname'] != $this->flowName['spe_xs_5'] && $info['flowname'] != $this->flowName['spe_xs_1'] && $info['flowname'] != $this->flowName['spe_xs_0'] && $info['flowname'] != $this->flowName['spe_xs_12']){
			//��������
			if($rcov){
				$sql = "select count(*) from salary_flow
					where
					flowname='".$info['flowname']."' and userid='".$info['userid']."'
					and sta!=3 and sta!=2 ";
			}elseif($info['salarykey']){
				$sql = "select count(*) from salary_flow
					where
					salarykey='".$info['salarykey']."' ";
			}
			if($sql){
				$ckp=$this->db->get_one($sql);
				if($ckp['count(*)']>=1){
					throw new Exception('Data has been generated');
				}
			}

		}

		$sql = "insert into salary_flow
			( flowid , flowname , userid , createdt , createuser
			  , salarykey , changeam , remark , pyear , pmon
			  , rand_key , proname , prono , changedt , remark_rea , gwam , jxam , oldam ,   oldgwam , oldjxam  )
			select
			flow_id , flow_name  , '" . $info['userid'] . "' , now() , '" . $_SESSION['USER_ID'] . "'
			, '" . $info['salarykey'] . "' , '" . $info['changeam'] . "' , '" . $info['remark'] . "' , '" . $this->nowy . "', '" . $this->nowm . "'
			, md5(concat('" . get_rand_key() . "',rand())) , '" . $info['proname'] . "' , '" . $info['prono'] . "'
			, '" . $info['changedt'] . "' , '" . $info['remark_rea'] . "'  , '" . $info['gwam'] . "'  , '" . $info['jxam'] . "'
			, '" . $info['oldam'] . "' , '" . $info['oldgwam'] . "'  , '" . $info['oldjxam'] . "'
			from
			flow_type
			where
			flow_name='" . $info['flowname'] . "' ";
		$this->db->query_exc($sql);
		$salaryfid = $this->db->insert_id();
		//             echo iconv ( "gb2312", "utf-8", $sql) ;
		//             die();
		if(!$salaryfid){
			throw new Exception('no stat flow query');
		}
		if($this->flowName['ymd']==$info['flowname']){
			$this->model_flow_pass($salaryfid);
		}else{
			//������
			$sql = "select
				p.id , p.prcs_name , p.prcs_id
				, p.prcs_user as pu , p.prcs_dept as pd
				, p.prcs_priv as pp , p.prcs_spec as ps
				, p.prcs_prop as ptype
				from
				flow_process p
				left join flow_type f on (p.flow_id=f.flow_id)
				where
				f.flow_name='" . $info['flowname'] . "'
				order by prcs_id ";
			if($info['remark']=='�Ϳ��۳�'||($info['meal']==0&&$info['other']>0)){//�Ϳ����߸��������ģ����貿���ܼ�����
				$sql = "select
					p.id , p.prcs_name , p.prcs_id
					, p.prcs_user as pu , p.prcs_dept as pd
					, p.prcs_priv as pp , p.prcs_spec as ps
					, p.prcs_prop as ptype
					from
					flow_process p
					left join flow_type f on (p.flow_id=f.flow_id)
					where
					f.flow_name='" . $info['flowname'] . "'
					order by prcs_id limit 1,1";
			}
			$query = $this->db->query_exc($sql);
			if(empty($query)){
				throw new Exception('no stat flow user');
			}
			$flow_step_id=1;
			$pass_step=false;
			while ($row = $this->db->fetch_array($query)) {
				$tmpUser = '';
				if ($row['pu']) {
					$tmpUser.=$row['pu'];
				}
				$tmpUser = trim($tmpUser, ',');
				if ($row['pp']) {
					$sql = "select user_id from user u where u.user_priv in ( " . trim($row['pp'], ',') . ") ";
					$queryi = $this->db->query_exc($sql);
					while ($rowi = $this->db->fetch_array($queryi)) {
						$tmpUser.=',' . $rowi['user_id'];
					}
				}
				$tmpUser = trim($tmpUser, ',');
				if ($row['ps']) {
					$tmpPs = explode(',', $row['ps']);
					if (!empty($tmpPs)) {
						foreach ($tmpPs as $val) {
							if ($val == '@bmzj') { //�����ܼ�
								if(in_array($info['userid'],$this->fuZong)){
									$tmpUser = trim($tmpUser . $this->ZJL, ',');
									break;
								}else{
									$sql = "select
										d.majorid , d.vicemanager
										from user u
										left join department d on (u.dept_id=d.dept_id)
										where
										u.user_id='" . $info['userid'] . "' ";
									$resi = $this->db->get_one($sql);
									if ($resi['majorid']&&trim($resi['majorid'],',')!=$_SESSION['USER_ID']) {
										$tmpUser = trim($tmpUser . $resi['majorid'], ',');
									} else {
										if ($resi['vicemanager']) {
											$tmpUser = trim($tmpUser . $resi['vicemanager'], ',');
										} else {
											$sql = "select u.user_id
												from user u
												left join user_priv p on (u.user_priv=p.user_priv)
												where p.priv_name='�ܾ���' ";
											$queryi = $this->db->query_exc($sql);
											while ($rowi = $this->db->fetch_array($queryi)) {
												$tmpUser.=',' . $rowi['user_id'];
											}
										}
									}
								}
							}
							if ($val == '@bmfz') { //���Ÿ���
								if(in_array($info['userid'],$this->fuZong)){
									$tmpUser = trim($tmpUser . $this->ZJL, ',');
									break;
								}else{
									$sql = "select
										d.vicemanager
										from user u
										left join department d on (u.dept_id=d.dept_id)
										where
										u.user_id='" . $info['userid'] . "' ";
									$resi = $this->db->get_one($sql);
									if ($resi['vicemanager']) {
										$tmpUser = trim($tmpUser . $resi['vicemanager'], ',');
									} else {
										$sql = "select u.user_id
											from user u
											left join user_priv p on (u.user_priv=p.user_priv)
											where p.priv_name='�ܾ���' ";
										$queryi = $this->db->query_exc($sql);
										while ($rowi = $this->db->fetch_array($queryi)) {
											$tmpUser.=',' . $rowi['user_id'];
										}
									}
								}

							}
						}
					}
				}
				if (trim($tmpUser)) {//��һ��
					//��ȡ��Ȩ������
					$sql="SELECT group_concat( to_id)  as to_ids  , from_id   FROM power_set
						where to_days(BEGIN_DATE)<=to_days(now()) and to_days( END_DATE )>=to_days(now()) and STATUS=1
						and find_in_set(FROM_ID,'".$tmpUser."')
						group by FROM_ID";
					$powserto=$this->db->get_one($sql);
					$tmpUser.=empty($powserto['to_ids'])?'':','.$powserto['to_ids'];
					$pos = stripos($tmpUser, $_SESSION['USER_ID']);
					if($pos!==false){//�����ύ������
						$pass_step=true;
						continue;
					}
					if ($flow_step_id == 1) {
						$resdb=$tmpUser;
						$sql = "insert into salary_flow_step
							(salaryfid , flowproid , item
							 , step , dealuser , rand_key , sta )
							values
							('" . $salaryfid . "' , '" . $row['id'] . "' ,'" . $row['prcs_name'] . "'
							 , '" . $flow_step_id . "' , '" . $tmpUser . "' ,'" . get_rand_key() . "', 0 ) ";
					} else {
						$sql = "insert into salary_flow_step
							(salaryfid , flowproid , item
							 , step , dealuser , rand_key )
							values
							('" . $salaryfid . "' , '" . $row['id'] . "' ,'" . $row['prcs_name'] . "'
							 , '" . $flow_step_id . "' , '" . $tmpUser . "' ,'" . get_rand_key() . "' ) ";
					}
					$this->db->query_exc($sql);
					$flow_step_id++;
				} else {
					throw new Exception('no checker');
				}
			}
			if($flow_step_id==1&&$pass_step){
				$this->model_flow_pass($salaryfid);
			}

		}
	} else {//û���̣�ֻ��¼�¼�
		$sql = "insert into
			salary_flow
			( flowname ,userid , createdt
			  , createuser , sta , salarykey
			  , changeam , finishdt , remark
			  , pyear , pmon  , rand_key
			)
			values
			( '" . $info['flowname'] . "' ,'" . $info['userid'] . "' ,now()
			  , '" . $_SESSION['USER_ID'] . "' , 1 ,'" . $info['salarykey'] . "'
			  , '" . $info['changeam'] . "' , now() , '" . $info['remark'] . "'
			  , '" . $this->nowy . "', '" . $this->nowm . "' , md5(concat('" . get_rand_key() . "',rand()))
			)";
		$this->db->query_exc($sql);
	}
	return $resdb;
}
/**
 * �Զ�ͨ��
 */

function model_flow_auto_do(){
	set_time_limit(600);
	//'eric.ye',
	$sql="select
		s.rand_key as stepkey , s.dealuser
		FROM salary_flow_step s
		left join salary_flow f on (s.salaryfid=f.id)
		where s.sta<>1 and f.id is not null and f.sta<>3
		and s.dealuser in ('jingkai.qu')
		order by  f.id , s.id  ";
	$query = $this->db->query_exc($sql);
	while ($row = $this->db->fetch_array($query)) {
		if($row['stepkey']&&$row['dealuser']){
			//����ͨ��
			$this->model_flow_do($row['stepkey'],'yes','',$row['dealuser']);

		}
	}
}
/**
 *
 * @param <type> $stepkey
 * @param <type> $res
 * @param <type> $remark
 * @return <type>
 */
function model_flow_do($stepkey, $res, $remark,$douser='') {
	if(empty($douser)){
		$douser=$_SESSION['USER_ID'];
	}
	$emailArr = array();
	try {
		$this->db->query("START TRANSACTION");
		//���µ�ǰ����
		if(!$stepkey){
			throw new Exception('Data out time');
		}
		$sql="select
			fs.step , fs.salaryfid
			from
			salary_flow_step fs
			where
			fs.rand_key='".$stepkey."'
			and (find_in_set('".$douser."',fs.dealuser) or '".$douser."'='admin')
			and fs.sta='0' ";
		$ri=$this->db->get_one($sql);
		if(!$ri['salaryfid']){
			throw new Exception('Data Query failed');
		}
		$flowkey=$ri['salaryfid'];
		if($douser=='admin'){
			$douser='tianlin.zhang';
			$this->model_flow_pass($flowkey);
			$sql = "update salary_flow_step
				set
				sta='1'
				where rand_key='" . $stepkey . "' ";
			$this->db->query_exc($sql);
			$this->db->query("COMMIT");
			return;
		}
		$nextstep=intval($ri['step']+1);
		$sql = "update salary_flow_step
			set
			sta='1' , res='" . $res . "' , remark='" . $remark . "'
			, dealuser='" . $douser . "' , dealdt=now()
			where rand_key='" . $stepkey . "' ";
		$this->db->query_exc($sql);
		$sql = "update salary_flow
			set
			sta='1'
			where id='" . $flowkey . "' ";
		$this->db->query_exc($sql);
		if ($res == 'no') {
			$sql = "update salary_flow
				set sta='3'
				where id='" . $flowkey . "' ";
			$this->db->query_exc($sql);
			$sql = "select
				f.flowname , f.createuser as userid , f.salarykey
				from salary_flow f
				where id='" . $flowkey . "' ";
			$rs = $this->db->get_one($sql);
			$emailArr['add'] = $rs['userid'];
			$emailArr['res'] = 'back';
			$emailArr['type'] = $rs['flowname'];
			$emailArr['bill'] = $flowkey;
			if($rs['flowname']==$this->flowName['spe'] || $rs['flowname']==$this->flowName['spe_3'] || $rs['flowname']==$this->flowName['spe_5'] || $rs['flowname']==$this->flowName['spe_1'] || $rs['flowname']==$this->flowName['spe_0'] 
					|| $rs['flowname']==$this->flowName['spe_xs_3'] || $rs['flowname']==$this->flowName['spe_xs_5'] || $rs['flowname']==$this->flowName['spe_xs_1'] || $rs['flowname']==$this->flowName['spe_xs_0'] || $rs['flowname']==$this->flowName['spe_xs_12']){
				$sql="update salary_spe set spesta='2' where rand_key='".$rs['salarykey']."' ";
				$this->db->query_exc($sql);
			}
		} elseif ($res == 'yes') {
			$ckf=false;
			$sql = "select
				s.item , s.rand_key , s.dealuser as userid , s.step
				, f.flowname
				from salary_flow_step s
				left join salary_flow f on (s.salaryfid=f.id )
				where
				s.salaryfid='" . $flowkey . "'
				and s.step>='".$nextstep."'
				order by s.step asc ";
			$query=$this->db->query_exc($sql);
			$ars=$this->db->affected_rows();
			$i=1;
			if($ars&&$ars>=1){
				while($row=$this->db->fetch_array($query)){
					if(trim($row['userid'],',')==$douser){
						$sql = "update salary_flow_step
							set
							sta='1' , res='" . $res . "' , remark='" . $remark . "'
							, dealuser='" . $douser . "' , dealdt=now()
							where rand_key='" . $row['rand_key'] . "' ";
						$this->_db->query_exc($sql);
					}else{
						$emailArr['add'] = $row['userid'];
						$emailArr['res'] = 'next';
						$emailArr['type'] = $row['flowname'];
						$emailArr['bill'] = $flowkey;
						$sql = "update salary_flow_step set sta='0' where rand_key='" . $row['rand_key'] . "' ";
						$this->_db->query_exc($sql);
						break;
					}
					if($i==$ars){//�������
						$ckf=true;
					}
					$i++;
				}
			}else{//���������
				$ckf=true;
			}
			if($ckf){
				$this->model_flow_pass($flowkey);
			}
		}
		$this->db->query("COMMIT");
		if(!empty($emailArr)&&$emailArr['add']){
			if($emailArr['res']=='next'){
				$body='���ã�<br><br>
					&nbsp;&nbsp;&nbsp;&nbsp;ϵͳ���й������ݣ�'.$emailArr['type'].'����Ҫ��������<br>
					&nbsp;&nbsp;&nbsp;&nbsp;����������'.$_SESSION['USER_NAME'].'�����ύ<br>
					лл��';
			}elseif($emailArr['res']=='back'){
				$body='���ã�<br>
					&nbsp;&nbsp;&nbsp;&nbsp;��������ģ�'.$emailArr['type'].'�����ţ�'.$emailArr['bill'].'����<font color="red">���</font>��<br>
					лл��';
			}elseif($emailArr['res']=='finish'){
				$body='���ã�<br>
					&nbsp;&nbsp;&nbsp;&nbsp;��������ģ�'.$emailArr['type'].'�����ţ�'.$emailArr['bill'].'����<font color="green">ͨ��</font>��<br>
					лл��';
			}
			$this->model_send_email('��������', $body, $emailArr['add'],false,true);
		}
		$this->globalUtil->insertOperateLog('��������', $stepkey, '����' . $res, '�ɹ�');
	} catch (Exception $e) {
		$this->db->query("ROLLBACK");
		$this->globalUtil->insertOperateLog('��������', $stepkey, '����' . $res, 'ʧ��', $e->getMessage());
		return $e->getMessage();
	}
}
/**
 * ����ͨ������
 * @param unknown $flowkey
 * @throws Exception
 * @return boolean
 */
function model_flow_pass($flowkey){
	$salinfo=array();
	$payinfo=array();
	$payinfoE = array();
	$emailArr=array();
	$fpyear = $this->nowy;
	$fpmon= $this->nowm;
	//         $this->nowm=1;
	$salkey='';
	$payid='';
	$flowremark='';
	$sql="select f.rand_key , f.changeam , f.createuser as useride , f.flowname , f.userid , f.salarykey , f.remark as flowremark
		, f.pyear , f.pmon
		, u.user_name as saluser , d.dept_name as saldept , u.email as salemail
		, u.company , u.salarycom , f.changedt
		, f.gwam , f.jxam
		, sc.pyear as scpyear , sc.pmon as scpmon
		from salary_flow f
		left join user u on (f.userid=u.user_id)
		left join salary_config sc on ( u.company = sc.com  )
		left join department d on (u.dept_id=d.dept_id)
		where f.id='".$flowkey."' ";
	$resf=$this->db->get_one($sql);
	if(empty($resf['rand_key'])){
		throw new Exception('Salary flow data query failed');
		return false;
	}
	$flowremark=$resf['flowremark'];
	$emailArr['add'] = $resf['useride'];
	$emailArr['res'] = 'finish';
	$emailArr['type'] = $resf['flowname'];
	$emailArr['am'] = $this->salaryClass->decryptDeal($resf['changeam']);
	$emailArr['gwam'] = $this->salaryClass->decryptDeal($resf['gwam']);
	$emailArr['jxam'] = $this->salaryClass->decryptDeal($resf['jxam']);
	$emailArr['saluser'] = $resf['saluser'];
	$emailArr['saldept'] = $resf['saldept'];
	$emailArr['salemail'] = $resf['salemail'];
	$compt=$resf['company'];
	if(!empty($resf['salarycom'])){
		$compt=$resf['salarycom'];
	}
	if(!empty($resf['scpyear'])){
		$fpyear=$resf['scpyear'];
	}
	if(!empty($resf['scpmon'])){
		$fpmon=$resf['scpmon'];
	}
	//$comtable=$this->get_com_sql($compt);
	$sql = "update salary_flow
		set sta='2' , pyear = '".$fpyear."' , pmon='".$fpmon."'
		where id='" . $flowkey . "' ";
	$this->db->query_exc($sql);
	if($resf['flowname']==$this->flowName['fla']){//���Ƚ�
		$sql="select p.sdyam , p.otheram , p.remark , p.id as pid , s.rand_key , p.userid as puserid
			from salary_pay p
			left join salary s on (p.userid=s.userid)
			where p.userid='".$resf['userid']."'
			and p.pyear='".$fpyear."' and p.pmon='".$fpmon."' ";
		$respay=$this->db->get_one($sql);
		if(empty($respay)){
			throw new Exception('Salary flow data query failed');
		}
		$salkey=$respay['rand_key'];
		$payid=$respay['pid'];
		$flaamtmp=$this->salaryClass->decryptDeal($resf['changeam']);
		$salinfo['floatam']=$this->salaryClass->cfv($flaamtmp);
		$payinfo['floatam']=$this->salaryClass->cfv($flaamtmp*$this->flaotMon[$fpmon]);
		$payinfo['remark']=$flowremark;
	}elseif($resf['flowname']==$this->flowName['sdyhr'] || $resf['flowname']==$this->flowName['sdyhr_3'] || 
			$resf['flowname']==$this->flowName['sdyhr_5'] || $resf['flowname']==$this->flowName['sdyhr_1'] || 
			$resf['flowname']==$this->flowName['sdyhr_0']){//���²���
		$sql="select sdymeal , sdyother , userid   from salary_sdy
			where rand_key='".$resf['salarykey']."' ";
		$ressdy=$this->db->get_one($sql);
		if(empty($ressdy)){
			throw new Exception('Salary flow data query failed');
		}
		$sql="update salary_sdy set flaflag='2' , pyear ='".$fpyear."'  , pmon ='".$fpmon."'
			where rand_key='".$resf['salarykey']."' ";
		$this->db->query_exc($sql);
		$sql="select p.sdyam , p.otheram , p.remark , p.id as pid , s.rand_key
			from salary_pay p
			left join salary s on (p.userid=s.userid)
			where p.userid='".$ressdy['userid']."'
			and p.pyear='".$fpyear."' and p.pmon='".$fpmon."' ";
		$respay=$this->db->get_one($sql);
		$salkey=$respay['rand_key'];
		$payid=$respay['pid'];
		$oldSdyAm=$this->salaryClass->decryptDeal($respay['sdyam']);
		$oldOthAm=$this->salaryClass->decryptDeal($respay['otheram']);
		$newSdyAm=$this->salaryClass->decryptDeal($ressdy['sdymeal']);
		$newOthAm=$this->salaryClass->decryptDeal($ressdy['sdyother']);
		//�ۼ�
		$payinfo['sdyam']=$this->salaryClass->cfv($oldSdyAm+$newSdyAm);
		$payinfo['otheram']=$this->salaryClass->cfv($oldOthAm+$newOthAm);
		$payinfo['remark']=$flowremark;
		//���²���
	}elseif($resf['flowname']==$this->flowName['spe'] || $resf['flowname']==$this->flowName['spe_3'] || 
			$resf['flowname']==$this->flowName['spe_5'] || $resf['flowname']==$this->flowName['spe_1'] || 
			$resf['flowname']==$this->flowName['spe_0']
			|| $resf['flowname']==$this->flowName['spe_xs_3'] || 
			$resf['flowname']==$this->flowName['spe_xs_5'] || $resf['flowname']==$this->flowName['spe_xs_1'] || 
			$resf['flowname']==$this->flowName['spe_xs_0'] || $resf['flowname']==$this->flowName['spe_xs_12']){//���⽱��/�۳�
		$sql="select payyear , paymon , amount , paytype , payuserid , acctype from salary_spe
			where rand_key='".$resf['salarykey']."' ";
		$resspe=$this->db->get_one($sql);
		if(empty($resspe)){
			throw new Exception('Salary flow data query failed');
		}
		$sql="select p.sperewam , p.spedelam , p.accrewam , p.accdelam  , p.remark , p.id as pid , s.rand_key
			from salary_pay p
			left join salary s on (p.userid=s.userid)
			where p.userid='".$resspe['payuserid']."'
			and p.pyear='".$fpyear."' and p.pmon='".$fpmon."' ";
		$respay=$this->db->get_one($sql);
		$salkey=$respay['rand_key'];
		$payid=$respay['pid'];
		if($resspe['acctype']=='0'){//�����˰
			if($resspe['paytype']=='0'){
				$oldam=$this->salaryClass->decryptDeal($respay['sperewam']);
				$newam=$this->salaryClass->decryptDeal($resspe['amount']);
				$oldrmk=$respay['remark'];
				$payinfo['sperewam']=$this->salaryClass->cfv($oldam+$newam);
				$payinfo['remark']=$flowremark;
			}elseif($resspe['paytype']=='1'){
				$oldam=$this->salaryClass->decryptDeal($respay['spedelam']);
				$newam=$this->salaryClass->decryptDeal($resspe['amount']);
				$oldrmk=$respay['remark'];
				$payinfo['spedelam']=$this->salaryClass->cfv($oldam+$newam);
				$payinfo['remark']=$flowremark;
			}
		}else{
			if($resspe['paytype']=='0'){
				$oldam=$this->salaryClass->decryptDeal($respay['accrewam']);
				$newam=$this->salaryClass->decryptDeal($resspe['amount']);
				$oldrmk=$respay['remark'];
				$payinfo['accrewam']=$this->salaryClass->cfv($oldam+$newam);
				$payinfo['remark']=$flowremark;
			}elseif($resspe['paytype']=='1'){
				$oldam=$this->salaryClass->decryptDeal($respay['accdelam']);
				$newam=$this->salaryClass->decryptDeal($resspe['amount']);
				$oldrmk=$respay['remark'];
				$payinfo['accdelam']=$this->salaryClass->cfv($oldam+$newam);
				$payinfo['remark']=$flowremark;
			}
		}
		$sql="update salary_spe set spesta='3' , payyear='".$fpyear."' , paymon='".$fpmon."'  where rand_key='".$resf['salarykey']."' ";
		$this->db->query_exc($sql);
		//���⽱��/�۳�
	}elseif($resf['flowname']==$this->flowName['nym_0']||$resf['flowname']==$this->flowName['nym_1']
			||$resf['flowname']==$this->flowName['nym_2']||$resf['flowname']==$this->flowName['nym_3']
			||$resf['flowname']==$this->flowName['nym_4'] 
			||$resf['flowname']==$this->flowName['nym_xs_0']||$resf['flowname']==$this->flowName['nym_xs_1']
			||$resf['flowname']==$this->flowName['nym_xs_2']||$resf['flowname']==$this->flowName['nym_xs_3']
			||$resf['flowname']==$this->flowName['nym_xs_4']
			||$resf['flowname']==$this->flowName['ymd'])
	{//��н
		$sql="select p.sperewam , p.spedelam , p.remark , p.id as pid , s.rand_key , s.amount
			,p.gwam , p.jxam
			from salary_pay p
			left join salary s on (p.userid=s.userid)
			where p.userid='".$resf['userid']."'
			and p.pyear='".$fpyear."' and p.pmon='".$fpmon."' ";
		$respay=$this->db->get_one($sql);
		$salkey=$respay['rand_key'];
		$payid=$respay['pid'];
		$oldam=$this->salaryClass->cfv($this->salaryClass->decryptDeal($respay['amount']));
		$changeam=$this->salaryClass->cfv($this->salaryClass->decryptDeal($resf['changeam']));
		$salinfo['amount']=$changeam;
		$payinfo['baseam']=$changeam;
		$oldgwam=$this->salaryClass->cfv($this->salaryClass->decryptDeal($respay['gwam']));
		$chgwam=$this->salaryClass->cfv($this->salaryClass->decryptDeal($resf['gwam']));
		$oldjxam=$this->salaryClass->cfv($this->salaryClass->decryptDeal($respay['jxam']));
		$chjxam=$this->salaryClass->cfv($this->salaryClass->decryptDeal($resf['jxam']));
		$salinfo['gwam']=$chgwam;
		$payinfo['gwam']=$chgwam;
		$salinfo['jxam']=$chjxam;
		$payinfo['jxam']=$chjxam;
		$payinfo['remark']=$flowremark;

		//��н����
		if(!empty($resf['changedt'])&&$resf['changedt']!='0000-00-00'&&!empty($oldam)){
			$oldamt = $oldam+$oldgwam+$oldjxam;
			$changeamt = $changeam+$chgwam+$chjxam;
			$passNowAm=$this->salaryClass->salaryPass($oldamt, $changeamt, $resf['changedt']);
			$payinfo['basenowam']=$passNowAm;
		}


	}elseif($resf['flowname']==$this->flowName['pro'] || $resf['flowname']==$this->flowName['pro_3'] || 
			$resf['flowname']==$this->flowName['pro_5'] || $resf['flowname']==$this->flowName['pro_1'] || 
			$resf['flowname']==$this->flowName['pro_0'] || 
			$resf['flowname']==$this->flowName['pro_xs_3'] || 
			$resf['flowname']==$this->flowName['pro_xs_5'] || $resf['flowname']==$this->flowName['pro_xs_1'] || 
			$resf['flowname']==$this->flowName['pro_xs_0'] || $resf['flowname']==$this->flowName['pro_xs_0'] || $resf['flowname']==$this->flowName['pro_xs_12'] ){//��Ŀ��
		$sql="select p.sperewam , p.spedelam , p.remark , p.id as pid , s.rand_key , p.proam
			from salary_pay p
			left join salary s on (p.userid=s.userid)
			where p.userid='".$resf['userid']."'
			and p.pyear='".$fpyear."' and p.pmon='".$fpmon."' ";
		$respay=$this->db->get_one($sql);
		$salkey=$respay['rand_key'];
		$payid=$respay['pid'];
		$oldam=$this->salaryClass->decryptDeal($respay['proam']);
		$newam=$this->salaryClass->decryptDeal($resf['changeam']);
		$oldrmk=$respay['remark'];
		$payinfo['proam']=$this->salaryClass->cfv($oldam+$newam);
		$payinfo['remark']=$flowremark;
	}elseif($resf['flowname']==$this->flowName['prod']){//��Ŀ����ϸ
		$sql="select ccxs , khxs ,  jjam , gljtam ,  qtjtam  ,  jxzcam,lszsam  , userid   from salary_prod
			where rand_key='".$resf['salarykey']."' ";
		$resprod=$this->db->get_one($sql);
		if(empty($resprod)){
			throw new Exception('Salary flow data query failed');
		}

		$sql="select p.sperewam , p.spedelam , p.remark , p.id as pid , s.rand_key , p.proam
			from salary_pay p
			left join salary s on (p.userid=s.userid)
			where p.userid='".$resf['userid']."'
			and p.pyear='".$fpyear."' and p.pmon='".$fpmon."' ";
		$respay=$this->db->get_one($sql);
		$salkey=$respay['rand_key'];
		$payid=$respay['pid'];
		$oldam=$this->salaryClass->decryptDeal($respay['proam']);
		$newam= round($resprod['jjam']+$resprod['gljtam']+$resprod['qtjtam']+$resprod['jxzcam']+$resprod['lszsam'] ,2);
		$oldrmk=$respay['remark'];
		$payinfo = array(
				'ccxs'=>$resprod['ccxs'],
				'khxs'=>$resprod['khxs'],
				'remark'=>$flowremark,

				'jjam'=>$resprod['jjam'],
				'gljtam'=>$resprod['gljtam'],
				'qtjtam'=>$resprod['qtjtam'],
				'jxzcam'=>$resprod['jxzcam'],
				'lszsam'=>$resprod['lszsam'],
				'proam'=>$this->salaryClass->cfv($oldam+$newam),
				);
		$payinfoE = array(0,1,2);

	}elseif($resf['flowname']==$this->flowName['bos'] || $resf['flowname']==$this->flowName['bos_3'] || 
			$resf['flowname']==$this->flowName['bos_5'] || $resf['flowname']==$this->flowName['bos_1'] || 
			$resf['flowname']==$this->flowName['bos_0']){//����
		$sql="select p.sperewam , p.spedelam , p.remark , p.id as pid , s.rand_key , p.bonusam
			from salary_pay p
			left join salary s on (p.userid=s.userid)
			where p.userid='".$resf['userid']."'
			and p.pyear='".$fpyear."' and p.pmon='".$fpmon."' ";
		$respay=$this->db->get_one($sql);
		$salkey=$respay['rand_key'];
		$payid=$respay['pid'];
		$oldam=$this->salaryClass->decryptDeal($respay['bonusam']);
		$newam=$this->salaryClass->decryptDeal($resf['changeam']);
		$payinfo['bonusam']=$this->salaryClass->cfv($oldam+$newam);
		$payinfo['remark']=$flowremark;
	}
	$sql="select s.lpj
		from  salary s
		where s.userid='".$resf['userid']."' ";
	$pay=$this->db->get_one($sql);
	$salinfo['lpj']=$pay['lpj'];

	if(!empty ($salinfo)&&$salkey){
		$this->model_salary_update($salkey,$salinfo);
	}
	if($salinfo['payleaveflag']==0){//û����ְ���㣬����Ҫ���¹�����Ϣ update by chengl 2014-08-12
		if(!empty ($payinfo)&&$payid){
			$this->model_pay_update($payid,$payinfo,$payinfoE);
			$this->model_pay_stat($payid);
		}
		if(!empty ($payinfo)&&$payid&&!empty ($salinfo)&&$salkey&&$resf['flowname']==$this->flowName['ymd']){
			try{
				$body=<<<EOD
					<div style='font-size:10pt;'>
					{$emailArr['saldept']}  {$emailArr['saluser']}<br/>
				<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;�����г���ԭ���빫˾��չ����Ӧ��ԭ�򣬹�˾���ݲ�ͬԱ���Ĺ���ְ����ְ�������г�н�����ݼ�����ȼ�Ч���˽�����Բ��ָ�λ�Ļ����������˲�ͬ�̶ȵĵ�����<br/><br/>
					&nbsp;&nbsp;&nbsp;&nbsp;��{$this->nowy}��{$this->nowm}�������Ļ������ʵ���Ϊ��{$emailArr['am']}����λ���ʣ�{$emailArr['gwam']}����Ч���ʣ�{$emailArr['jxam']}<br/><br/>
					&nbsp;&nbsp;&nbsp;&nbsp;���ϸ��ܸ��˹�����Ϣ�����Ͻ���̽��͸¶��˾�κ��˵Ĺ�����Ϣ��Υ���Խ���Ͷ���ͬ����<br/><br/>
					&nbsp;&nbsp;&nbsp;&nbsp;������֮���������������ܼ��������Դ���ܼ���ѯ��<br/>
					<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;�������ݣ�����֪Ϥ��лл<br/><br/>
					<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; �麣���Ͷ���ͨ�ſƼ��ɷ����޹�˾<br/><br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$this->nowy}��{$this->nowm}��<br/>
					</div>
					EOD;
				$this->model_send_email('��н֪ͨ', $body, $emailArr['salemail'],true,true);
			}catch(Exception $e){
				$this->globalUtil->insertOperateLog('��������', $emailArr['salemail'], '�ʼ�����ʧ��' . $body, 'ʧ��', $e->getMessage());
			}
		}
	}
}

function model_get_superiors($user){
	$resu='';
	$sql="select
		d.vicemanager , d.majorid  , h.userlevel
		from
		user u
		left join department d on (u.dept_id=d.dept_id)
		left join hrms h on (u.user_id=h.user_id)
		where
		u.dept_id=d.dept_id
		and u.user_id='".$user."' ";
	$res=$this->db->get_one($sql);
	$sql="select
		u.user_id
		from
		user u
		left join user_priv p on (u.user_priv =p.user_priv )
		where
		u.user_priv=p.user_priv
		and p.priv_name='�ܾ���' ";
	$query=$this->db->query($sql);
	$gm='';
	while($row=$this->db->fetch_array($query)){
		$gm.=$row['user_id'].',';
	}
	$res['generalmanager']=$gm;
	if(!$res['vicemanager']){
		$res['vicemanager']=$res['generalmanager'];
	}
	if(!$res['majorid']){
		$res['majorid']=$res['vicemanager'];
	}
	switch($res['userlevel']){
		case "0":
			$resu=$res['generalmanager'];
			break;
		case "1":
			$resu=$res['generalmanager'];
			break;
		case "2":
			$resu=$res['vicemanager'];
			break;
		case "3":
			$resu=$res['majorid'];
			break;
		case "4":
			$resu=$res['majorid'];
			break;
		default :
			$resu=$res['majorid'];
			break;
	}
	return $resu;
}
/**
 * ��ȡ�û���Ϣ
 */
function model_salary_info(){
	$type=$_POST['type'];
	$id=$_POST['id'];
	$cdflag=$_POST['cdflag'];
	$sql="select $type from salary where userid ='".$id."' ";
	$res=$this->db->get_one($sql);
	if($cdflag=='1'){
		$res = $this->salaryClass->dataCript($res, 'decode');
		return json_encode( $res );
	}else{
		return $res[$type];
	}
}
/**
 * ��ʱ����
 */
function change_error($comedt,$leavedt, $amount,$pid){
	$baseNow = $this->salaryClass->salaryDealLeave($comedt,$leavedt, $amount);
	$this->model_pay_update($pid,
			array('basenowam' => $baseNow)
			);
	$this->model_pay_stat($pid);
}
/*
 * ���¹���
 */
function update_salary(){
	/*
	   $data=array(344,356,394,410,345,238,252,294,312,239);
	   foreach($data as $val){
	   $this->model_pay_stat($val,'`shiyuanoa`.');
	   }
	 * for($i=115;$i<=222;$i++){
	 $this->model_pay_stat($i,'`shiyuanoa`.');
	 }

	 $data=array(
	 294,394
	 );
	 foreach($data as $val){
	 $this->model_pay_stat($val,'`shiyuanoa`.');
	 }
	 $sql="SELECT  p.id  FROM salary_pay p
	 left join salary s on (s.userid=p.userid)
	 where p.pyear=2012 and p.pmon=6 and (p.gjjam<>s.gjjam  or p.shbam<>s.shbam)";
	 $query=$this->db->query($sql);
	 while($row=$this->db->fetch_array($query)){
	 $this->model_pay_stat($row['id']);
	 }
	 $sql="SELECT  p.id  FROM `beiruanoa`.salary_pay p
	 left join salary s on (s.userid=p.userid)
	 where p.pyear=2012 and p.pmon=7 and s.userid=p.userid";
	 $query=$this->db->query($sql);
	 while($row=$this->db->fetch_array($query)){
	 $this->model_pay_stat($row['id'],'`beiruanoa`.');
	 }
	 */
	//$this->model_pay_stat(27091);
	//$this->model_pay_stat(707,'`shiyuanoa`.');
	//$this->model_pay_stat(708,'`shiyuanoa`.');
	$data=array(36573);
	foreach($data as $val){
		$this->model_pay_stat($val);
	}
}
/**
 * �������
 */

function get_decrypt_deal(){
	$val=array('4T3znHIkj4Vy+j2IF/zErQ==');
	foreach($val as $vval){
		$res.='--'.$vval.' �� '.$this->salaryClass->decryptDeal($val);
	}
	file_put_contents('decrypt',$res);
}
/**
 * ���ս�����
 */
function update_salary_yeb(){
	if($_SESSION['USER_ID']=='yanping.li'){
		$sql="SELECT
			y.id , y.yearam
			, p.totalam , p.gjjam , p.shbam , p.cessebase
			, y.realam , y.usercard
			FROM salary_yeb y
			left join hrms h on (y.usercard=h.usercard)
			left join salary_pay p on ( p.userid=h.user_id and p.pyear='2012' and p.pmon='2' )
			where
			y.syear='2011'";
		$query=$this->db->query($sql);
		$updata=array();
		while($row=$this->db->fetch_array($query)){
			$updata[$row['id']]['yam']=$this->salaryClass->decryptDeal($row['yearam']);
			$updata[$row['id']]['bam']=$this->salaryClass->decryptDeal($row['totalam']);
			$updata[$row['id']]['gjjam']=$this->salaryClass->decryptDeal($row['gjjam']);
			$updata[$row['id']]['shbam']=$this->salaryClass->decryptDeal($row['shbam']);
			$updata[$row['id']]['realam']=$this->salaryClass->decryptDeal($row['realam']);
			$updata[$row['id']]['cb']=$row['cessebase'];
			$updata[$row['id']]['usercard']=$row['usercard'];
		}
		if(!empty($updata)){
			$tmuid='';
			foreach($updata as $key=>$val){
				if(!empty($key)){
					$yearAm=round($val['yam'],2);
					$lastmonam=round($val['bam']-$val['gjjam']-$val['shbam']);
					if($val['usercard']=='000977'){
						$lastmonam=round(1204.55);
					}
					if($val['usercard']=='00001551'){
						$lastmonam=round(2522.73-189.2);
					}
					if($val['realam']!=$lastmonam){
						$tmuid.=','.$key;
						$payCesseAm=$this->salaryClass->cesseDealYeb($yearAm, $lastmonam, $val['cb']);
						$payAm=round($yearAm-$payCesseAm,2);
						$sql="update salary_yeb set
							yearam='".$this->salaryClass->encryptDeal($yearAm)."'
							, paycesseam='".$this->salaryClass->encryptDeal($payCesseAm)."'
							, payam='".$this->salaryClass->encryptDeal($payAm)."'
							, sta='0' , inputuser='".$_SESSION['USER_ID']."' , inputdt=now()
							, realam='".$this->salaryClass->encryptDeal($lastmonam)."'
							where id='".$key."' ";
						$this->db->query($sql);
					}
				}
			}
			$this->globalUtil->insertOperateLog('���ս�����', '', '�ʼ�����ʧ��' . $tmuid, '�ɹ�', $tmuid);
		}
	}
}
/**
 * ��Ŀ
 */
function deal_pro(){
	$proArr=array();
	$sql="(SELECT t.id ,  t.name , t.pyear , t.pmon , p.userid , p.totalam  , p.shbam , p.gjjam , p.paycesse , p.paytotal  ,'' as com  FROM salary_user_type t
		left join salary_pay p on ( find_in_set(p.userid , t.members) and p.pyear=t.pyear and p.pmon=t.pmon )
		where p.id is not null and t.pmon!=8)
		union
		(SELECT t.id ,  t.name , t.pyear , t.pmon , p.userid , p.totalam  , p.shbam , p.gjjam , p.paycesse , p.paytotal ,'s' as com   FROM salary_user_type t
		 left join `shiyuanoa`.salary_pay p on ( find_in_set(p.userid , t.members) and p.pyear=t.pyear and p.pmon=t.pmon )
		 where p.id is not null and t.pmon!=8)
		union
		(SELECT t.id ,  t.name , t.pyear , t.pmon , p.userid , p.totalam  , p.shbam , p.gjjam , p.paycesse , p.paytotal ,'b' as com  FROM salary_user_type t
		 left join `beiruanoa`.salary_pay p on ( find_in_set(p.userid , t.members) and p.pyear=t.pyear and p.pmon=t.pmon )
		 where p.id is not null and t.pmon!=8)";
	$query=$this->db->query($sql);
	while($row=$this->db->fetch_array($query)){

		$proArr[$row['id']][$row['com'].'totalam']=isset($proArr[$row['id']][$row['com'].'totalam'])?round($proArr[$row['id']][$row['com'].'totalam']+$this->salaryClass->decryptDeal($row['totalam']),2):$this->salaryClass->decryptDeal($row['totalam']);
		$proArr[$row['id']][$row['com'].'shbam']=isset($proArr[$row['id']][$row['com'].'shbam'])?round($proArr[$row['id']][$row['com'].'shbam']+$this->salaryClass->decryptDeal($row['shbam']),2):$this->salaryClass->decryptDeal($row['shbam']);
		$proArr[$row['id']][$row['com'].'gjjam']=isset($proArr[$row['id']][$row['com'].'gjjam'])?round($proArr[$row['id']][$row['com'].'gjjam']+$this->salaryClass->decryptDeal($row['gjjam']),2):$this->salaryClass->decryptDeal($row['gjjam']);
		$proArr[$row['id']][$row['com'].'paycesse']=isset($proArr[$row['id']][$row['com'].'paycesse'])?round($proArr[$row['id']][$row['com'].'paycesse']+$this->salaryClass->decryptDeal($row['paycesse']),2):$this->salaryClass->decryptDeal($row['paycesse']);
		$proArr[$row['id']][$row['com'].'paytotal']=isset($proArr[$row['id']][$row['com'].'paytotal'])?round($proArr[$row['id']][$row['com'].'paytotal']+$this->salaryClass->decryptDeal($row['paytotal']),2):$this->salaryClass->decryptDeal($row['paytotal']);

	}

	if(!empty($proArr)){
		foreach ($proArr as $key=>$val) {
			$sql="update salary_user_type set
				totalam = '".$val['totalam']."'  , shbam = '".$val['shbam']."'
				, gjjam = '".$val['gjjam']."', paycesse = '".$val['paycesse']."'
				, paytotal = '".$val['paytotal']."'

				,stotalam = '".$val['stotalam']."'  , sshbam = '".$val['sshbam']."'
				, sgjjam = '".$val['sgjjam']."', spaycesse = '".$val['spaycesse']."'
				, spaytotal = '".$val['spaytotal']."'

				,btotalam = '".$val['btotalam']."'  , bshbam = '".$val['bshbam']."'
				, bgjjam = '".$val['bgjjam']."', bpaycesse = '".$val['bpaycesse']."'
				, bpaytotal = '".$val['bpaytotal']."'
				where id='".$key."' ";
			$this->db->query($sql);
		}
	}
}
/**
 * ��ȡ�������������Ա��UserId
 * @param string ����ids   e.g: 207,209,210
 * @return string Ա��ids  e.g: 'san.zhang','si.li'
 * add by zengq 2015-02-06
 */
private function getDeptUserIds($deptIds){
	$deptUserSql = "SELECT `user`.USER_ID FROM `user` WHERE `user`.DEPT_ID IN (".trim($deptIds,',').")";
	$deptUserQuery = $this->db->query($deptUserSql);
	$deptUserId = '';
	while ($row = $this->db->fetch_array($deptUserQuery)) {
		$deptUserId.="'".$row['USER_ID']."',";
	}
	return substr($deptUserId,0,strlen($deptUserId)-1);
}
/**
 *����dppow������������Ȩ�޻�ȡ��Ҫƴ�ӵ�sql
 *@param string ����ids   e.g: 207,209,210
 *@param array ��������   array('1'=>'��Ϊ���ܵĲ���','2'=>'�ܾ���ܵĲ���') �������� $this->model_dp_pow();
 * add by zengq 2015-02-06
 */
private function getSqlParam($deptIds,$dppow){

	if(!empty($deptIds)){
		if(strpos("perm".$deptIds,";")>0){
			return " ";
		}
		$deptUserId = $this->getDeptUserIds($deptIds); //��ȡ��������µ�����Ա��id
		$sqlpow=" and ( p.deptid in ('". implode("','", $dppow['1'])."','" . implode("','", $dppow['2']) ."')
			or p.userid='".$_SESSION['USER_ID']."' or p.userid in ($deptUserId)
			or p.deptid in ( ".trim($deptIds,',')." )) ";
	}else{
		$sqlpow = " and ( ";
		if(count($dppow)>0){
			$dppowIds = "'". implode("','", $dppow['1'])."','" . implode("','", $dppow['2']) ."'";
			$deptUserId = $this->getDeptUserIds($dppowIds); //��ȡ�������µ�����Ա��id
			$sqlpow.="p.deptid in ($dppowIds) or p.userid in ($deptUserId) or ";
		}
		$sqlpow.="p.userid='".$_SESSION['USER_ID']."' ) ";
	}
	return $sqlpow;
}

function model_sendSalaryToFlow() {
	$seapy = $_GET['seapy']?$_GET['seapy']:$this->nowy;
	$seapm = $_GET['seapm']?$_GET['seapm']:$this->nowm;
	$pid = $_GET['pid'];
	$filter = " and 1=1";
	if($pid) {
		$filter = " and p.id = $pid";
	}

	$userid = '';

	//ȥ�����ύ������
	$sql = 'select d.dept_name,d.pdeptname,p.* from salary_pro p inner join `user` u on p.userid = u.USER_ID 
		left join department d on u.DEPT_ID = d.DEPT_ID where p.pyear = '.$seapy.' and p.pmon='.$seapm.' and p.flaflag = 0'.$filter;
	$query = $this->db->query($sql);
	try {
		$this->db->query("START TRANSACTION");
		while($row = $this->db->fetch_array($query)) {
			$flowname = $this->flowName['salarypro']."-".$row['dept_name'];
			$userid = $row['userId'];
			if(empty($flowname) == false) {
				//������Ա������������������
				$flowname = $this->flowName['salarypro']."-".$row['dept_name'];
				$info=array('flowname'=>$flowname
						,'userid'=> $row['userId']
						,'salarykey'=> $row['rand_key']
					   );
				$this->model_flow_new($info,true,false);
			}
		}
		//����Ϊ������
		$sql = 'update salary_pro p set p.flaflag = 1 where p.pyear = '.$seapy.' and p.pmon='.$seapm.' and p.flaflag = 0'.$filter;
		$this->db->query_exc($sql);
		$this->db->query("COMMIT");
		echo un_iconv('�ύ�����ɹ�');	
	}catch(Exception $e) {
		$this->db->query("ROLLBACK");
		echo $userid;
	}

}

	function model_del_pro() {
		$pid = $_GET['pid'];
		$delsql = "delete from salary_pro where id = '".$pid."';";
		$this->db->query_exc($delsql);
		$delsql = "delete from salary_pro_sub where pid = '".$pid."';";
		$this->db->query_exc($delsql);
	}
	/**
	 * ���ɿ����ܱ�����
	 */
	function model_initSalaryPro() {
		
		//Ŀǰ����
        $seapy = $_GET['seapy']?$_GET['seapy']:$this->nowy;
        $seapm = $_GET['seapm']?$_GET['seapm']:$this->nowm;
        
        //�ϸ�������
        $seapyb = $seapy;
        $seapmb = $seapm;
        
        //��ȡ��һ������
       	if($seapmb == 1) {
       		$seapmb = 12;
       		$seapyb = $seapyb - 1;
       	}else {
       		$seapmb = $seapmb - 1;
       	}
        
        $salaryArr=array();
        $salaryPayArr=array();
        
        //��ȡ��һ��������Ȼ������
        $monthDays = date("t",strtotime($seapyb."-".$seapmb));
        
        //TODO ���� ���� �ӿڻ�ȡ���ڽ����Ŀǰ������������
        //$kh = $this->virtual_data();
        $logDao = new model_engineering_worklog_esmworklog();
        $kh = $logDao->getAssessInfo_d($seapyb, $seapmb);
        try {
        	$this->db->query("START TRANSACTION");
			
        	//��ѯ�Ѿ����ɵĿ��˹����ܱ�
        	$sql = "select userid from salary_pro where pyear = '".$seapy."' and pmon = '".$seapm."'";
        	$query = $this->db->query($sql);
        	$existUserId = array();
			while($row = $this->db->fetch_array($query)) {
				$existUserId[$row['userid']] = $row['userid'];
			}
        	
	        foreach ($kh as $val) {
	        	$userid = $val['createId'];
	        	//�Ѿ����ɵ����ݲ����ٴ�����
	        	if($existUserId[$userid]) {
	        		continue;
	        	}
				//�������  �� ��־����/��Ȼ������
	        	$inWorkRateAvg = round($val['inWorkRate']/$monthDays,3);
	        	//����������ɣ�
	        	//$averageScore = $val['averageScore'];
	        	//����������£�
	        	$monthScoreAvg = round($val['monthScore']/$val['inWorkRate'],3);
	        	
	        	//��ȡ�ϸ��µ�н�ʽṹ
		       	$sql = "select s.userid,s.jjam,s.gljtam,s.lszsam,s.txjt,s.qtjtam,s.expenCeiling,h.userNo from salary_adjust s left join oa_hr_personnel h on s.UserId = h.userAccount where s.userid = '".$userid."' and s.pyear = ".$seapyb." and s.pmon = ".$seapmb."";
		       	$rs = $this->db->get_one($sql);
		       	if(empty($rs)) {
		       		//û�ϸ��µ�н�ʽṹ �� ��ȡĿǰ��н�ʽṹ
		       		$sql = 'select s.userid,s.jjam,s.gljtam,s.lszsam,s.txjt,s.qtjtam,s.expenCeiling,h.userNo,h.deptIdS,h.deptNames from salary s left join oa_hr_personnel h on s.UserId = h.userAccount where s.userid = \''.$userid.'\' and ifnull(s.Sta,0) = 0';
		       		$rs = $this->db->get_one($sql);
		       	}
	        	//ס�޲�����ͨ�Ų��������Բ��� * �������
	        	$lszsAm = round($this->salaryClass->decryptDeal($rs['lszsam'])*$inWorkRateAvg,2);
	        	$txjt = round($this->salaryClass->decryptDeal($rs['txjt'])*$inWorkRateAvg,2);
	        	$qtjtam = round($this->salaryClass->decryptDeal($rs['qtjtam'])*$inWorkRateAvg,2);
	        	//��Ч�����������������Ų��� * �������
	        	$jjAm = round($this->salaryClass->decryptDeal($rs['jjam'])*$monthScoreAvg*$inWorkRateAvg,2);
	        	$gljtAm = round($this->salaryClass->decryptDeal($rs['gljtam'])*$monthScoreAvg*$inWorkRateAvg,2);
	        	$expenCeiling = round($this->salaryClass->decryptDeal($rs['expenCeiling'])*$monthScoreAvg*$inWorkRateAvg,2);
	        	
	        	//�Ƿ�����������
	        	$findPro = "select * from salary_pro where userid = '".$userid."' and pyear = '".$seapy."' and pmon = '".$seapm."'";
	        	$prors = $this->db->get_one($findPro);
	        	$proid = '';
	        	if($prors) {
	        		$proid = $prors["id"];
	        	}else {
		        	$rand_key = get_rand_key();

		        	//��ȡ�������ʣ��������� = ��������н+��λ����+��Ч���ʣ�
		        	$baseAmSql = "select baseAm,gwam,jxam from salary_pay p where p.userid = '".$userid."' and p.pyear = '".$seapy."' and p.pmon = '".$seapm."'";
		        	$baseAmSqlResult = $this->db->get_one($baseAmSql);
		        	$baseAm = $this->salaryClass->encryptDeal(round($this->salaryClass->decryptDeal($baseAmSqlResult["baseAm"]) + $this->salaryClass->decryptDeal($baseAmSqlResult["gwam"]) + $this->salaryClass->decryptDeal($baseAmSqlResult["jxam"]),2));
		        	
		        	$insertPro = "insert into salary_pro(userid,userName,pyear,pmon,rand_key,flaflag,userCard,baseam,DeptId,DeptName) 
		        			value('".$userid."','".$val['createName']."','".$seapy."','".$seapm."','".$rand_key."',0,'".$rs['userNo']."','".$baseAm."','".$rs['deptIdS']."','".$rs['deptNames']."')";
		        	$this->db->query_exc($insertPro);
		        	$proid = $this->db->insert_id();
	        	}
	        	
	        	$insertProSub = "insert into salary_pro_sub ( pid, projectId, projectCode, projectName, inWorkRate, monthScore, averageScore, lszsAm, txjt, qtjtam, jjAm, gljtAm, expenCeiling) 
	        					 values ( '".$proid."', '".$val['projectId']."', '".$val['projectCode']."', '".$val['projectName']."', '".$val['inWorkRate']."', '".$val['monthScore']."', '".$val['averageScore']."', '".$this->salaryClass->encryptDeal($lszsAm)."', '".$this->salaryClass->encryptDeal($txjt)."', '".$this->salaryClass->encryptDeal($qtjtam)."', '".$this->salaryClass->encryptDeal($jjAm)."', '".$this->salaryClass->encryptDeal($gljtAm)."','".$this->salaryClass->encryptDeal($expenCeiling)."')";
	        	
	        	//�ۼ���������
	        	$prors = $this->db->get_one($findPro);
	        	$inWorkRate = round($prors['inWorkRate'] + $val['inWorkRate'],2);
	        	$monthScore = round($prors['monthScore'] + $val['monthScore'],2);
	        	$plszsAm = $this->salaryClass->encryptDeal(round($this->salaryClass->decryptDeal($prors['lszsAm']) + $lszsAm,2));
	        	$ptxjt = $this->salaryClass->encryptDeal(round($this->salaryClass->decryptDeal($prors['txjt']) + $txjt,2));
	        	$pqtjtam = $this->salaryClass->encryptDeal(round($this->salaryClass->decryptDeal($prors['qtjtam']) + $qtjtam,2));
	        	$pjjAm = $this->salaryClass->encryptDeal(round($this->salaryClass->decryptDeal($prors['jjAm']) + $jjAm,2));
	        	$pgljtAm = $this->salaryClass->encryptDeal(round($this->salaryClass->decryptDeal($prors['gljtAm']) + $gljtAm,2));
	        	$pexpenCeiling = $this->salaryClass->encryptDeal(round($this->salaryClass->decryptDeal($prors['expenCeiling']) + $expenCeiling,2));
	        	
	        	$updateProSql = "update salary_pro set inWorkRate = '".$inWorkRate."',monthScore = '".$monthScore."',lszsAm = '".$plszsAm."',txjt = '".$ptxjt."',qtjtam = '".$pqtjtam."',jjAm = '".$pjjAm."',gljtAm = '".$pgljtAm."',expenCeiling ='".$pexpenCeiling."' where id = '".$prors["id"]."'";
	        	$this->db->query_exc($updateProSql);
// 	        	print_r($updateProSql);
// 	        	die();
	        	
	        	$this->db->query_exc($insertProSub);
	        }   
	        $this->db->query("COMMIT");
        	echo un_iconv('����н�ʲ����ɹ�');		
		}catch (Exception $e) {
            $this->db->query("ROLLBACK");
       		echo un_iconv('����н�ʲ���ʧ��');
        }
		//$newam = round($resprod['jjam']+$resprod['gljtam']+$resprod['qtjtam']+$resprod['jxzcam']+$resprod['lszsam'] ,2);
		//����salrypay
		//$this->model_pay_update($payid,$payinfo,$payinfoE);
	}

function updateSalaryPay() {
	/*
	   $proArr=array();
	   $sql="select p.id as 'pid' from salary_pay p where PMon = 11 and PYear=2015 and EXISTS (select 1 from salary_temp_20151202 t where p.UserId = t.userid);";
	   $query=$this->db->query($sql);
	   $rows = 0;
	   while($row=$this->db->fetch_array($query)){
	   $this->model_pay_stat($row['pid']);
	   $rows++;
	   }
	   echo "�ɹ�ִ��".$rows."������";
	 */
	$salaryPayId = "121428,123525,122223,124291,121048,123151,121921,124007,122180,124254,121625,123718,121272,123372,122070,124150,121826,123914,121587,123680,121618,123711,121732,123820,122191,124264,121884,123970,120943,123047,121285,123385,121885,123971,121627,123720,122483,124545,122141,124217,122440,124502,122360,124424,121753,123841,121484,123579,122275,124342,121759,123847,121862,123948,121498,123593,121886,123972,121887,123973,121736,123824,121710,123798,121749,123837,121620,123713,121607,123700,121941,124025,121051,123154,121225,123326,121739,123827,121892,123978,121988,124069,121415,123512,121526,123620,121052,123155,121888,123974,121841,123928,121836,123924,121582,123675,122069,124149,121879,123965,121421,123518,121491,123586,121545,123639,122076,124156,121045,123148";
	$salaryPayIds = explode(',',$salaryPayId); 
	for($index=0;$index<count($salaryPayIds);$index++) 
	{ 
		$this->model_pay_stat($salaryPayIds[$index]);
	} 
	//  $this->model_pay_stat(116118);

}

function model_encryptDeal(){
	echo $this->salaryClass->encryptDeal('386.36');
	die();
}

function model_decryptDeal() {
	echo $this->salaryClass->decryptDeal('FzTt/wzYL8jz2QTzlYW4Zw==');
	die();
}

//*********************************��������************************************
function __destruct() {

}

}
