<?php require('includes/application_top.php'); 
$this_page = 'home';
$shop_name = '';
	if (!tep_session_is_registered('customer_id') || !tep_session_is_registered('customer_role_id') ||!tep_session_is_registered('customer_manufacturer_id') ||!tep_session_is_registered('customer_entity_id')) {
		$navigation->set_snapshot();
		tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
	}
	$s_query = tep_db_query("select * from " . TABLE_ENTITIES . " where entities_id = '" . $customer_entity_id . "'");
    if (!tep_db_num_rows($s_query)) {
			$navigation->set_snapshot();
		tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
	} else {
	
			 $s = tep_db_fetch_array($s_query);
			 $shop_name = $s['entities_name'];
	}
?>
<?php require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFAULT); ?>
<?php require(DIR_WS_INCLUDES . 'page_top.php'); ?>
    <div id="page_content">
<?php
/*
$stockage_per_months = array(
1=>0,
2=>0,
3=>0,
4=>0,
5=>0,
6=>0,
7=>0,
8=>0,
9=>0,
10=>0,
11=>0,
12=>0);
$documents_per_months = array(
1=>0,
2=>0,
3=>0,
4=>0,
5=>0,
6=>0,
7=>0,
8=>0,
9=>0,
10=>0,
11=>0,
12=>0);
$this_year = date('Y');
$buyed = array();
// kiosks 
$kiosks_array = array();
		$kiosks_query = tep_db_query("select * from " . TABLE_TCPOS_KIOSKS . " where tcpos_shops_id = '" . (int)$customer_shop_id . "'");
        if (tep_db_num_rows($kiosks_query)) {
		$i=0;
        while ($k = tep_db_fetch_array($kiosks_query)) {
				$kiosks_array[$i]['id'] = $k['tcpos_kiosks_id'];
				$kiosks_array[$i]['name'] = $k['name'];
				$kiosks_array[$i]['orders'] = 0;
				$i++;
		}
		}
// nb visitors 
$visitorZ = managerGetVisitorsByShop($customer_shop_id);
$total_nb_visitors = count($visitorZ);
foreach($visitorZ as $z) {
			$tos_date = $z['date_added'];
			$ks_year = date("Y", strtotime($tos_date));
			if ($ks_year == $this_year) {
					$ks_month = date("n", strtotime($tos_date));
					$stockage_per_months[$ks_month] = $stockage_per_months[$ks_month]+1;
			}
}
$transaction_id = managerGetTransactionId();
$total_nb_articles_and_menus = 0;
$ts = managerGetArticles($transaction_id);
if ($ts) { 
	foreach($ts as $t) {
		$as = json_decode($t['articles'], true);
		$nb_articles = count($as);
		$total_nb_articles_and_menus += $nb_articles;
	}
}
$date = false;
if (isset($_GET['date']) && !empty($_GET['date']) && ($_GET['date'] != 'none')  ) $date= $_GET['date'];
$ps =  getOrdersByShop($customer_shop_id, 'none');
$date_array = array();
$total_nb_orders = 0;
$total_nb_orders_success = 0;
$total_sales = 0;
foreach ($ps as $po) {
			$total_nb_orders++;
			$m=0;
			foreach($kiosks_array as $ka) {
					if ($ka['id'] == $po['tcpos_kiosks_id'] ) 
					$kiosks_array[$m]['orders'] = $ka['orders']+1;
					$m++;
			}
			$tcpos_list_shopping = $po['tcpos_list_shopping'];
			$tcpos_status = strtolower($po['tcpos_status']);
			if ($tcpos_status == 'success') {
			$total_nb_orders_success++;
			$list = json_decode($tcpos_list_shopping, true);
			foreach($list as $l) {
					$price = $l['price'];
					$p_name = $l['description'];
					if (array_key_exists($l['description'], $buyed)) {
								$buyed[$p_name] = $buyed[$p_name] +1;
					} else {
					$buyed[$p_name] = 1;
					}
					$total_sales = $total_sales +$price;
			}
			}
			$tcpos_date = $po['tcpos_date']; // mysql format
			$search_str = date("M Y", strtotime($tcpos_date));
			
			$ks_year = date("Y", strtotime($tcpos_date));
			if ($ks_year == $this_year) {
					$ks_month = date("n", strtotime($tcpos_date));
					$documents_per_months[$ks_month] = $documents_per_months[$ks_month]+1;
			}
			$search_formated = date("Y-m", strtotime($tcpos_date));
			$found = false;
			foreach ($date_array as $key => $value) {
							if ($key == $search_formated) $found = true;
			
			}
			if (!$found) {
							$date_array[$search_formated] = $search_str;
			}
}
$i = 0; 
foreach ($kiosks_array as $ka) {
		$series_array[$i] = $ka['orders'];
		$i++;
}
$series = implode(',', $series_array);
arsort($buyed);
$d = 0;
foreach($buyed as $key=>$value) {
		$charts_labels[$d] = $key;
		$charts_serie[$d] = $value;
		$d++;
}
*/
$stockage_per_months = array(
1=>0,
2=>0,
3=>0,
4=>0,
5=>0,
6=>0,
7=>0,
8=>0,
9=>0,
10=>0,
11=>0,
12=>0);
$documents_per_months = array(
1=>0,
2=>0,
3=>0,
4=>0,
5=>0,
6=>0,
7=>0,
8=>0,
9=>0,
10=>0,
11=>0,
12=>0);
$this_year = date('Y');
$nb_total_doc = 0;
$nb_total_doc_stockes = 0;
$nb_total_valide = 0;
$nb_total_en_attente = 0;
$nb_total_refuse = 0;

