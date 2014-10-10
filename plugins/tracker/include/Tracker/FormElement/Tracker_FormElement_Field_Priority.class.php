<?php

/**
 * Copyright (c) Enalean, 2014. All Rights Reserved.
 *
 * This file is a part of Tuleap.
 *
 * Tuleap is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Tuleap is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Tuleap. If not, see <http://www.gnu.org/licenses/>.
 */

class Tracker_FormElement_Field_Priority extends Tracker_FormElement_Field_Integer implements Tracker_FormElement_Field_ReadOnly {

    public function getLabel($report = null) {
        if ($report) {
            return $this->label . $this->fetchAdditionalInformationsForLabel($report);
        }

        return $this->label;
    }

    private function fetchAdditionalInformationsForLabel(Tracker_Report $report) {
        $html = '';

        EventManager::instance()->processEvent(
            TRACKER_EVENT_FIELD_AUGMENT_COLUMN_TITLE_FOR_REPORT,
            array(
                'additional_criteria' => $report->getAdditionalCriteria(),
                'result'              => &$result,
                'field'               => $this
            )
        );

        if (! $result) {
            return;
        }

        return $this->getRenderedAdditionalInformationsForLabel($result);
    }

    private function getRenderedAdditionalInformationsForLabel($additional_informations) {
        $html = $this->getTemplateRenderer()->renderToString(
            'additional_column_title',
            array(
                'additional_title' => $additional_informations
            )
        );

        return $html;
    }

    private function getTemplateRenderer() {
        return TemplateRendererFactory::build()->getRenderer(TRACKER_TEMPLATE_DIR.'/report');
    }

    public function getCriteriaFrom($criteria) {
        return ' INNER JOIN tracker_artifact_priority ON artifact.id = tracker_artifact_priority.curr_id';
    }

    public function getCriteriaWhere($criteria) {
        if ($criteria_value = $this->getCriteriaValue($criteria)) {
            return $this->buildMatchExpression('tracker_artifact_priority.rank', $criteria_value);
        }
        return '';
    }

    public function fetchChangesetValue($artifact_id, $changeset_id, $value, $report=null, $from_aid = null) {
        $value = $this->getArtifactRank($artifact_id);

        if (! $report) {
            return $value;
        }

        return $value . " " . $this->getAugmentedFieldValue($artifact_id, $report);;
    }

    private function getAugmentedFieldValue($artifact_id, Tracker_Report $report) {
        $result = '';

        EventManager::instance()->processEvent(
            TRACKER_EVENT_FIELD_AUGMENT_DATA_FOR_REPORT,
            array(
                'additional_criteria' => $report->getAdditionalCriteria(),
                'result'              => &$result,
                'artifact_id'         => $artifact_id,
                'field'               => $this
            )
        );

        return $result;
    }

    /**
     * Get the "select" statement to retrieve field values
     * @return string
     * @see getQueryFrom
     */
    public function getQuerySelect() {
        return "tracker_artifact_priority.rank AS `$this->name`";
    }

    /**
     * Get the "from" statement to retrieve field values
     * You can join on artifact AS a, tracker_changeset AS c
     * which tables used to retrieve the last changeset of matching artifacts.
     * @return string
     */
    public function getQueryFrom() {
        return "INNER JOIN tracker_artifact_priority ON a.id = tracker_artifact_priority.curr_id";
    }

    /**
     * @return array the available aggreagate functions for this field. empty array if none or irrelevant.
     */
    public function getAggregateFunctions() {
        return array();
    }

    /**
     * Fetch the html code to display the field value in artifact
     *
     * @param Tracker_Artifact                $artifact         The artifact
     * @param Tracker_Artifact_ChangesetValue $value            The actual value of the field
     * @param array                           $submitted_values The value already submitted by the user
     *
     * @return string
     */
    protected function fetchArtifactValue(Tracker_Artifact $artifact, Tracker_Artifact_ChangesetValue $value = null, $submitted_values = array()) {
        return $this->fetchArtifactValueReadOnly($artifact, $value);
    }

    /**
     * Fetch the html code to display the field value in artifact in read only mode
     *
     * @param Tracker_Artifact                $artifact The artifact
     * @param Tracker_Artifact_ChangesetValue $value    The actual value of the field
     *
     * @return string
     */
    public function fetchArtifactValueReadOnly(Tracker_Artifact $artifact, Tracker_Artifact_ChangesetValue $value = null) {
        return '<span>' . $this->getArtifactRank($artifact->getID()) . '</span>';
    }

    private function getArtifactRank($artifact_id) {
        $dao = $this->getPriorityDao();
        return $dao->getGlobalRank($artifact_id);
    }

