<div class="panel-title">
    <h3 class="text-center"style="margin:20px 0;font-size: 18px;">SCAF-LINK ENGINEERING PTE LTD</h3>
        <p class="text-center" style="color:gray;">Salary Voucher</p>
    <h5>{{ucfirst($firstrow->user->name)}} ({{$firstrow->user->company_id}})
        <small style="margin-left:10px"> Position: {{ucfirst($firstrow->user->role->name)}} 
        <span class="pull-right"> Date: {{\Carbon\Carbon::parse($firstrow->created_at)->format('Y-m')}}-8</span></small></h4>                            
    </h5>                            
</div>
<div class="staff-salary">
    <form action="{{route('salary-sheets.staff-list',
                ['user_id' => $firstrow->user_id, 'created_at' => $firstrow->created_at])}}"
                method="post">
        <table class="table table-borderless">
            <thead>
                <tr style="margin-top:100px">
                    <td class="text-right">Salary for {{\Carbon\Carbon::parse($firstrow->created_at)->format(' F Y')}} : S$</td>
                    <td></td>
                    <td class="text-left salary" style="padding-right:23px;">{{$firstrow->user->salary}}</td>
                </tr>
            </thead>                                 
            <tbody>
                <tr>
                    <td class="text-right">Project Incentive : S$ </td>
                    <td></td>
                    <td><input name="incentive" type="number" class="print-input incentive" 
                    placeholder="{{$firstrow->incentive ? $firstrow->incentive : 0.00}}" value="{{$firstrow->incentive ? $firstrow->incentive : 0.00}}"></td>
                </tr>
                <tr>
                    <td class="text-right">Deduction : S$ </td>
                    <td><input type="text" name="deduction_for" class="print-input text-right" 
                        placeholder="{{$firstrow->deduction_for ? $firstrow->deduction_for : 'Deduction for'}}" value=""></td>
                    <td><input name="deduction" type="number" class="print-input deduction" 
                        placeholder="{{$firstrow->deduction ? $firstrow->deduction : 0.00}}" value="{{$firstrow->deduction ? $firstrow->deduction : 0.00}}"></td>
                </tr>
                <tr><td></td><td></td><td></td></tr>
                <tr>
                    <td class="text-right">Total Amount : S$</td>
                    <td></td>
                    <td class="total" style="padding-right:23px;">{{$firstrow->user->salary +  $firstrow->incentive - $firstrow->deduction}}</td>
                </tr>
                <tr>
                    <td class="text-right">Cheque No : </td>
                    <td></td>
                    <td style="padding-right:23px;"><input name="cheque_no" type="text" class="print-input cheque_no" 
                        placeholder="Cheque No " value=""></td>
                </tr>                                                        
            </tbody>
            <tfoot>
                <tr><td></td><td></td><td></td>
                </tr>
                <tr><td></td><td></td><td></td>
                </tr>
                <tr><td></td><td></td><td></td>
                </tr>
                <tr><td></td><td></td><td></td>
                </tr>
                <tr><td></td><td></td><td></td>
                </tr>
                <tr><td>Payment Approved By ____________</td><td></td><td>Received By____________</td>
                </tr>
            </tfoot>
        </table>
    </form>
</div> 