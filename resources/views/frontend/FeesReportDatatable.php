<?php

namespace App\DataTables\Report;


use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Inquiry;
use App\Models\University;
use App\Models\Course;
use App\Models\Associates;
use App\Models\Intake;
use App\Models\Visa;
use App\Repositories\InquiryRepository;
use Helper;
use Exception;

class FeesReportDatatable extends DataTable
{
    protected $repository;

    public function __construct(InquiryRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            ->rawColumns(['action', 'id', 'stage', 'date', 'university', 'intake', 'tution fee', 'gic fee', 'tution fees refund'])
            ->addColumn('id', function (Inquiry $inquiry) {
                $inquiry_code = "<a href='" . route('profile-inquiry', [base64_encode($inquiry->inquiry_id)]) . "'><span class='badge badge-primary'><i data-feather='link' class='mr-1'></i>" . $inquiry->inquiry_code . "</span></a>";
                return $inquiry_code;
            })
            ->filterColumn('id', function ($query, $keyword) {
                $keywords = trim($keyword);
                $query->whereRaw("inquiry_code like ?", ["%{$keywords}%"]);
            })
            ->addColumn('name', function (Inquiry $inquiry) {
                $full_name = $inquiry->first_name . " " . $inquiry->middle_name . " " . $inquiry->last_name;
                return $full_name;
            })
            ->filterColumn('name', function ($query, $keyword) {
                $keywords = trim($keyword);
                $query->whereRaw("CONCAT(first_name, middle_name, last_name) like ?", ["%{$keywords}%"]);
            })
            ->addColumn('mobile', function (Inquiry $inquiry) {
                return $full_name = $inquiry->mobile_no;
            })
            ->filterColumn('mobile', function ($query, $keyword) {
                $keywords = trim($keyword);
                $query->whereRaw("mobile_no like ?", ["%{$keywords}%"]);
            })
            ->addColumn('whatsapp', function (Inquiry $inquiry) {
                return $full_name = $inquiry->whatsapp_no;
            })
            ->filterColumn('whatsapp', function ($query, $keyword) {
                $keywords = trim($keyword);
                $query->whereRaw("whatsapp_no like ?", ["%{$keywords}%"]);
            })
            ->addColumn('email', function (Inquiry $inquiry) {
                return $full_name = $inquiry->email_id;
            })
            ->addColumn('stage', function (Inquiry $inquiry) {
                $status = Helper::InquiryStatus($inquiry->inquiry_id);
                return $status;
            })
            ->addColumn('register on', function (Inquiry $inquiry) {
                $return_data = Helper::changeDateFormate($inquiry->registration_date_admission, 'd/m/Y');
                return $return_data;
            })
            ->addColumn('university', function (Inquiry $inquiry) {
                // $all_admission = $inquiry->get_admission_with_finalselection;
                $applied_uni   = 'N/A';

                $stage = '';
                $class = '';
                if (isset($inquiry->get_admission_with_finalselection[0])) {

                    if ($inquiry->get_admission_with_finalselection[0]->defer_intake == 0) {
                        $stage = 'FRESH APP';
                        $class = 'primary';
                    } elseif ($inquiry->get_admission_with_finalselection[0]->defer_intake == 1) {
                        $stage = 'DEFER INTAKE';
                        $class = 'danger';
                    }
                    if ($inquiry->get_admission_with_finalselection[0]->defer_intake == 0 && $inquiry->get_admission_with_finalselection[0]->original_app > 0) {
                        $stage = 'DEFER APP';
                        $class = 'success';
                    }
                }
                $defer = "<span class='badge badge-" . $class . "'>" . $stage . "</span>";

                // foreach ($all_admission as $admission) {
                    if ($inquiry->get_admission_with_finalselection[0]->final_selection == 1) {

                        $applied_uni = University::find($inquiry->get_admission_with_finalselection[0]->university)->university_name;

                    }else{
                        $applied_uni = '';
                    }
                // }
                return $applied_uni . '<br>' . $defer;
            })
            ->addColumn('program', function (Inquiry $inquiry) {
                return isset($inquiry->get_admission_detail->get_program->get_course->course_name) ? $inquiry->get_admission_detail->get_program->get_course->course_name : '';

                // $all_admission = $inquiry->get_admission_with_finalselection;
                // $applied_uni = 'N/A';
                // foreach($all_admission as $admission){
                //     if($inquiry->final_selection == 1){
                //         $applied_uni =Course::find($inquiry->program)->course_name;
                //     }
                // }
                // return $applied_uni;
            })
            ->addColumn('intake', function (Inquiry $inquiry) {
                // $all_admission = $inquiry->get_admission_with_finalselection;
                $applied_uni   = 'N/A';
                // foreach ($all_admission as $admission) {
                    if ($inquiry->final_selection == 1) {
                        $intake_month = $inquiry->intake_month;

                        $intake_year = Intake::find($inquiry->intake_year)->intake;

                        $applied_uni = $intake_month . '<br>' . $intake_year;
                    }
                // }
                return $applied_uni;
            })
            ->addColumn('student id', function (Inquiry $inquiry) {
                // $all_admission = $inquiry->get_admission_with_finalselection;
                $applied_uni   = 'N/A';
                // foreach ($all_admission as $admission) {
                    if ($inquiry->final_selection == 1) {
                        $applied_uni = $inquiry->student_id;
                    }
                // }
                return $applied_uni;
            })
            ->addColumn('app by', function (Inquiry $inquiry) {
                return optional(optional($inquiry->get_admission_detail)->get_application_from)->fullname;
            })
            ->addColumn('tution fee', function (Inquiry $inquiry) {
                $return_data = '';

                if (!empty($inquiry->get_post_admission)) {
                    foreach ($inquiry->get_post_admission as $post_admission) {
                        if ($post_admission->application_stage_id == 1) {
                            if ($post_admission->fullyear_fees == 1) {
                                $return_data = 'FULL YEAR <br>';

                                if ($post_admission->fullyear_date !== "0000-00-00" && $post_admission->fullyear_date !== null) {
                                    $return_data .= Helper::changeDateFormate($post_admission->fullyear_date, 'd/m/Y');
                                } else {
                                    $return_data .= "Date: N/A";
                                }
                                $return_data .= "<br>REC - " . $post_admission->fullyear_receipt_status . "<br><br> TT - " . $post_admission->fullyear_tt_status;

                            } elseif ($post_admission->semester_fees == 1) {
                                $return_data = 'SEMESTER <br>';

                                if ($post_admission->semester_date !== "0000-00-00" && $post_admission->semester_date !== null) {
                                    $return_data .= Helper::changeDateFormate($post_admission->semester_date, 'd/m/Y');
                                } else {
                                    $return_data .= "Date: N/A";
                                }
                                $return_data .= "<br>REC - " . $post_admission->semester_receipt_status . "<br><br> TT - " . $post_admission->semester_tt_status;
                            } elseif ($post_admission->deposite_fees == 1) {
                                $return_data = 'DEPOSITE <br>';

                                if ($post_admission->deposite_date !== "0000-00-00" && $post_admission->deposite_date !== null) {
                                    $return_data .= Helper::changeDateFormate($post_admission->deposite_date, 'd/m/Y');
                                } else {
                                    $return_data .= "Date: N/A";
                                }
                                $return_data .= "<br>REC - " . $post_admission->deposite_receipt_status . "<br><br> TT - " . $post_admission->deposite_tt_status;
                            } else {
                                $return_data = "NOT PAID";
                            }
                        }
                    }
                }

                return $return_data;
            })
            ->addColumn('gic fee', function (Inquiry $inquiry) {
                $return_data = '';
                if (!empty($inquiry->get_post_admission)) {

                    foreach ($inquiry->get_post_admission as $element) {
                        if ($element->application_stage_id == 3) {
                            if ($element->gic_fees_status == 'PAID' || ($element->gic_fees_bank != null && $element->gic_fees_bank != 0)) {
                                $return_data = '';

                                if ($element->gic_date !== "0000-00-00" && $element->gic_date !== null) {
                                    $return_data .= Helper::changeDateFormate($element->gic_date, 'd/m/Y');
                                } else {
                                    $return_data .= "Date: N/A";
                                }
                                $return_data .= "<br>CER - " . $element->gic_certificate_status . "<br><br> TT - " . $element->gic_tt_status;

                            } else {
                                $return_data = "NOT PAID";
                            }
                        }
                    }
                }
                return $return_data;
            })
            ->addColumn('visa status', function (Inquiry $inquiry) {
                $return_data = '';

                if (!empty($inquiry->get_visa_status)) {
                    foreach ($inquiry->get_visa_status as $element) {

                        if ($element->application_status == 'Granted') {
                            $return_data = 'Granted';
                        } elseif ($element->application_status == 'Rejected') {
                            $return_data = 'Rejected';
                        } elseif ($element->application_status == 'Under Process') {
                            $return_data = 'Under Process';
                        } elseif ($element->application_status == 'File Withdraw') {
                            $return_data = 'File Withdraw';
                        } elseif ($element->application_status == 'NA') {
                            $return_data = 'N/A';
                        } else {
                            $return_data = 'N/A';
                        }
                    }
                }

                return $return_data;
            })
            ->addColumn('tution fees refund', function (Inquiry $inquiry) {
                $return_data = '';
                if (!empty($inquiry->get_post_admission)) {

                    foreach ($inquiry->get_post_admission as $element) {
                        if ($element->application_stage_id == 1) {
                            $return_data = $element->refund_status;
                        }
                    }
                }
                return $return_data;
            })
            ->addColumn('gic refund', function (Inquiry $inquiry) {
                $return_data = '';
                if (!empty($inquiry->get_post_admission)) {

                    foreach ($inquiry->get_post_admission as $element) {
                        if ($element->application_stage_id == 3) {
                            $return_data = $element->refund_status;
                        } else {
                            $return_data = "";
                        }
                    }
                }
                return $return_data;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\/Report/FeesReportDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FeesReportDatatable $model)
    {
        $query = $this->repository->getInquiry()
        ->join('admission','admission.h_inquiry_id','=','inquiry.inquiry_id')
        ->join('application_stage_apply_data','application_stage_apply_data.application_id','=','admission.admission_id')
        ->whereIn('admission.application_status', array(6, 10))
        ->where(function($q){
            $q->where('application_stage_apply_data.deposite_fees', 1)->orWhere('application_stage_apply_data.semester_fees', 1)->orWhere('application_stage_apply_data.fullyear_fees', 1);
        })
        ;
        // ->whereHas('get_admission_with_finalselection', function ($q) {
        //     $q->whereIn('application_status', array(6, 10));
        // })

        $country = $this->request()->get("country");
        if (isset($country)) {
            // $query = $query->whereHas('get_admission_latest_haspost', function ($q) use ($country) {
                $query->where('admission.country', $country);
            // });
        }
        $university = $this->request()->get("university");
        if (isset($university)) {
            // $query = $query->whereHas('get_admission_latest_haspost', function ($q) use ($university) {
                $query->where('admission.university', $university);
            // });
        }
        $intake_month = $this->request()->get("intake_month");
        if (isset($intake_month)) {
            // $query = $query->whereHas('get_admission_latest_haspost', function ($q) use ($intake_month) {
                $query->where('admission.intake_month', $intake_month);
            // });
        }
        $intake_year = $this->request()->get("intake_year");
        if (isset($intake_year)) {
            // $query = $query->whereHas('get_admission_latest_haspost', function ($q) use ($intake_year) {
                $query->where('admission.intake_year', $intake_year);
            // });
        }
        $defer_intake = $this->request()->get("defer_intake");
        if (isset($defer_intake)) {
            if ($defer_intake == 0) {
                // $query = $query->whereHas('get_admission_latest_haspost', function ($q) use ($defer_intake) {
                    $query->where('admission.defer_intake', $defer_intake)->where('admission.original_app', 0);
                // });
            } else {
                // $query = $query->whereHas('get_admission_latest_haspost', function ($q) use ($defer_intake) {
                    $query->where(function($q) use($defer_intake){
                        $q->where('admission.defer_intake', $defer_intake)->orWhere('admission.original_app', '>', 0);
                    });
                // });
            }
        }
        $fees_through = $this->request()->get("fees_through");
        if (isset($fees_through)) {
            // $query = $query->whereHas('get_post_admission_detail', function ($q) use ($fees_through) {
                $query->where(function($q) use($fees_through){
                    $q->where('application_stage_apply_data.deposite_bank', $fees_through)->orWhere('application_stage_apply_data.semester_bank', $fees_through)->orWhere('application_stage_apply_data.fullyear_bank', $fees_through);
                });
            // });
        }
        $inquiry_type = $this->request()->get("inquiry_type");
        if (isset($inquiry_type)) {
            $query = $query->where(function ($q) use ($inquiry_type) {
                $q->where('inquiry_type', $inquiry_type);
            });
        }
        $subagent_id = $this->request()->get("subagent_id");
        if (isset($subagent_id) && $subagent_id !== "") {
            $query = $query->where('subagent_id', $subagent_id);
        }
        $owner = $this->request()->get("owner");
        if (isset($owner)) {
            $query = $query->where(function ($q) use ($owner) {
                $q->where('admission_owner', $owner);
            });
        }
        $branch = $this->request()->get("branch");
        if (isset($branch)) {
            $query = $query->where(function ($q) use ($branch) {
                $q->where('inquiry.branch', $branch);
            });
        }
        $query = $query->groupBy('application_stage_apply_data.application_stage_apply_id');
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('feesreportdatatable-table')
            ->columns($this->getColumns())
            ->postAjax()
            ->orderBy(1)
            ->parameters([
                'responsive' => false,
                'autoWidth' => false,
                'dom'          => '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>r'
            ])
            ->buttons(['excel','csv','reload'])
            ->parameters([
                "aLengthMenu"=>[
                    [10,25, 50, 100, 200, -1],
                    [10,25, 50, 100, 200, "All"],
                    "iDisplayLength"=> -1
                ]
            ])
            ->drawCallback(
                'function() { feather.replace(); }'
            ) 
            ->preDrawCallback(
                'function() { check_export_permission(); }'
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('mobile'),
            Column::make('whatsapp'),
            Column::make('email'),
            Column::make('stage'),
            Column::make('register on'),
            Column::make('university'),
            Column::make('program'),
            Column::make('intake'),
            Column::make('student id'),
            Column::make('app by'),
            Column::make('tution fee'),
            Column::make('gic fee'),
            Column::make('visa status'),
            Column::make('tution fees refund'),
            Column::make('gic refund')->class('none', false)
                ->exportable(true)
                ->printable(true)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Report_FeesReport_' . date('YmdHis');
    }
}