    /**
     * Fetch artifact value for email
     * @param Tracker_Artifact $artifact
     * @param PFUser $user
     * @param Tracker_Artifact_ChangesetValue $value
     * @param string $format
     * @return string
     */
    public function fetchMailArtifactValue(Tracker_Artifact $artifact, PFUser $user, Tracker_Artifact_ChangesetValue $value = null, $format='text') {
        $output = '';
        switch ($format) {
            case 'html':
                $proto = ($GLOBALS['sys_force_ssl']) ? 'https' : 'http';
                $output .= '<span>' . $this->getArtifactRank($artifact->getID()) . '</span>';
                break;
            default:
                $output .= $this->getArtifactRank($artifact->getID());
                break;
        }
        return $output;
    }

    public function fetchArtifactValueWithEditionFormIfEditable(Tracker_Artifact $artifact, Tracker_Artifact_ChangesetValue $value = null) {
        return $this->fetchArtifactValueReadOnly($artifact, $value);
    }

    /**
     * Display the html field in the admin ui
     * @return string html
     */
    protected function fetchAdminFormElement() {
        return '<span>314116</span>';
    }

    /**
     * @return the label of the field (mainly used in admin part)
     */
    public static function getFactoryLabel() {
        return $GLOBALS['Language']->getText('plugin_tracker_formelement_admin', 'priority_label');
    }

    /**
     * @return the description of the field (mainly used in admin part)
     */
    public static function getFactoryDescription() {
        return $GLOBALS['Language']->getText('plugin_tracker_formelement_admin', 'priority_description');
    }

    /**
     * @return the path to the icon
     */
    public static function getFactoryIconUseIt() {
        return $GLOBALS['HTML']->getImagePath('ic/priority.png');
    }

    /**
     * @return the path to the icon
     */
    public static function getFactoryIconCreate() {
        return $GLOBALS['HTML']->getImagePath('ic/priority.png');
    }

    /**
     * Fetch the html code to display the field value in tooltip
     *
     * @param Tracker_Artifact $artifact
     * @param Tracker_Artifact_ChangesetValue_Integer $value The changeset value of this field
     * @return string The html code to display the field value in tooltip
     */
    protected function fetchTooltipValue(Tracker_Artifact $artifact, Tracker_Artifact_ChangesetValue $value = null) {
        return $this->getArtifactRank($artifact->getID());
    }

    /**
     * Validate a value
     *
     * @param Tracker_Artifact $artifact The artifact
     * @param mixed            $value    data coming from the request.
     *
     * @return bool true if the value is considered ok
     */
    protected function validate(Tracker_Artifact $artifact, $value) {
        return true;
    }

    /**
     * Fetch the element for the submit new artifact form
     *
     * @return string html
     */
    public function fetchSubmit() {
        return '';
    }

    /**
     * Fetch the element for the submit new artifact form
     *
     * @return string html
     */
    public function fetchSubmitMasschange($submitted_values=array()) {
        return '';
    }

    public function accept(Tracker_FormElement_FieldVisitor $visitor) {
        return $visitor->visitPriority($this);
    }

    /**
     * Return REST value of the priority
     *
     * @param PFUser $user
     * @param Tracker_Artifact_Changeset $changeset
     *
     * @return mixed | null if no values
     */
    public function getRESTValue(PFUser $user, Tracker_Artifact_Changeset $changeset) {
        $classname_with_namespace = 'Tuleap\Tracker\REST\Artifact\ArtifactFieldValueRepresentation';

        $artifact_field_value_representation = new $classname_with_namespace;
        $artifact_field_value_representation->build(
            $this->id,
            $this->label,
            $this->getArtifactRank($changeset->getArtifact()->getID())
        );

        return $artifact_field_value_representation;
    }


    private function getPriorityDao() {
        return new Tracker_Artifact_PriorityDao();
    }

    public function getSoapValue() {
        return null;
    }

    public function isCompatibleWithSoap() {
        return false;
    }

    public function getFieldDataFromSoapValue(stdClass $soap_value, Tracker_Artifact $artifact = null) {
        throw new Exception('DEPRECATION ERROR: Priority field is not compatible with SOAP methods. If you need it, please use REST.');
    }

    /**
     * Validate a field
     *
     * @param Tracker_Artifact                $artifact             The artifact to check
     * @param mixed                           $submitted_value      The submitted value
     * @param Tracker_Artifact_ChangesetValue $last_changeset_value The last changeset value of the field (give null if no old value)
     *
     * @return boolean true on success or false on failure
     */
    public function validateFieldWithPermissionsAndRequiredStatus(Tracker_Artifact $artifact, $submitted_value, Tracker_Artifact_ChangesetValue $last_changeset_value = null) {
        $is_valid = true;

        if ($submitted_value !== null && ! $this->userCanUpdate()) {
            $is_valid = true;
            $GLOBALS['Response']->addFeedback('warning', $GLOBALS['Language']->getText('plugin_tracker_admin_import', 'field_not_taken_account', array($this->getName())));
        }

        return $is_valid;
    }
}
