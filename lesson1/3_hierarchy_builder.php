<?php

declare(strict_types=1);

/*
Sukurkite klasę HierarchyBuilder, kuri padėtų terminale vizualizuoti hierarchijos modelį.
Pvz.:
* zero (root) level node
    |_ first level node (id 0)
    |_ first level node (id 1)
        |_ second level node (id 0)
        |_ second level node (id 1)
        |_ second level node (id 2)
Metodai:
addRootNode(string $text): void - prideda root node'ą
addNode(string $text, int $parentLevel, int $parentNodeId): void - prideda node'ą tam tikrame lygyje, nurodytam parent'ui
printHierarchy(): void - spausdina hierarchiją į terminalą
removeNode(int $level, int $parentNodeId): void - pašalina tam tikrą node'ą ir jo vaikus
Apribojimai:
- Gali būti tik vienas root lygio node'as.
- Negalima pridėti node'o neegzistuojančiam parent'ui
Kodo kvietimo pavyzdys:
$hierarchyBuilder = new HierarchyBuilder();
$hierarchyBuilder->addRootNode('this is root (zero)');
$hierarchyBuilder->addNode('this is first level', 0, 0);
$hierarchyBuilder->addNode('this is first level again', 0, 0);
$hierarchyBuilder->addNode('this is second level', 1, 1);
$hierarchyBuilder->addNode('this is first level once again', 0, 0);
$hierarchyBuilder->printHierarchy();
$hierarchyBuilder->addNode('this is fifth level', 4, 0); // parent node does not exist
* this is root (zero)
    |_ this is first level
    |_ this is first level again
        |_ this is second level
    |_ this is first level once again
*/

class HierarchyBuilder {

    public array $root = [];

    public function addRootNode(string $text): void {
        $this->root[] = ['text' => $text, 'parent_id' => 0, 'id' => 1];
    }

    public function addNode(string $text, $parentLevel, int $parentNodeId): void {

        if ($this->array_depth($this->root) < $parentLevel) {
            echo 'Parent node does not exist';
        }

        $this->root[] = ['text' => $text, 'parent_id' => $parentLevel+1, 'id' => count($this->root)+1];
    }

    private function array_depth(array $array): int {
        $max_depth = 1;

        foreach ($array as $value) {
            if (is_array($value)) {
                $depth = $this->array_depth($value) + 1;

                if ($depth > $max_depth) {
                    $max_depth = $depth;
                }
            }
        }

        return $max_depth;
    }

    public function printHierarchy(): void
    {
        print_r($this->makeTree($this->root));
    }

    public function makeTree(array $elements, $parentId = 0): array {
        $branch = array();
        foreach ($elements as $key => $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->makeTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
}

$hierarchyBuilder = new HierarchyBuilder();
$hierarchyBuilder->addRootNode('this is root (zero)');
$hierarchyBuilder->addNode('this is first level', 0, 0);
$hierarchyBuilder->addNode('this is first level again', 0, 0);
$hierarchyBuilder->addNode('this is second level', 1, 1);
$hierarchyBuilder->printHierarchy();