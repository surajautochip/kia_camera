# -*- coding: utf-8 -*-

from odoo import models, fields, api
# from dateitime import timedelta
from odoo.tools import DEFAULT_SERVER_DATETIME_FORMAT
from datetime import date, datetime
import datetime


class LiveStreaming(models.Model):
    _name = 'live.streaming'

    name = fields.Char(string="Token")
    date = fields.Datetime(string="Date")
    cust_name = fields.Char(string="Customer Name")
    stream_start_time = fields.Datetime(string="Streaming Start Time")
    stream_end_time = fields.Datetime(string="Streaming End Time")
    streaming_duration = fields.Char(string="Streaming Duration", compute='_compute_time',store=1)
    views_duration = fields.Char(string="Views Duration",compute='_compute_duration',store=1)
    click_count = fields.Integer(string="Count Of Click",compute='_compute_duration',store=1)
    live_stream_ids = fields.One2many('live.streaming.line', 'line_stream_id')
    state = fields.Selection([('progress', 'In progress'),('finished', 'Finished')])
    company_id = fields.Many2one('res.company', "Company")

    @api.depends('stream_end_time')
    def _compute_time(self):
        # duration = timedelta(0)
        if self.stream_end_time and self.stream_end_time:
            start_time = datetime.datetime.strptime(self.stream_end_time, DEFAULT_SERVER_DATETIME_FORMAT)
            end_time = datetime.datetime.strptime(self.stream_start_time, DEFAULT_SERVER_DATETIME_FORMAT)
            stream_duration = start_time - end_time
            self.streaming_duration =str(stream_duration )+" min"
    # self.streaming_duration = float(self.stream_end_time - self.stream_start_time)

    @api.depends('live_stream_ids.duration')
    def _compute_duration(self):
        time_duration = []
        if self.live_stream_ids:
            self. click_count = len(self.live_stream_ids)
            totalSecs = 0
            for durations in self.live_stream_ids:
                if durations.duration:
                    tm = durations.duration
                    timeParts = [int(s) for s in tm.split(':')]
                    totalSecs += (timeParts[0] * 60 + timeParts[1]) * 60 + timeParts[2]
            totalSecs, sec = divmod(totalSecs, 60)
            hr, min = divmod(totalSecs, 60)
            self.views_duration = str(hr)+":"+str(min)+":"+str(sec)
            print(hr,min,sec)

class LiveStreamingLine(models.Model):
    _name = 'live.streaming.line'
    line_stream_id = fields.Many2one('live.streaming')
    session = fields.Char(string="Session Id")
    start_time = fields.Datetime(string="Start Time")
    end_time = fields.Datetime(string="End Time")
    duration = fields.Char(string="Duration",compute='_compute_time')

    @api.model
    def create(self, values):
        res = super(LiveStreamingLine, self).create(values)
        res.update({'session': res.id})
        return res

    @api.depends('end_time')
    def _compute_time(self):
        # duration = timedelta(0)
        for case in self:
            if case.start_time and case.end_time:
                start_time = datetime.datetime.strptime(case.start_time, DEFAULT_SERVER_DATETIME_FORMAT)
                end_time = datetime.datetime.strptime(case.end_time, DEFAULT_SERVER_DATETIME_FORMAT)
                duration = end_time-start_time
                case.duration = duration