$query = "select document_stockage, document_date_added, document_status from " . TABLE_DOCUMENTS . " where entities_id = '" . intval($customer_entity_id) . "' and document_status != '0'";
$pcaq = tep_db_query($query);
while($pca = tep_db_fetch_array($pcaq)) {
  $nb_total_doc = $nb_total_doc + 1;
  if ((int)$pca['document_stockage'] == 1 ) $nb_total_doc_stockes = $nb_total_doc_stockes + 1;
  if ((int)$pca['document_status'] == 1 ) $nb_total_valide = $nb_total_valide + 1;
  if ((int)$pca['document_status'] == 2 ) $nb_total_en_attente = $nb_total_en_attente + 1;
  if ((int)$pca['document_status'] == 3 ) $nb_total_refuse = $nb_total_refuse + 1;
 
  $ks_year = date("Y", strtotime($pca['document_date_added']));
	if ($ks_year == $this_year) {
					$ks_month = date("n", strtotime($pca['document_date_added']));
					$documents_per_months[$ks_month] = $documents_per_months[$ks_month]+1;
          if ((int)$pca['document_stockage'] == 1 ) $stockage_per_months[$ks_month] = $stockage_per_months[$ks_month]+1;
	}    
}
$nb_total_comptes = 0;
$nb_total_visitors = 0;
$all_customers = array();
$c = 0;
$cqy = tep_db_query("select customers_id, customers_firstname, customers_lastname, roles_id, customers_image from " . TABLE_CUSTOMERS . " where manufacturers_id = '" . intval($customer_manufacturer_id) . "' AND roles_id != '1' AND entities_id='".intval($customer_entity_id)."' ORDER BY customers_id DESC");
while($cq = tep_db_fetch_array($cqy)) {
    $nb_total_comptes = $nb_total_comptes +1;
    $all_customers[$c]['name'] = $cq['customers_firstname']. ' '.$cq['customers_lastname'];
    $all_customers[$c]['id'] =$cq['customers_id'];
    $all_customers[$c]['role'] =$cq['roles_id'];
    $all_customers[$c]['avatar'] =$cq['customers_image'];
    $c++;
}
?>
    <div id="page_heading" data-uk-sticky="{ top: 48, media: 960 }">
			<h1><?php echo $shop_name; ?></h1>
			<span class="uk-text-upper uk-text-small">Dashboard & Statistics</span>
        </div>
        <div id="page_content_inner">
		
