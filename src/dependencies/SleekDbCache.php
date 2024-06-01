<?php
/**
 * Class SleekDBCache core dependency
 * @category Framework
 * @package  FastFramework
 * @author   Francesco Cappa <francesco.cappa.91@gmail.com>
 * @link     https://github.com/0limits91/fast-framework
 *
 * @version  0.0.1
 */

namespace FastFramework;
include_once (__DIR__ . '/../../vendor/autoload.php');

class SleekDBCache {
    protected $store;

    public function __construct($cachePath) {
        $configuration = [
            // altre configurazioni...
            'timeout' => false // Imposta questa riga
        ];
        $this->store = new \SleekDB\Store('transients', $cachePath, $configuration);
    }

    public function set($key, $value, $expiration) {
        $data = [
            'key' => $key,
            'value' => $value,
            'expires' => time() + $expiration
        ];
        // Qui si potrebbe aggiungere una logica per sovrascrivere un transient esistente
        $this->store->insert($data);
    }

    public function get($key) {
        $result = $this->store->findOneBy(['key', '=', $key]);
        if (!empty($result) && time() < $result['expires']) {
            return $result['value'];
        } else {
            $this->delete($key); // Elimina il transient se è scaduto
            return false;
        }
    }

    public function delete($key) {
        $this->store->deleteBy(['key', '=', $key]);
    }
}