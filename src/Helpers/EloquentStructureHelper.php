<?php

namespace Aruberuto\Configurable\Helpers;
use Illuminate\Database\Eloquent\Model;

class EloquentStructureHelper {

    public static function getStructure($entity) {
        if(is_string($entity)) {
            $model = app()->make($entity);
            if (!$model instanceof Model) {
                throw new \Exception("Class {$entity} must be an instance of Illuminate\\Database\\Eloquent\\Model");
            }

        } elseif($entity instanceof Model) {
            $model = $entity;
        }

        $return = [
            'className' =>  get_class($model),
            'relations' =>  property_exists($model, 'relations') && $model->relations ? array_keys($model->relations) : [],
            'fillableFields' => $model->getFillable(),
            'hiddenFields' => $model->getHidden(),
            'guardFields' => $model->getGuarded(),
            'dbColumns' =>  $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable()),
        ];

        return $return;


    }

    public static function getEntityClass($name , $namespace) {
        $class = $namespace . '\\Entities\\' . ucfirst($name);
        return $class;
    }

    public static function getConfigDefault($entityClass) {

        $structure = self::getStructure($entityClass);
        $result = [];
        $result['form']['class'] = self::getEntityName($entityClass) . '-form inline';
        $result['form']['defaultFieldClass'] = 'form-control';
        foreach($structure['fillableFields'] as $fillable) {
            $result['form']['fields'][] = [
                'name' => $fillable,
                'label' => self::getLabelStr($fillable),
                'instructions' => self::getInstructionStr($fillable, $entityClass),
                'type' => 'text',
                'attrs' => 'xs12',
            ];
        }

        $result['display']['class'] = self::getEntityName($entityClass) . '-display';
        $result['display']['defaultFieldClass'] = self::getEntityName($entityClass) . '-display-field';
        $primarySetted = false;
        foreach($structure['dbColumns'] as $order => $col) {
            if($col === 'id') {
                $level = -1;
            } elseif(!$primarySetted && $col !== 'created_at' && $col !== 'updated_at') {
                $level = 0;
                $primarySetted = true;
            } else {
                $level = 1;
            }
            $result['display']['fields'][] = [
                'name' => $col,
                'level' => $level,
                'label' => self::getLabelStr($col),
                'showLabel' => $level === 0 ? false : true,
                'wrapper' => $level === 0 ? 'h2' : null,
                'attrs' => 'xs12',
            ];
        }



        return $result;
    }

    public static function getLabelStr($str) {
        return str_replace('_', ' ', ucfirst($str));
    }
    public static function getInstructionStr($str, $entityClass) {
        return 'Add a ' . str_replace('_', ' ',$str) . ' to ' . self::getEntityName($entityClass);
    }
    public static function getEntityName($entityClass) {
        return strtolower(class_basename($entityClass));
    }
}