<!-- begin stats -->
<!-- small charts -->
           <!-- statistics (small charts) -->
            <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium hierarchical_show" data-uk-grid-margin>

                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span></div>
                            <span class="uk-text-muted uk-text-small">Total Documents</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe2"><?php echo $nb_total_doc; ?></span></h2>
                        </div>
                    </div>
                </div>


				<div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_visitors peity_data">5,3,9,6,5,9,7</span></div>
                            <span class="uk-text-muted uk-text-small">Documents Stockés</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript><?php echo $nb_total_doc_stockes; ?></noscript></span></h2>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">64/100</span></div>
                            <span class="uk-text-muted uk-text-small">Documents en attente</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript><?php echo $nb_total_en_attente; ?></noscript></span></h2>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_sale2 peity_data">5,3,9,6,5,9,7,9,5,6,9,3,5</span></div>
                            <span class="uk-text-muted uk-text-small">Comptes Utilisateurs</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript><?php echo $nb_total_comptes; ?></noscript></span></h2>
                        </div>
                    </div>
                </div>
            </div>
<!-- end small charts -->
<?php
$i = 0;
$buyed = array();
$ass_query = tep_db_query("select assureur_id, assureur_name, short_name from " . TABLE_DOCUMENTS_ASSUREURS . " order by assureur_name");
while ($ass = tep_db_fetch_array($ass_query)) {
     $pquery = tep_db_query("select count(*) as total from " . TABLE_DOCUMENTS . " where entities_id = '" . intval($customer_entity_id) . "' AND document_status != '0' AND document_assureur = '".$ass['assureur_id']."'");
      $pq = tep_db_fetch_array($pquery);
      if ($pq['total'] > 0) {
            $p_name = str_replace("'", "’",utf8_encode($ass['assureur_name']) );
            $buyed[$p_name] = $pq['total'];
            $i++;
      }
}
arsort($buyed);
$d = 0;
foreach($buyed as $key=>$value) {
		$charts_labels[$d] = $key;
		$charts_serie[$d] = $value;
		$d++;
}
$series2_array = array($nb_total_valide, $nb_total_en_attente, $nb_total_refuse);
$series2 = implode(',', $series2_array);
$kiosks_array2[0]['short_name'] = 'Signé & valide';
$kiosks_array2[1]['short_name'] = 'En attente';
$kiosks_array2[2]['short_name'] = 'Refusé';
?>
<!-- pie -->			
		    <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-3">
                    <div class="md-card">
                        <div class="md-card-content" style="position: relative">
                            <h4 class="heading_c uk-margin-bottom">État des documents</h4>
                            <div id="chartist_simple_pie2" class="chartist chartist-labels-inside"></div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-2-3">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h4 class="heading_c uk-margin-bottom">Historique</h4>
                            <div id="c3_chart_spline2" class="c3chart"></div>
                        </div>
                    </div>
                </div>
        </div>
<!-- end pie -->
            <!-- tasks -->
            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match="{target:'.md-card-content'}">
                <div class="uk-width-medium-1-2">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-overflow-container">
                                <table class="uk-table">
                                    <thead>
                                        <tr>
                                            <th class="uk-text-nowrap"></th>
                                            <th class="uk-text-nowrap">Derniers inscrits</th>
                                            <th class="uk-text-nowrap">Rôle</th>
                                            <th class="uk-text-nowrap uk-text-right">Documents</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$count = 0; 
