<?php

/**
 * @file
 * Contains \Drupal\jdf\Plugin\views\field\PHPViewsField.
 */

namespace Drupal\jdf\Sclass;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Url;
use GuzzleHttp\Exception\RequestException;
use Drupal\image\Entity\ImageStyle;
use Drupal\fk\Entity\fk_prodinfo;


class ImportSource {
/**
 * {@inheritdoc}
 */

private static function jdf_GetLocalData($barcode, $data) {
  $prodinfo = \Drupal::entityTypeManager()->getStorage('fk_prodinfo')->loadByProperties(['barcode' => $barcode]);
  if (!empty($prodinfo)) {
    $entity = fk_prodinfo::load(key($prodinfo));
    switch ($data) {
      case 'name':
        $output['name'] = $entity->get('name')->value;
        break;
      case 'weight':
        $output['weight'] = $entity->get('weight')->value;
        break;
      case 'proteins':
        $output['proteins'] = $entity->get('proteins')->value;
        break;
      case 'fats':
        $output['fats'] = $entity->get('fats')->value;
        break;
      case 'carbs':
        $output['carbs'] = $entity->get('carbs')->value;
        break;
      case 'energy':
        $output['energy'] = $entity->get('energy')->value;
        break;
      case 'category':
        $output['category'] = $entity->get('category')->value;
        break;
      case 'link':
        $output['link'] = $entity->get('link')->value;
        break;
      case 'image':
        $output['image'] = $entity->get('image')->value;
        break;
      case 'source':
        $output['source'] = $entity->get('source')->value;
        break;
      default:
        $output['name'] = $entity->get('name')->value;
        $output['weight'] = $entity->get('weight')->value;
        $output['proteins'] = $entity->get('proteins')->value;
        $output['fats'] = $entity->get('fats')->value;
        $output['carbs'] = $entity->get('carbs')->value;
        $output['energy'] = $entity->get('energy')->value;
        $output['category'] = $entity->get('category')->value;
        $output['link'] = $entity->get('link')->value;
        $output['image'] = $entity->get('image')->value;
        $output['source'] = $entity->get('source')->value;
        break;
    }
    return $output;
  }
}

private static function jdf_JsonData($url) {
  try {
    $response = \Drupal::httpClient()->get($url, array('headers' => array('Accept' => 'text/plain')));
    $json = (string) $response->getBody();
    if (empty($json)) {
      return FALSE;
    }
  }
  catch (RequestException $e) {
    return FALSE;
  }
  $fields = Json::decode($json);
  return ($fields);
}


private static function jdf_ParseSource($barcode, $remote_source) {
  switch ($remote_source) {
    case 1: //dpm('dobavkam.net');
      $fields = ImportSource::jdf_JsonData('http://dobavkam.net/barcode/' . $barcode);
      if (!empty($fields)) {
        $data['name'] = $fields[0]['product']['name'];
        $data['weight'] = $fields[0]['product']['weight'];
        $data['proteins'] = $fields[0]['product']['proteins'];
        $data['fats'] = $fields[0]['product']['fats'];
        $data['carbs'] = $fields[0]['product']['carbs'];
        $data['energy'] = $fields[0]['product']['energy'];
        $data['category'] = $fields[0]['product']['category'];
        $data['link'] = $fields[0]['product']['link'];
        $data['image'] = $fields[0]['product']['image']['src'];
        $data['source'] = 1;
      }

      break;
    case 2: //dpm('ucat.com.ua');
      $fields = ImportSource::jdf_JsonData('https://client.ucat.com.ua/api-sync/v1/products/' . $barcode . '/search?authKey=bf8e7d0811b217c0b2409dda761e28cc35c6b1bc457f23a7039f570725295ea7');
      if (!empty($fields)) {
        $data['name'] = $fields[0]['ShortDescriptionTextRu'];
        $data['weight'] = $fields[0]['ChildGTIN']['NetWeightValue']*1000;
        $data['proteins'] = $fields[0]['ChildGTIN']['Proteins'];
        $data['fats'] = $fields[0]['ChildGTIN']['Fats'];
        $data['carbs'] = $fields[0]['ChildGTIN']['Carbs'];
        $data['energy'] = $fields[0]['ChildGTIN']['CaloricValue'];
        $data['category'] = $fields[0]['product']['category'];
        $data['link'] = 'https://ucat.com.ua/uk?q=' . $barcode;
        $data['image'] = $fields[0]['ChildGTIN']['Images'][0]['link'];
        $data['source'] = 2;
      }
      break;
  }
  return $data;
}


private static function jdf_GetRemoteData($barcode, $data, $source, $remote_source) {
  if ($remote_source == 1 || !isset($remote_source)) {
    $output = ImportSource::jdf_ParseSource($barcode, 1);
  }
  if ($remote_source == 2 || (!isset($remote_source) && empty($output))) {
    $output = ImportSource::jdf_ParseSource($barcode, 2);
  }
  if (!empty($output) && $source == 'RemoteSave') {
    $dat = file_get_contents($output['image']);
    $file = file_save_data($dat, 'public://images/prodbase/' . $barcode . '.jpg', FILE_EXISTS_REPLACE);
    if ($file) {
      $target_id = $file->id();
    }
  $prodin = \Drupal\fk\Entity\fk_prodinfo::create(array(
    'barcode' => $barcode,
    'name' => $output['name'],
    'weight' => $output['weight'],
    'proteins' => $output['proteins'],
    'fats' => $output['fats'],
    'carbs' => $output['carbs'],
    'energy' => $output['energy'],
    'category' => $output['category'],
    'link' => $output['link'],
    'image' => ['target_id' => $target_id,],
    'source' => $output['source'],
  ));
  $prodin->save();

  }
  return $output;
}



public function jdf_prodinfo($barcode, $data, $source, $remote_source) {
  switch ($source) {
    case 'LocalRead':
      $output = ImportSource::jdf_GetLocalData($barcode, $data);
      break;
    case 'RemoteSave':
      $output = ImportSource::jdf_GetLocalData($barcode, $data);
      if (empty($output)) {
        $output = ImportSource::jdf_GetRemoteData($barcode, $data, $source, $remote_source);
        }
      break;
    case 'RemoteView':
      $output = ImportSource::jdf_GetRemoteData($barcode, $data, $source, $remote_source);
      break;
  }
  if ($data == 'all') return $output;
  else return $output[$data];
}
}