foreach($all_customers as $t) {
  $avatar = $t['avatar'];
  if (!tep_not_null($avatar)) $avatar = MAIN_THEME_URL.'assets/img/avatars/user.png';
  else $avatar = DIR_WS_AVATARS.$t['id'].'/'.$avatar;
?>
                                        <tr class="uk-table-middle">
                                            <td class="uk-width-2-10 uk-text-nowrap"><img class="md-user-image" src="<?php echo $avatar; ?>" alt="" style="width:34px; height:34px"></td>
                                            <td class="uk-width-4-10 uk-text-nowrap"><?php echo $t['name']; ?></td>
                                             <td class="uk-width-2-10 uk-text-nowrap"><?php echo tep_get_roles_name($t['role']); ?></td>
                                            <td class="uk-width-2-10 uk-text-right uk-text-muted uk-text-small"><?php echo tep_get_nb_documents($t['id']); ?></td>
                                        </tr>
<?php 
$count++;
if ($count > 5) break;
} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-1-2">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h3 class="heading_a uk-margin-bottom"><?php echo DOC_33; ?></h3>
                            <div id="ct-chart" class="chartist"></div>
                        </div>
                    </div>
                </div>
            </div>
<!-- end task -->
<!-- info cards -->
        </div>
    </div>
<style>
.ct-legend {
    list-style: none;
    text-align: center;
position: absolute; top:0; right:10px;
}
.ct-legend .ct-series-0:before {
    background-color: #7cb342;
    border-color: #7cb342;
}
.ct-legend .ct-series-1:before {
    background-color: #2196f3;
    border-color: #2196f3;
}
.ct-legend .ct-series-2:before {
    background-color: #ffa000;
    border-color: #ffa000;
}

.ct-legend li:before {
    width: 12px;
    height: 12px;
    position: absolute;
    left: 0;
    content: '';
    border: 3px solid transparent;
    border-radius: 2px;
}
/* refuse*/
.ct-series-c .ct-slice-pie {
    fill: #e53935;
}
/* en attente*/
.ct-series-b .ct-slice-pie {
    fill: #ffa000;
}
/* valide*/
.ct-series-a .ct-slice-pie {
    fill: #0097a7;
}
</style>
<?php 
$page_extra_script = "
	<script>
   $('.peity_sale2').peity('line', {
            height: 28,
            width: 64,
            fill: '#e2c2e8',
            stroke: '#ea80fc'
   });
        /// pie chart
		var data = {
            series: [".$series2."]
        };
		var count = 0;
		var thisLabel='';
        var sum = function(a, b) { return a + b };
        var ch_simple_pie = new Chartist.Pie('#chartist_simple_pie2', data, {
            labelInterpolationFnc: function(value) {
				if (count == 0) thisLabel = '".$kiosks_array2[0]['short_name']." ';
				if (count == 1) thisLabel = '".$kiosks_array2[1]['short_name']." ';
				if (count == 2) thisLabel = '".$kiosks_array2[2]['short_name']." ';
				if (count == 3) thisLabel = '".$kiosks_array2[3]['short_name']." ';
				count = count+1;
                if(value>0)
                return thisLabel +' ' + Math.round(value / data.series.reduce(sum) * 100) + '%';
                else
                return '';
            }
        });
        \$window.on('resize',function() {
            ch_simple_pie.update();
        });
		

        // spline chart
        var c3chart_spline_id = '#c3_chart_spline2';

        if ( $(c3chart_spline_id).length ) {

            var c3chart_spline = c3.generate({
                bindto: c3chart_spline_id,
                data: {
					 x: 'x',
                    columns: [
						['x', 'Jan', 'Fev', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil', 'Aout', 'Sept', 'Oct', 'Nov', 'Dec'],
                        ['Documents Stockés', ".$stockage_per_months[1].", ".$stockage_per_months[2].", ".$stockage_per_months[3].", ".$stockage_per_months[4].", ".$stockage_per_months[5].", ".$stockage_per_months[6].", ".$stockage_per_months[7].", ".$stockage_per_months[8].", ".$stockage_per_months[9].", ".$stockage_per_months[10].", ".$stockage_per_months[11].", ".$stockage_per_months[12]."],
                        ['Documents', ".$documents_per_months[1].", ".$documents_per_months[2].", ".$documents_per_months[3].", ".$documents_per_months[4].", ".$documents_per_months[5].", ".$documents_per_months[6].", ".$documents_per_months[7].", ".$documents_per_months[8].", ".$documents_per_months[9].", ".$documents_per_months[10].", ".$documents_per_months[11].", ".$documents_per_months[12]."]
                    ],
                    type: 'spline'
                },
                color: {
                    pattern: ['#5E35B1', '#FB8C00']
                },
    axis: {
        x: {
			label: 'X Label',
            type: 'category',
            tick: {
                rotate: 0,
                multiline: false
            }
        }
    }
            });

            \$window.on('debouncedresize', function () {
                c3chart_spline.resize();
            });

        }
		
        $('.countUpMe').each(function () {
            var target = this, countTo = $(target).text();
            theAnimation = new CountUp(target, 0, countTo, 0, 2);
            theAnimation.start();
        });


        $('.peity_orders').peity('donut', {
            height: 24,
            width: 24,
            fill: ['#8bc34a', '#eee']
        });
        $('.peity_visitors').peity('bar', {
            height: 28,
            width: 48,
            fill: ['#d84315'],
            padding: 0.2
        });
        $('.peity_sale').peity('line', {
            height: 28,
            width: 64,
            fill: '#d1e4f6',
            stroke: '#0288d1'
        });
        $('.peity_conversions_large').peity('bar', {
            height: 64,
            width: 96,
            fill: ['#d84315'],
            padding: 0.2
        });
        var \$peity_live = $('.peity_live');
        if (\$peity_live.length) {
            // live update
            var peityLive = \$peity_live.peity('line', {
                height: 28,
                width: 64,
                fill: '#efebe9',
                stroke: '#5d4037'
            });
            // fix for 'startVal or endVal is not a number' error
            $('#peity_live_text').text('0');

            function getRandomVal(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }

            setInterval(function () {
                var random = Math.round(Math.random() * 10);
                var values = peityLive.text().split(',');
                values.shift();
                values.push(random);

                peityLive
                    .text(values.join(','))
                    .change();

                var countFrom = parseInt($('#peity_live_text').text()),
                    countTo = getRandomVal(20, 100);

                if(countFrom == countTo) {
                    var countTo = getRandomVal(20, 120);
                }

                var numAnim = new CountUp('peity_live_text', countFrom, countTo, 0, 1.2);
                numAnim.start();

            }, 2000)
        }
// charlist bar
        new Chartist.Bar('#ct-chart', {
            labels: ['".$charts_labels[0]."', '".$charts_labels[1]."', '".$charts_labels[2]."', '".$charts_labels[3]."'],
            series: [
                [".$charts_serie[0].", 0, 0, 0],
				[0, ".$charts_serie[1].", 0, 0],
				[0, 0, ".$charts_serie[2].", 0],
				[0, 0, 0, ".$charts_serie[3]."]
            ]
        }, {
            // Default mobile configuration
            stackBars: true,
            axisX: {
                labelInterpolationFnc: function(value) {
                    return value.split(/\s+/).map(function(word) {
                        return word[0];
                    }).join('');
                }
            },
            axisY: {
                offset: 20
            }
        }, [
            // Options override for media > 400px
            ['screen and (min-width: 400px)', {
                reverseData: true,
                horizontalBars: true,
				seriesBarDistance: 10,
                axisX: {
                    labelInterpolationFnc: Chartist.noop
                },
                axisY: {
                    offset: 120
                }
            }],
            // Options override for media > 800px
            ['screen and (min-width: 800px)', {
                stackBars: false,
                seriesBarDistance: 10
            }],
            // Options override for media > 1000px
            ['screen and (min-width: 1000px)', {
                reverseData: true,
                horizontalBars: true,
                seriesBarDistance: 0
            }]
        ]);		
		
		
</script>"; ?>
<?php require(DIR_WS_INCLUDES . 'page_bottom.php'); ?>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>